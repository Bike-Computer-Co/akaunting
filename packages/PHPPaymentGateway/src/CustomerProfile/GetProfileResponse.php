<?php

namespace PaymentGateway\Client\CustomerProfile;

use PaymentGateway\Client\Json\ResponseObject;

/**
 * Class GetProfileResponse
 *
 *
 * @property bool $profileExists
 * @property string $profileGuid
 * @property string $customerIdentification
 * @property string $preferredMethod
 * @property CustomerData $customer
 * @property PaymentInstrument[] $paymentInstruments
 */
class GetProfileResponse extends ResponseObject
{
}
