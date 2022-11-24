<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use phpDocumentor\Reflection\Types\This;

class RegisterCompanyRequestNotification extends Notification
{
    use Queueable;

    private array $data;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {


        $data = $this->data;
        return (new MailMessage)
            ->subject('Барање за регистрирање на фирма')
            ->greeting('Здраво Иван,')
            ->line("Имате нова порака од $data[name]")
            ->line("")
            ->line("Форма 1: $data[merchant]")
            ->line("Назив на Друштвото: $data[company_name]")
            ->line("")
            ->line("Податоци за основач на друштво:")
            ->line("Име: $data[name]")
            ->line("Презиме: $data[address]")
            ->line("ЕМБГ: $data[personal_id]")
            ->line("Тел. број: $data[phone]")
            ->line("Електронска пошта: $data[email]")
            ->line("")
            ->line("Податоци за управител:")
            ->line("Податоците за управителот се исти со податоците на основачот: $data[same_director_button]")
            ->line("Име: $data[name_director]")
            ->line("Презиме: $data[address_director]")
            ->line("ЕМБГ: $data[personal_id_director]")
            ->line("Банка: $data[bank]")
            ->line("")
            ->line("Седиште на Фирма:")
            ->line("Адреса:")
            ->line("улица:  $data[street]")
            ->line("број:  $data[number]")
            ->line("град: $data[city]")
            ->line("")
            ->line("Адреса на подружница:")
            ->line("Адресата на подружницата е иста со седиштето на фирмата:  $data[same_address_button]")
            ->line("")
            ->line("Адреса:")
            ->line("улица:  $data[street_partner]")
            ->line("број:  $data[number_partner]")
            ->line("град:  $data[city_partner]")
            ->line("")
            ->line("Дејност со која ќе се занимава - Шифра: $data[selected_activity]")
            ->line("")
            ->line("Основна главина:")
            ->line("Внесување на главина: $data[option_1]")
            ->line("Влог: $data[option_2]")
            ->salutation("Поздрав, $data[name]");

    }
}
