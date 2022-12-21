<?php

namespace App\Notifications;

use App\Models\FirmRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FirmEnrollmentUploadedNotification extends Notification
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
            ->subject('Прикачено решение за упис | Digitalhub.mk')
            ->greeting('Иван, Јоцка, Душан, Мартин')
            ->line('Успешно е прикачено решение за упис на фирма..')
            ->line('Истата може да биде регистрирана на app.digitalhub.mk.')
            ->action('Погледни решение', $this->firmRegistration->enrollmentDecision->full_source)
            ->salutation('Со почит, Јоцка');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
