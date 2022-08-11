<?php

namespace Modules\NlbBank\Http\Controllers;

use App\Abstracts\Http\PaymentController;
use App\Models\Document\Document;
use App\Traits\Omnipay;
use Illuminate\Http\Request;

class Payment extends PaymentController
{
    use Omnipay;

    public $alias = 'nlb-bank';

    public $type = 'redirect';

    public function confirm(Document $invoice, Request $request)
    {
        $this->create('PayPal_Express');

        return $this->purchase($invoice, $request, [
            'username' => $this->setting['username'],
            'password' => $this->setting['password'],
            'signature' => $this->setting['signature'],
            'testMode' => ($this->setting['mode'] == 'test'),
        ]);
    }

    public function return(Document $invoice, Request $request)
    {
        $this->create('PayPal_Express');

        return $this->completePurchase($invoice, $request, [
            'username' => $this->setting['username'],
            'password' => $this->setting['password'],
            'signature' => $this->setting['signature'],
            'testMode' => ($this->setting['mode'] == 'test'),
        ]);
    }
}
