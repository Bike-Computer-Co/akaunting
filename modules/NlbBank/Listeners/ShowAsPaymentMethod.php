<?php

namespace Modules\NlbBank\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\Module\PaymentMethodShowing as Event;
class ShowAsPaymentMethod
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Event $event)
    {
        $method = setting('nlb-bank');

        $method['code'] = 'nlb-bank';

        $event->modules->payment_methods[] = $method;
    }
}
