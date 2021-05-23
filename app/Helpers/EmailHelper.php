<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentReceipt;
use App\Mail\OrderConfirmation;

/**
 * Trait EmailHelper
 * @package App\Helpers
 */
trait EmailHelper {

    public function sendPaymentReceipt($email, $transaction, $isAdmin = false){
        try{
            Mail::to($email)->send(new PaymentReceipt($transaction, $isAdmin));
        } catch (Exception $exception){
            session()->flash('warning', [$exception->getMessage()]);
        }
    }
    public function sendOrderConfirmation($email, $transaction, $isAdmin = false){
        try{
            Mail::to($email)->send(new OrderConfirmation($transaction, $isAdmin));
        } catch (Exception $exception){
            session()->flash('warning', [$exception->getMessage()]);
        }
    }
}
