<?php

namespace App\Notifications;

use Tenancy\Facades\Tenancy;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as Notification;

class ResetPassword extends Notification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     *
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        $url = config('app.url');

        if ($tenant = Tenancy::getTenant()) {
            $url = str_replace(config('app.domain'), '', $url) . $tenant->fqdn;
        }

        $url = url($url.'/password/reset/'.$this->token).'?email='.urlencode($notifiable->getEmailForPasswordReset());

        return $this->buildMailMessage($url);
    }
}
