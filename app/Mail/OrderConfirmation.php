<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class OrderConfirmation
 * @package App\Mail
 */
class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    /**
     * @var false|mixed
     */
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
        $subject = $this->isAdmin ? 'New Order has been placed' : 'Your Order has been confirmed';
        return $this->subject($subject)->from('no-reply@superfreighters.com', config('app.name'))->markdown('emails.orders.confirmation');
    }
}
