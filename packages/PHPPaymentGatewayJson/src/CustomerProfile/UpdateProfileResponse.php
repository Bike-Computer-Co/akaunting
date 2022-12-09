<?php

namespace PaymentGatewayJson\Client\CustomerProfile;

use PaymentGatewayJson\Client\Json\ResponseObject;

/**
 * Class UpdateProfileResponse
 *
 *
 * @property string       $profileGuid
 * @property string       $customerIdentification
 * @property CustomerData $customer
 * @property array        $changedFields
 */
class UpdateProfileResponse extends ResponseObject
{
}
