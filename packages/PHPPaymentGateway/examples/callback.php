<?php

use PaymentGateway\Client\Client;
use PaymentGateway\Client\Callback\Result;

require_once('../initClientAutoload.php');

$client = new Client('username', 'password', 'apiKey', 'sharedSecret');

//if you want to check signature uncoment if statement 
/*
if ($client->validateCallbackWithGlobals() == false){
    //the signature is incorrect. It is your decision what to do
    
}
*/

$callbackResult = $client->readCallback(file_get_contents('php://input'));  

$myTransactionId = $callbackResult->getTransactionId();
$gatewayTransactionId = $callbackResult->getReferenceId();

if ($callbackResult->getResult() == Result::RESULT_OK) {
    //payment ok
	$callbackResult->getResult();

    //finishCart();

} elseif ($callbackResult->getResult() == Result::RESULT_ERROR) {
    //payment failed, handle errors
    $errors = $callbackResult->getErrors();

}

echo "OK";
die;