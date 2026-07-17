<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionExpiringMail;
use App\Models\Subscription;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendSubscriptionExpiryReminders extends Command
{
    protected $signature = 'subscriptions:remind';

    protected $description = 'Отправка напоминаний об окончании абонемента';

    public function handle(): int
    {
        $targetDate = now()->addDays(7)->toDateString();

        $subscriptions = Subscription::with('user')
            ->where('status', 'active')
            ->whereDate('expires_at', $targetDate)
            ->whereNull('expiry_notification_sent_at')
            ->get();

        foreach ($subscriptions as $subscription) {

            if (!$subscription->user?->email) {
                continue;
            }

            Mail::to($subscription->user->email)
                ->send(new SubscriptionExpiringMail($subscription));

            $subscription->update([
                'expiry_notification_sent_at' => now(),
            ]);

            $this->info(
                "Отправлено: {$subscription->user->email}"
            );
        }

        return self::SUCCESS;
    }
}