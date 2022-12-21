<?php

namespace App\Notifications;

use App\Models\FirmRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuccessfullySentRegistrationNotification extends Notification
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
            ->subject('Успешно е испратена регистрација за фирма | Digitalhub.mk')
            ->greeting('Почитувани,')
            ->line('Вашата регистрација на фирма е успешно испратена.')
            ->line('Ќе бидете исконтактирани и известени за понатамошни инструкции.')
            ->salutation('Со почит, Digitalhub.mk');
    }
}
