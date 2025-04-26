<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordNotification extends ResetPasswordNotification implements ShouldQueue
{

    use Queueable;
    /**
     * Get the notification's mail representation.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Réinitialisation de votre mot de passe')
                    ->greeting('Bonjour!')
                    ->line('Nous avons reçu une demande pour réinitialiser votre mot de passe.')
                    ->action('Réinitialiser le mot de passe', url(route('password.reset', $this->token, false)))
                    ->line('Si vous n\'êtes pas à l\'origine de cette demande, aucune autre action n\'est nécessaire.')
                    ->salutation('Cordialement, ' . config('app.name'));
    }
}
