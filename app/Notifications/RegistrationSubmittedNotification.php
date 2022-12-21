<?php

namespace App\Notifications;

use App\Models\FirmRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegistrationSubmittedNotification extends Notification
{
    use Queueable;

    private FirmRegistration $firmRegistration;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(FirmRegistration $firmRegistration)
    {
        $this->firmRegistration = $firmRegistration;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Направена е регистрација на фирма | Digitalhub.mk')
            ->line('Направена е регистрација на фирма.')
            ->action('Погледни регистрација', route('super.firm-registrations.show', $this->firmRegistration->id))
            ->salutation('Digitalhub.mk');
    }
}
