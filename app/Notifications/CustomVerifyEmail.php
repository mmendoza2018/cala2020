<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends VerifyEmailNotification
{
    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Generar el enlace de verificación manualmente
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Verifica tu dirección de correo electrónico')
            ->greeting('¡Hola!')
            ->line('Gracias por registrarte. Por favor, verifica tu correo haciendo clic en el botón a continuación.')
            ->action('Verificar correo', $verificationUrl)
            ->line('Si no solicitaste la creación de una cuenta, no es necesario que hagas nada.')
            ->salutation('Saludos, ' . config('app.name'))
            ->markdown('emails.verify', ['url' => $verificationUrl]);
    }

    /**
     * Genera la URL de verificación de correo electrónico.
     *
     * @param mixed $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }
}
