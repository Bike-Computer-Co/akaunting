<?php

namespace PaymentGateway\Client\CustomerProfile\PaymentData;

/**
 * Class WalletData
 *
 *
 * @property string $walletReferenceId
 * @property string $walletOwner
 * @property string $walletType
 */
class WalletData extends PaymentData
{
    const TYPE_PAYPAL = 'paypal';
}
