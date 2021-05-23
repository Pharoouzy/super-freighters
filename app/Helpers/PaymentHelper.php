<?php

namespace App\Helpers;

use App\Models\Mode;
use App\Models\Country;
use App\Models\Order;
use App\Models\Transaction;

/**
 * Trait PaymentHelper
 * @package App\Helpers
 */
trait PaymentHelper {

    /**
     * @var
     */
    private $mode, $origin, $destination;

    /**
     * @param $request
     * @return \stdClass
     */
    public function getPaymentData($request){

        $data = new \stdClass();
        $data->sub_total = $this->calculateSubtotal($request);
        $data->customs_fee = $this->calculateCustomsFee($data->sub_total);
        $data->total = $data->sub_total + $data->customs_fee;
        $data->reference = $this->generateTransactionReference();
        $data->mode = $this->mode;
        $data->origin = $this->origin;
        $data->destination = $this->destination;
        $data->request = $request->all();
        $data->user = (object)$request->only(['first_name', 'last_name', 'email', 'phone_number']);
        $data->item = (object)$request->only(['item_name', 'weight']);

        return $data;
    }

    /**
     * @param $amount
     * @return float|int
     */
    public function calculateCustomsFee($amount){
        return ((double)config('settings.customs_tax') / 100) * $amount;
    }

    /**
     * @param $request
     * @return float|int
     */
    public function calculateSubtotal($request){

        $this->mode = Mode::find($request->mode);
        $this->destination = Country::find($request->destination);
        $this->origin = Country::find($request->origin);

        return $this->mode->base_fare + (round($request->weight) * $this->mode->fare_per_kg) + $this->origin->flat_rate;
    }

    /**
     * @return string
     */
    public function generateTransactionReference(){
        $reference = 'SFT-TRF-'.strtoupper(substr(md5(substr(hexdec(uniqid()), -6)), -6));

        if(Transaction::where('reference', $reference)->exists()){
            return $this->generateReference();
        }

        return $reference;
    }

    /**
     * @return string
     */
    public function generateOrderNumber(){
        $orderNumber = 'SFT-'.strtoupper(substr(md5(substr(hexdec(uniqid()), -6)), -6));

        if(Order::where('order_number', $orderNumber)->exists()){
            return $this->generateOrderNumber();
        }

        return $orderNumber;
    }
}
