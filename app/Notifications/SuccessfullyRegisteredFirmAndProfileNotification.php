<?php

namespace App\Notifications;

use App\Models\Auth\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SuccessfullyRegisteredFirmAndProfileNotification extends Notification
{
    use Queueable;

    private User $user;

    private $resetPasswordUrl;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, $resetPasswordUrl)
    {
        $this->user = $user;
        $this->resetPasswordUrl = $resetPasswordUrl;
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
            ->subject('Успешно регистрирана фирма и креирање на профил | Digitalhub.mk')
            ->greeting('Почитувани, '.$this->user->name)
            ->line('Успешно е регистрирана вашата фирма и е креиран Вашиот профил на Digitalhub.mk.')
            ->line('Вашите параметри за најава се:')
            ->line('Е-пошта: '.$this->user->email)
            ->line('За да се најавите на Вашиот профил ресетирајте ја вашата лозинка со клик на копчето подолу.')
            ->action('Ресетирај лозинка', $this->resetPasswordUrl)
            ->line('За дополнителни информации околу регистрацијата на Вашата фирма и профилот на Digitalhub.mk, контактирајте не')
            ->salutation('Со почит, Digitalhub.mk');
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
