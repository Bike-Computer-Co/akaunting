<?php

namespace PaymentGatewayJson\Client\Transaction\Base;

use PaymentGatewayJson\Client\Data\ThreeDSecureData;

/**
 * Interface ThreeDSecureInterface
 */
interface ThreeDSecureInterface
{
    /**
     * @return ThreeDSecureData
     */
    public function getThreeDSecureData();

    /**
     * @param  ThreeDSecureData  $threeDSecureData
     * @return mixed
     */
    public function setThreeDSecureData($threeDSecureData);
}
