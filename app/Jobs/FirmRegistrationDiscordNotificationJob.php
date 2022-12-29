<?php

namespace App\Jobs;

use App\Models\FirmRegistration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class FirmRegistrationDiscordNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private FirmRegistration $firmRegistration;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(FirmRegistration $firmRegistration)
    {
        $this->firmRegistration = $firmRegistration;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Http::post('https://discord.com/api/webhooks/1046212450728558673/p8b65u_Fa4C2QiLYV4aDwUfWJSZJzHVMWu7TjS3VBerdJgvV_k1xbgSYVjmxtTbEpP4f',
            [
                'content' => 'Нова регистрација на фирма',
                'embeds' => [[
                    'title' => 'Направена е нова регистрација на фирма',
                    'description' => $this->firmRegistration->founder_name.' направи нова регистрација на фирма со име '.$this->firmRegistration->firm_name,
                    'color' => '7506394',
                ]],
            ]);
    }
}
