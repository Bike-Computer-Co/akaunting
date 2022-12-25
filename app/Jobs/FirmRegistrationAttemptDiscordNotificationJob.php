<?php

namespace App\Jobs;

use App\Models\FirmRegistrationAttempt;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class FirmRegistrationAttemptDiscordNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private FirmRegistrationAttempt $firmRegistrationAttempt;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FirmRegistrationAttempt $firmRegistrationAttempt)
    {
        $this->firmRegistrationAttempt = $firmRegistrationAttempt;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Http::post('https://discord.com/api/webhooks/1056711621831045120/TtWbKVB5ukYtQMI2c3BAl9TzpMtSDjc30XH99aC16vEmFbwtTZJKigNymbhpAs5r-SaN',
            [
                'content' => 'Нов обид за регистрација на фирма',
                'embeds' => [[
                    'title' => 'Направен е нов обид за регистрација на фирма',
                    'description' => $this->firmRegistrationAttempt->name.' направи нов обид за  регистрација на фирма. Е-пошта на корисникот: '.$this->firmRegistrationAttempt->email.'. Тел. број на корисникот: '.$this->firmRegistrationAttempt->phone,
                    'color' => '7506394',
                ]],
            ]);
    }
}
