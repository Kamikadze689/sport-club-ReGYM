<?php

namespace App\Mail;

use App\Models\Subscription;
use Illuminate\Mail\Mailable;

class SubscriptionExpiringMail extends Mailable
{
    public function __construct(
        public Subscription $subscription
    ) {}

    public function build()
    {
        return $this
            ->subject('Ваш абонемент скоро закончится')
            ->view('emails.subscription-expiring');
    }
}