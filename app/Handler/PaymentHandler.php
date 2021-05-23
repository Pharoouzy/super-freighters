<?php


namespace App\Handler;

use App\Models\User;
use App\Models\Order;
use App\Libraries\Paystack;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\EmailHelper;
use App\Helpers\PaymentHelper;
use Illuminate\Support\Facades\DB;

/**
 * Class PaymentHandler
 * @package App\Handler
 */
class PaymentHandler extends Paystack {

    use PaymentHelper, EmailHelper;

    /**
     * PaymentHandler constructor.
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function pay(Request $request) {

        try{
            $paymentData = $this->getPaymentData($request);
            DB::beginTransaction();

            // update or create user
            $user = User::updateOrCreate(['email' => $paymentData->user->email], [
                'first_name' => $paymentData->user->first_name,
                'last_name' => $paymentData->user->last_name,
                'phone_number' => $paymentData->user->phone_number,
            ]);

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => $this->generateOrderNumber(),
                'item_name' => $paymentData->item->item_name,
                'weight' => $paymentData->item->weight,
                'origin' => $paymentData->origin->id,
                'destination' => $paymentData->destination->id,
                'mode' => $paymentData->mode->id,
                'sub_total' => $paymentData->sub_total,
                'customs_fee' => $paymentData->customs_fee,
            ]);

            // create transaction
            $order->transaction()->create([
                'order_id' => $order->id,
                'reference' => $paymentData->reference,
                'amount' => $paymentData->total,
            ]);


            // Process Paystack
            $response = $this->initialize([
                'amount' => $paymentData->total,
                'email' => $user->email,
                'transaction_ref' => $paymentData->reference,
            ]);

            if (!$response['status']) {
                DB::rollBack();
                session()->flash('error', [$response['message'] ?? 'Unable to complete transaction.']);
                return redirect()->back();
            }

            $order->transaction()->update([
                'access_code' => @$response['data']['access_code'],
                'authorization_url' => $response['data']['authorization_url'],
            ]);
            DB::commit();
            // destroy session
            session()->forget('summary');

            return redirect()->away($response['data']['authorization_url']);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', [$e->getMessage() ?? 'Unable to complete order, please try again later']);

            return redirect()->back();
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyPayment(Request $request) {
        $reference = $request->reference;

        $transaction = Transaction::where('reference', $reference)->firstOrFail();
        $response = $this->verify($reference);

        if($response['status'] && (int)$transaction->amount === $response['data']['amount']/100) {

            DB::transaction(function() use ($transaction, $response) {

                $transaction->update([
                    'response_code' => '00',
                    'response_description' => 'Successful Transaction',
                    'status' => 1,
                    'response_full' => json_encode($response),
                ]);

                $transaction->order()->update(['status' => 1]);

                // send notification to admin and user
                $this->sendPaymentReceipt(config('settings.default_email_address'), $transaction, true);
                $this->sendPaymentReceipt($transaction->order->user->email, $transaction);
                $this->sendOrderConfirmation(config('settings.default_email_address'), $transaction, true);
                $this->sendOrderConfirmation($transaction->order->user->email, $transaction);

            }, 5);

            session()->flash('success', ['Transaction successfully verified']);

            return redirect()->route('payment.status');
        }
        else{
            // update transaction table
            $transaction->update([
                'response_code' => '11',
                'response_description' => 'Failed Transaction',
                'status' => 2,
                'response_full' => json_encode($response),
            ]);

            $transaction->order()->update(['status' => 3]);

            session()->flash('error', [$response['message'] ?? 'Unable to verify transaction.']);

            return redirect()->route('home');
        }
    }

}
