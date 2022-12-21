<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GiftCardNotification extends Notification
{
    use Queueable;

    private Request $request;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request_validated = $request;
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
            ->subject('Апликација за ваучер | Digitalhub.mk')
            ->line(['Почитуван/а  ', $this->request_validated['name_surname']])
            ->line('Вашата апликација за вредносен ваучер е добиена')
            ->line('Ке бидете контактирани наскоро')
            ->line($this->request_validated['code'])
            ->salutation('Со почит -Digitalhub.mk');
    }
}
