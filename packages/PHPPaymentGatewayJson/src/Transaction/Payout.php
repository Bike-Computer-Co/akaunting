<?php

namespace PaymentGatewayJson\Client\Transaction;

use PaymentGatewayJson\Client\Transaction\Base\AbstractTransactionWithReference;
use PaymentGatewayJson\Client\Transaction\Base\AmountableInterface;
use PaymentGatewayJson\Client\Transaction\Base\AmountableTrait;
use PaymentGatewayJson\Client\Transaction\Base\CustomerInterface;
use PaymentGatewayJson\Client\Transaction\Base\CustomerTrait;
use PaymentGatewayJson\Client\Transaction\Base\ItemsInterface;
use PaymentGatewayJson\Client\Transaction\Base\ItemsTrait;
use PaymentGatewayJson\Client\Transaction\Base\OffsiteInterface;
use PaymentGatewayJson\Client\Transaction\Base\OffsiteTrait;

/**
 * Payout: Payout a certain amount of money to the customer. (Debits the merchant's account, Credits the customer's account)
 */
class Payout extends AbstractTransactionWithReference implements AmountableInterface, CustomerInterface, ItemsInterface, OffsiteInterface
{
    use AmountableTrait;
    use CustomerTrait;
    use ItemsTrait;
    use OffsiteTrait;

    /** @var string */
    protected $transactionToken;

    /** @var string */
    protected $language;

    /**
     * @return string
     */
    public function getTransactionToken()
    {
        return $this->transactionToken;
    }

    /**
     * @param  string  $transactionToken
     */
    public function setTransactionToken($transactionToken)
    {
        $this->transactionToken = $transactionToken;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param  string  $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }
}
