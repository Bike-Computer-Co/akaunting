<?php

namespace App\Notifications;

use App\Models\Common\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AccountantStatementNotification extends Notification
{
    use Queueable;


    private string $zipFile;
    private Company $company;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($zipFile, Company $company)
    {
        $this->zipFile = $zipFile;
        $this->company = $company;
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
        $name = $this->company->name;

        return (new MailMessage)
            ->subject("Податоци за  $name | Digitalhub.mk")
            ->line('Почитуван/а сметководител')
            ->line('Ви испраќаме податоци за компанијата на која сте сметководител зa претходната недела')
            ->salutation('Со почит - Digitalhub.mk')
            ->attach($this->zipFile);


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
