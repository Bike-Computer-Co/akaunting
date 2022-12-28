<?php

namespace App\Jobs;

use App\Models\GiftCodeApplicant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class GiftCodeApplicantDiscordNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private GiftCodeApplicant $applicant;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(GiftCodeApplicant $applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Http::post('https://discord.com/api/webhooks/1057698808810709085/jXROf7PqBb5BZwlqDCVWMzvGsIGwFIKtpJMCQZWnohuhUEbp-PFQpM4DZdVHKS7wzU3u',
            [
                'content' => 'Ново барање за ваучер',
                'embeds' => [[
                    'title' => 'Направено е ново барање за ваучер',
                    'description' => $this->applicant->name_surname.' направи ново барање за ваучер',
                    'color' => '7506394',
                ]],
            ]);
    }
}
