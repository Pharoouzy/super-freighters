<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $transaction, $isAdmin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transaction, $isAdmin = false) {
        $this->transaction = $transaction;
        $this->isAdmin = $isAdmin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Payment Receipt')->from('no-reply@superfreighters.com', config('app.name'))->markdown('emails.payments.receipt');
    }
}
