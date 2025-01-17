<?php

use PaymentGateway\Client\Client;
use PaymentGateway\Client\Data\Customer;
use PaymentGateway\Client\Schedule\ScheduleData;
use PaymentGateway\Client\Transaction\Debit;
use PaymentGateway\Client\Transaction\Result;

require_once '../initClientAutoload.php';
//get customers IP
function getRealIpAddr()
{
    if (! empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

//PajmentJS indicator
$token = null;
if (isset($_POST['transaction_token'])) {
    $token = $_POST['transaction_token'];
}
// Use gateway schadule or merchant send a sub sequent transaction in period.
//true-use gateway schadule
//false-merchant create own schadule
$gatewaySchadule = 'off';
if (isset($_POST['gatewaySchadule'])) {
    $gatewaySchadule = $_POST['gatewaySchadule'] === 'on' ? 'on' : 'off';
}
//Initial transaction with stored card(prewious or now)
$initialStoreTrans = 'No';
if (isset($_POST['initialStoreTrans'])) {
    $initialStoreTrans = $_POST['initialStoreTrans'];
}
//Sub-sequent transaction with stored card
$subSeqentTrans = 'No';
if (isset($_POST['subSeqentTrans'])) {
    $subSeqentTrans = $_POST['subSeqentTrans'];
}
// Schadule in case of Recurring transaction
$scheduleUnit = 'DAY';
if (isset($_POST['scheduleUnit'])) {
    $scheduleUnit = $_POST['scheduleUnit'];
}
$schedulePeriod = '1';
if (isset($_POST['schedulePeriod'])) {
    $schedulePeriod = $_POST['schedulePeriod'];
}
$scheduleDelay = '';
if (isset($_POST['scheduleDelay'])) {
    $scheduleDelay = $_POST['scheduleDelay'];
}
$refTranId = '';
if (isset($_POST['refTranId'])) {
    $refTranId = $_POST['refTranId'];
}
$amount = '0';
if (isset($_POST['Amount'])) {
    $amount = $_POST['Amount'];
}

$client = new Client('username', 'password', 'apiKey', 'sharedSecret', 'language');

$customer = new Customer();
$customer
    ->setFirstName($_POST['first_name'])
    ->setLastName($_POST['last_name'])
    ->setEmail($_POST['email'])
    ->setIpAddress(getRealIpAddr())
    ->setBillingAddress1('Street 1')
    ->setBillingCity('City')
    ->setBillingPostcode('1000')
    ->setBillingCountry('SI');
//add further customer details if necessary

// define your transaction ID: e.g. 'myId-'.date('Y-m-d').'-'.uniqid()
$merchantTransactionId = 'D-'.date('Y-m-d').'-'.uniqid(); // must be unique

$currency = $_POST['Currency'];
$debit = new Debit();
$debit->setTransactionId($merchantTransactionId)
    ->setAmount($amount)
    ->setCurrency($currency)
    ->setCallbackUrl('https://{HOST}/PHPPaymentGateway/examples/Callback.php')
    ->setSuccessUrl('http://{HOST}/PHPPaymentGateway/examples/PaymentOK.php')
    ->setErrorUrl('http://{HOST}/PHPPaymentGateway/examples/PaymentNOK.php')
    ->setCancelUrl('http://{HOST}/PHPPaymentGateway/examples/PaymentCancel.php')
    ->setDescription('One pair of shoes')
    ->setMerchantMetaData('Transaction:Debit;Description:test')
    ->setCustomer($customer);
// Add Extra data
if (isset($_POST['numInstalment'])) {
    $debit->addExtraData('userField1', $_POST['numInstalment']);  //  If you have an agreement with your acquiring banks to offer payments in installments,
    //userField1 is used and becomes mandatory. In such cases send 00 or 01 when no installments are selected.
    //In case of an invalid value, the payment will be declined.
}
//if token acquired via payment.js
if (isset($token)) {
    $debit->setTransactionToken($token);
}
switch ($initialStoreTrans) {
    case 'No':
        switch($subSeqentTrans) {
            case 'No':  //normal debit
                $debit->setWithRegister(false)
                    ->setTransactionIndicator('SINGLE');
                break;
            case 'subSeqentCoF': //subsequent CoF - normal transaction with stored card
                $debit->setReferenceTransactionId($refTranId)
                    ->setTransactionIndicator('CARDONFILE');
                break;
            case 'subSeqentRec':    //subsequent Recurring - Note: If jou send schedule on initialization
                //you don’t need to do that.
                $debit->setReferenceTransactionId($refTranId)
                    ->setTransactionIndicator('RECURRING');
                break;

            case 'subSeqentMIT': //subsequent MIT
                $debit->setReferenceTransactionId($refTranId)
                    ->setTransactionIndicator('CARDONFILE-MERCHANT-INITIATED');
                break;
        }
        break;

    case 'initialCoF': // debit & store card for future use
        $debit->setWithRegister(true);
        $debit->setTransactionIndicator('SINGLE');
        $debit->addExtraData('3ds:authenticationIndicator', '04'); //04-add card
        break;

    case 'initialRec':
        if (floatval($amount) == 0) {
            echo 'Initial recurring is not possible with amount:'.$amount;
            exit;
        }
        if (strlen($refTranId) > 0) { //Recurring establish with already stored card
            $debit->setReferenceTransactionId($refTranId);
        }
        $debit->setWithRegister(true)
            ->setTransactionIndicator('INITIAL')
            ->addExtraData('3ds:authenticationIndicator', '02') //02-recurring+MIT
            ->addExtraData('3ds:recurringFrequency', '2'); //!1->Recurring; no connections with $schedulePeriod
        //if gateway do a sub-sequent transactions
        if ($gatewaySchadule == 'on') {
            //create schedular
            $myScheduleData = new ScheduleData();
            $myScheduleData->setPeriodUnit($scheduleUnit) // The units are 'DAY','WEEK','MONTH','YEAR'
                ->setPeriodLength($schedulePeriod)
                ->setAmount($amount)
                ->setCurrency($currency);

            //Delay for first sub sequent transaction
            if (strlen($scheduleDelay) > 0) { //if dellay for first sub-sequent transaction is set
                $date = new DateTime('now', new DateTimeZone('Europe/Ljubljana'));
                $date->modify($_POST['scheduleDelay']);
                $myScheduleData->setStartDateTime($date);
            }

            //add Schedular to debit transaction
            $debit->setSchedule($myScheduleData);
        }

        break;

    case 'initialMIT': //debit with MIT establishe
        if (floatval($amount) == 0) {
            echo 'Initial recurring is not possible with amount:'.$amount;
            exit;
        }
        if (strlen($refTranId) > 0) { //MIT establish with already stored card
            $debit->setReferenceTransactionId($refTranId);
        }
        $debit->setWithRegister(true)
            ->setTransactionIndicator('INITIAL')
            ->addExtraData('3ds:authenticationIndicator', '02') //02-recurring+MIT
            ->addExtraData('3ds:recurringFrequency', '1'); //1 -> MIT
        break;
}

$result = $client->debit($debit);

$gatewayReferenceId = $result->getReferenceId(); //store it in your database

if ($result->getReturnType() == Result::RETURN_TYPE_ERROR) {
    //error handling Sample
    $error = $result->getFirstError();
    $outError = [];
    $outError['message'] = $error->getMessage();
    $outError['code'] = $error->getCode();
    $outError['adapterCode'] = $error->getAdapterCode();
    $outError['adapterMessage'] = $error->getAdapterMessage();
    header('Location: https://{HOST}/PHPPaymentGateway/examples/PaymentNOK.php?'.http_build_query($outError));
    exit;
} elseif ($result->getReturnType() == Result::RETURN_TYPE_REDIRECT) {
    //redirect the user
    header('Location: '.$result->getRedirectUrl());
    exit;
} elseif ($result->getReturnType() == Result::RETURN_TYPE_PENDING) {
    //payment is pending, wait for callback to complete
    // not for credit card transactions
    //setCartToPending();
} elseif ($result->getReturnType() == Result::RETURN_TYPE_FINISHED) {
    //payment is finished, update your cart/payment transaction
    header('Location: https://{HOST}/PHPPaymentGateway/examples/PaymentOK.php?'.http_build_query($result->toArray()));
    exit;
    //finishCart();
}
