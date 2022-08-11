<?php

namespace Modules\NlbBank\Http\Controllers;

use App\Abstracts\Http\PaymentController;
use App\Models\Document\Document;
use App\Traits\Omnipay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PaymentGatewayJson\Client\Client;
use PaymentGatewayJson\Client\Data\Customer;
use PaymentGatewayJson\Client\Transaction\Debit;
use PaymentGatewayJson\Client\Transaction\Result;

class Payment extends PaymentController
{
//    use Omnipay;

    public $alias = 'nlb-bank';

    public $type = 'redirect';

    public function confirm(Document $invoice, Request $request)
    {
        $client = new Client(
            $this->setting['api_username'],
            $this->setting['api_password'],
            $this->setting['api_key'],
            $this->setting['shared_secret'],
        );

        $debit = new Debit();
        $debit
            ->setMerchantTransactionId($invoice->id)
            ->setAmount($invoice->amount)
            ->setCurrency($invoice->currency_code)
            ->setSuccessUrl($this->getModuleUrl($invoice, 'success'))
            ->setCancelUrl($this->getCancelUrl($invoice))
            ->setErrorUrl($this->getModuleUrl($invoice, 'error'))
            ->setCallbackUrl($this->getReturnUrl($invoice));

        $this->setContactFirstLastName($invoice);
        $customer = new Customer();
        $customer
            ->setFirstName($invoice->first_name)
            ->setLastName($invoice->first_name)
            ->setIdentification($invoice->contact_id)
            ->setEmail($invoice->contact_email)
            ->setIpAddress($request->ip());

        $debit->setCustomer($customer);
        $result = $client->debit($debit);

        $returnType = $result->getReturnType();

        if ($returnType == Result::RETURN_TYPE_ERROR) {
            Log::error("Payment Error\Invoice:\n" . json_encode($invoice) . "\nResponse:\n");
            return response()->json([
                'error' => $result->getFirstError(),
                'redirect' => false,
                'success' => false,
                'data' => false,
            ]);
        } elseif ($returnType == Result::RETURN_TYPE_REDIRECT) {

            $this->setReference($invoice, $result->getUuid());
            return response()->json([
                'error' => false,
                'redirect' => $result->getRedirectUrl(),
                'success' => false,
                'data' => $result->getReturnData(),
            ]);

        }

    }

    public function return(Document $invoice, Request $request)
    {
//        $this->create('PayPal_Express');
//
//        return $this->completePurchase($invoice, $request, [
//            'username' => $this->setting['username'],
//            'password' => $this->setting['password'],
//            'signature' => $this->setting['signature'],
//            'testMode' => ($this->setting['mode'] == 'test'),
//        ]);
    }


}
