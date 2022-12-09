<?php

namespace PaymentGateway\Client\Data\Result;

/**
 * Class ResultData
 */
abstract class ResultData
{
    /**
     * @return array
     */
    abstract public function toArray();
}
