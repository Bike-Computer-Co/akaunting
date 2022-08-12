<?php

namespace Modules\NlbBank\Http\Controllers;

use App\Abstracts\Http\PaymentController;
use App\Models\Document\Document;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use PaymentGateway\Client\Client;
use PaymentGateway\Client\Data\Customer;
use PaymentGateway\Client\Transaction\Debit;
use PaymentGateway\Client\Transaction\Result;

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
            ->setTransactionId(Str::uuid())
            ->setDescription('test')
            ->setAmount($invoice->amount)
            ->setCurrency('MKD')
            ->setCancelUrl($this->getCancelUrl($invoice))
            ->setSuccessUrl($this->getModuleUrl($invoice, 'success'))
            ->setErrorUrl($this->getModuleUrl($invoice, 'error'))
            ->setCallbackUrl($this->getModuleUrl($invoice, 'callback'));

        $customer = new Customer();
        $customer
            ->setFirstName($invoice->contact_name)
            ->setLastName('test')
            ->setBillingAddress1($invoice->contact_address)
            ->setBillingPostcode($invoice->contact_zip_code)
            ->setBillingCity($invoice->contact_city)
            ->setIdentification($invoice->contact_id)
            ->setBillingCountry('MK')
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

            $this->setReference($invoice, $result->getReferenceId());
            return response()->json([
                'error' => false,
                'redirect' => $result->getRedirectUrl(),
                'success' => false,
                'data' => $result->getReturnData(),
            ]);

        }

    }

    public function success(Document $invoice, Request $request)
    {
        $message = trans('messages.success.added', ['type' => trans_choice('general.payments', 1)]);

        $this->logger->info($this->module->getName() . ':: Invoice: ' . $invoice->id . ' - Success Message: ' . $message);

        flash($message)->success();

        $finish_url = $this->getFinishUrl($invoice);

        if ($request->force_redirect || $this->type == 'redirect') {
            return redirect($finish_url);
        }

        return response()->json([
            'error' => $message,
            'redirect' => $finish_url,
            'success' => true,
            'data' => false,
        ]);
    }

    public function error(Document $invoice, Request $request)
    {
        $message = "There was error processing your payment";
        if (isset($data['error'])) {
            $this->logger->info($this->module->getName() . ':: Invoice: ' . $invoice->id . ' - Error Type: ' . $data['error']['type'] . ' - Error Message: ' . $message);
        } else {
            $this->logger->info($this->module->getName() . ':: Invoice: ' . $invoice->id . ' - Error Message: ' . $message);
        }

        $invoice_url = $this->getInvoiceUrl($invoice);

        flash($message)->error()->important();

        if ($request->force_redirect || $this->type == 'redirect') {
            return redirect($invoice_url);
        }

        return response()->json([
            'error' => $message,
            'redirect' => $invoice_url,
            'success' => false,
            'data' => false,
        ]);
    }


    public function callback(Document $invoice, Request $request)
    {
        $client = new Client(
            $this->setting['api_username'],
            $this->setting['api_password'],
            $this->setting['api_key'],
            $this->setting['shared_secret'],
        );
        $client->validateCallbackWithGlobals();
        $callbackResult = $client->readCallback(file_get_contents('php://input'));

        //
//        $transactionId = $callbackResult->getTransactionId();
//        $gatewayReferenceId = $callbackResult->getReferenceId();


        if ($callbackResult->getResult() == \PaymentGateway\Client\Callback\Result::RESULT_OK) {
            $this->dispatchPaidEvent($invoice, $request);
            $this->forgetReference($invoice);
        }
        return 'OK';
    }

}
