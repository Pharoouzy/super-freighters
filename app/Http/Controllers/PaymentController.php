<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Handler\PaymentHandler;
use Illuminate\Support\Facades\DB;

/**
 * Class PaymentController
 * @package App\Http\Controllers
 */
class PaymentController extends Controller {

    private $payment;

    public function __construct() {
        $this->payment = new PaymentHandler();
    }

    public function verify(Request $request) {
        return $this->payment->verifyPayment($request);
    }

    public function status(){

        return view('pages.app.payment-status');
    }
}
