<?php

namespace PaymentGatewayJson\Client\Json;

use PaymentGatewayJson\Client\Client;
use PaymentGatewayJson\Client\Data\CreditCardCustomer;
use PaymentGatewayJson\Client\Data\Customer;
use PaymentGatewayJson\Client\Data\CustomerProfileData;
use PaymentGatewayJson\Client\Data\IbanCustomer;
use PaymentGatewayJson\Client\Data\Item;
use PaymentGatewayJson\Client\Data\PaymentData\IbanData;
use PaymentGatewayJson\Client\Data\PaymentData\PaymentData;
use PaymentGatewayJson\Client\Data\PaymentData\WalletData;
use PaymentGatewayJson\Client\Data\ThreeDSecureData;
use PaymentGatewayJson\Client\Schedule\ContinueSchedule;
use PaymentGatewayJson\Client\Schedule\ScheduleData;
use PaymentGatewayJson\Client\Schedule\ScheduleWithTransaction;
use PaymentGatewayJson\Client\Schedule\StartSchedule;
use PaymentGatewayJson\Client\Transaction\Base\AbstractTransaction;
use PaymentGatewayJson\Client\Transaction\Capture;
use PaymentGatewayJson\Client\Transaction\Debit;
use PaymentGatewayJson\Client\Transaction\Deregister;
use PaymentGatewayJson\Client\Transaction\IncrementalAuthorization;
use PaymentGatewayJson\Client\Transaction\Payout;
use PaymentGatewayJson\Client\Transaction\Preauthorize;
use PaymentGatewayJson\Client\Transaction\Refund;
use PaymentGatewayJson\Client\Transaction\Register;
use PaymentGatewayJson\Client\Transaction\VoidTransaction;

/**
 * Class Generator
 */
class JsonGenerator
{
    /**
     * @param    $method
     * @param  AbstractTransaction  $transaction
     * @param  null  $language
     * @return array
     */
    public function generateTransaction($method, AbstractTransaction $transaction, $language = null)
    {
        // common
        $json = [
            'merchantTransactionId' => $transaction->getMerchantTransactionId(),
            'additionalId1' => $transaction->getAdditionalId1(),
            'additionalId2' => $transaction->getAdditionalId2(),
            'extraData' => $this->stringifyExtraData($transaction->getExtraData()),
            'merchantMetaData' => $transaction->getMerchantMetaData(),
        ];

        // type specific
        switch($method) {
            case 'debit':
                $json = array_merge($json, $this->createDebit($transaction, $language));
                break;
            case 'preauthorize':
                $json = array_merge($json, $this->createPreauthorize($transaction, $language));
                break;
            case 'incrementalAuthorization':
                $json = array_merge($json, $this->createIncrementalAuthorization($transaction, $language));
                break;
            case 'capture':
                $json = array_merge($json, $this->createCapture($transaction));
                break;
            case 'void':
                $json = array_merge($json, $this->createVoid($transaction));
                break;
            case 'register':
                $json = array_merge($json, $this->createRegister($transaction, $language));
                break;
            case 'deregister':
                $json = array_merge($json, $this->createDeregister($transaction));
                break;
            case 'refund':
                $json = array_merge($json, $this->createRefund($transaction));
                break;
            case 'payout':
                $json = array_merge($json, $this->createPayout($transaction, $language));
                break;
        }

        $this->purgeNullValues($json);

        return $json;
    }

    /**
     * @param  string  $action
     * @param  ScheduleData|StartSchedule|ContinueSchedule|string  $scheduleData
     * @return array|null
     */
    public function generateSchedule($action, $scheduleData)
    {
        $json = [];

        switch($action) {
            case Client::SCHEDULE_ACTION_START:
                /* backwards compatible */
                if ($scheduleData instanceof ScheduleData) {
                    $json = [
                        'registrationUuid' => $scheduleData->getRegistrationUuid(),
                        'amount' => $scheduleData->getAmount(),
                        'currency' => $scheduleData->getCurrency(),
                        'periodLength' => $scheduleData->getPeriodLength(),
                        'periodUnit' => $scheduleData->getPeriodUnit(),
                        'startDateTime' => $scheduleData->getStartDateTimeFormatted(\DateTime::ATOM),
                        'merchantMetaData' => $scheduleData->getMerchantMetaData(),
                    ];
                } else {
                    /** @var StartSchedule $scheduleData */
                    $json = $scheduleData->toArray();
                }

                break;

            case Client::SCHEDULE_ACTION_SHOW:
            case Client::SCHEDULE_ACTION_PAUSE:
            case Client::SCHEDULE_ACTION_CANCEL:
                // empty body
                break;

            case Client::SCHEDULE_ACTION_CONTINUE:
                $json = [
                    'continueDateTime' => $scheduleData->getContinueDateTimeFormatted(\DateTime::ATOM),
                ];

                break;
        }

        $this->purgeNullValues($json);

        return $json;
    }

    /**
     * debit specific data
     *
     * @param $transaction
     * @param $language
     * @return array
     */
    protected function createDebit($transaction, $language)
    {
        /** @var Debit $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceUuid(),
            'amount' => (string) $transaction->getAmount(),
            'currency' => $transaction->getCurrency(),
            'successUrl' => $transaction->getSuccessUrl(),
            'cancelUrl' => $transaction->getCancelUrl(),
            'errorUrl' => $transaction->getErrorUrl(),
            'callbackUrl' => $transaction->getCallbackUrl(),
            'transactionToken' => $transaction->getTransactionToken(),
            'description' => $transaction->getDescription(),
            'items' => $this->createItems($transaction->getItems()),
            'withRegister' => $transaction->isWithRegister(),
            'transactionIndicator' => $transaction->getTransactionIndicator(),
            'customer' => $this->createCustomer($transaction->getCustomer()),
            'schedule' => $this->createSchedule($transaction->getSchedule()),
            'customerProfileData' => $this->createAddToCustomerProfile($transaction->getCustomerProfileData()),
            'threeDSecureData' => $this->createThreeDSecureData($transaction->getThreeDSecureData()),
            'language' => $language,
        ];

        return $data;
    }

    /**
     * preauthorize and debit require the same data
     *
     * @param $transaction
     * @param $language
     * @return array
     */
    protected function createPreauthorize($transaction, $language)
    {
        /** @var Preauthorize $transaction */
        return $this->createDebit($transaction, $language);
    }

    protected function createIncrementalAuthorization($transaction, $language)
    {
        /** @var IncrementalAuthorization $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceUuid(),
            'amount' => (string) $transaction->getAmount(),
            'currency' => $transaction->getCurrency(),
            'successUrl' => $transaction->getSuccessUrl(),
            'cancelUrl' => $transaction->getCancelUrl(),
            'errorUrl' => $transaction->getErrorUrl(),
            'callbackUrl' => $transaction->getCallbackUrl(),
            'description' => $transaction->getDescription(),
            'items' => $this->createItems($transaction->getItems()),
            'transactionIndicator' => $transaction->getTransactionIndicator(),
            'language' => $language,
        ];

        return $data;
    }

    /**
     * capture specific data
     *
     * @param $transaction
     * @return array
     */
    protected function createCapture($transaction)
    {
        /** @var Capture $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceUuid(),
            'amount' => (string) $transaction->getAmount(),
            'currency' => $transaction->getCurrency(),
            'items' => $this->createItems($transaction->getItems()),
        ];

        return $data;
    }

    /**
     * void specific data
     *
     * @param $transaction
     * @return array
     */
    protected function createVoid($transaction)
    {
        /** @var VoidTransaction $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceUuid(),
        ];

        return $data;
    }

    /**
     * register specific data
     *
     * @param $transaction
     * @param $language
     * @return array
     */
    protected function createRegister($transaction, $language)
    {
        /** @var Register $transaction */
        $data = [
            'successUrl' => $transaction->getSuccessUrl(),
            'cancelUrl' => $transaction->getCancelUrl(),
            'errorUrl' => $transaction->getErrorUrl(),
            'callbackUrl' => $transaction->getCallbackUrl(),
            'transactionToken' => $transaction->getTransactionToken(),
            'description' => $transaction->getDescription(),
            'customer' => $this->createCustomer($transaction->getCustomer()),
            'schedule' => $this->createSchedule($transaction->getSchedule()),
            'customerProfileData' => $this->createAddToCustomerProfile($transaction->getCustomerProfileData()),
            'threeDSecureData' => $this->createThreeDSecureData($transaction->getThreeDSecureData()),
            'language' => $language,
        ];

        return $data;
    }

    /**
     * deregister specific data
     *
     * @param $transaction
     * @return array
     */
    protected function createDeregister($transaction)
    {
        /** @var Deregister $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceUuid(),
        ];

        return $data;
    }

    /**
     * refund specific data
     *
     * @param $transaction
     * @return array
     */
    protected function createRefund($transaction)
    {
        /** @var Refund $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceUuid(),
            'amount' => (string) $transaction->getAmount(),
            'currency' => $transaction->getCurrency(),
            'callbackUrl' => $transaction->getCallbackUrl(),
            'transactionToken' => $transaction->getTransactionToken(),
            'description' => $transaction->getDescription(),
            'items' => $this->createItems($transaction->getItems()),
        ];

        return $data;
    }

    /**
     * payout specific data
     *
     * @param $transaction
     * @param $language
     * @return array
     */
    protected function createPayout($transaction, $language)
    {
        /** @var Payout $transaction */
        $data = [
            'referenceUuid' => $transaction->getReferenceUuid(),
            'amount' => (string) $transaction->getAmount(),
            'currency' => $transaction->getCurrency(),
            'successUrl' => $transaction->getSuccessUrl(),
            'cancelUrl' => $transaction->getCancelUrl(),
            'errorUrl' => $transaction->getErrorUrl(),
            'callbackUrl' => $transaction->getCallbackUrl(),
            'transactionToken' => $transaction->getTransactionToken(),
            'description' => $transaction->getDescription(),
            'items' => $this->createItems($transaction->getItems()),
            'customer' => $this->createCustomer($transaction->getCustomer()),
            'language' => $language,
        ];

        return $data;
    }

    /**
     * items data
     *
     * @param $items
     * @return array
     */
    protected function createItems($items)
    {
        if (! $items) {
            return null;
        }

        $data = [];

        /** @var Item $item */
        foreach ($items as $item) {
            $data[] = [
                'identification' => $item->getIdentification(),
                'name' => $item->getName(),
                'description' => $item->getDescription(),
                'quantity' => $item->getQuantity(),
                'price' => $item->getPrice(),
                'currency' => $item->getCurrency(),
                'extraData' => $this->stringifyExtraData($item->getExtraData()),
            ];
        }

        return $data;
    }

    /**
     * customer data
     * - includes paymentData
     *
     * @param  Customer|null  $customer
     * @return mixed
     */
    protected function createCustomer($customer)
    {
        if (! $customer) {
            return null;
        }

        $data = [
            'identification' => $customer->getIdentification(),
            'firstName' => $customer->getFirstName(),
            'lastName' => $customer->getLastName(),
            'birthDate' => $customer->getBirthDateFormatted(),
            'gender' => $customer->getGender(),
            'billingAddress1' => $customer->getBillingAddress1(),
            'billingAddress2' => $customer->getBillingAddress2(),
            'billingCity' => $customer->getBillingCity(),
            'billingPostcode' => $customer->getBillingPostcode(),
            'billingState' => $customer->getBillingState(),
            'billingCountry' => $customer->getBillingCountry(),
            'billingPhone' => $customer->getBillingPhone(),
            'shippingFirstName' => $customer->getShippingFirstName(),
            'shippingLastName' => $customer->getShippingLastName(),
            'shippingCompany' => $customer->getShippingCompany(),
            'shippingAddress1' => $customer->getShippingAddress1(),
            'shippingAddress2' => $customer->getShippingAddress2(),
            'shippingCity' => $customer->getShippingCity(),
            'shippingPostcode' => $customer->getShippingPostcode(),
            'shippingState' => $customer->getShippingState(),
            'shippingCountry' => $customer->getShippingCountry(),
            'shippingPhone' => $customer->getShippingPhone(),
            'company' => $customer->getCompany(),
            'email' => $customer->getEmail(),
            'emailVerified' => $customer->isEmailVerified(),
            'ipAddress' => $customer->getIpAddress(),
            'nationalId' => $customer->getNationalId(),
            'extraData' => $this->stringifyExtraData($customer->getExtraData()),
            // uncomment below upon removing backwards compatibility
            //             'paymentData' => $this->createPaymentData($customer->getPaymentData()),
        ];

        // backwards compatible part
        if ($customer instanceof IbanCustomer) {
            $data['paymentData']['ibanData'] = [
                'iban' => $customer->getIban(),
                'bic' => $customer->getBic(),
                'mandateId' => $customer->getMandateId(),
                'mandateDate' => $customer->getMandateDate() ? ($customer->getMandateDate())->format('Y-m-d') : null,
            ];
        } elseif ($customer instanceof CreditCardCustomer) {
            $data['paymentData']['cardData'] = [
                'brand' => $customer->getBrand(),
                'cardHolder' => $customer->getCardHolder(),
                'firstSixDigits' => $customer->getFirstSixDigits(),
                'lastFourDigits' => $customer->getLastFourDigits(),
                'expiryMonth' => $customer->getExpiryMonth(),
                'expiryYear' => $customer->getExpiryYear(),
            ];
        } else {
            $data['paymentData'] = $this->createPaymentData($customer->getPaymentData());
        }

        return $data;
    }

    /**
     * payment data
     *
     * @param  PaymentData  $paymentData
     * @return array|null
     */
    protected function createPaymentData($paymentData)
    {
        if (! $paymentData) {
            return null;
        }
        $data = null;

        if ($paymentData instanceof IbanData) {
            $data['ibanData'] = [
                'iban' => $paymentData->getIban(),
                'bic' => $paymentData->getBic(),
                'mandateId' => $paymentData->getMandateId(),
                'mandateDate' => $paymentData->getMandateDateFormatted(),
            ];
        } elseif ($paymentData instanceof WalletData) {
            $data['walletData'] = [
                'walletReferenceId' => $paymentData->getWalletReferenceId(),
                'walletOwner' => $paymentData->getWalletOwner(),
                'walletType' => $paymentData->getWalletType(),
            ];
        }

        return $data;
    }

    /**
     * @param  ScheduleWithTransaction  $schedule
     * @return array|null
     */
    protected function createSchedule($schedule)
    {
        if (! $schedule) {
            return null;
        }

        $data = [
            'amount' => $schedule->getAmount(),
            'currency' => $schedule->getCurrency(),
            'periodLength' => $schedule->getPeriodLength(),
            'periodUnit' => $schedule->getPeriodUnit(),
            'startDateTime' => $schedule->getStartDateTimeFormatted(\DateTime::ATOM),
            'merchantMetaData' => $schedule->getMerchantMetaData(),
        ];

        return $data;
    }

    /**
     * customer profile data
     *
     * @param  CustomerProfileData  $customerProfile
     * @return array|null
     */
    protected function createAddToCustomerProfile($customerProfile)
    {
        if (! $customerProfile) {
            return null;
        }

        $data = [
            'profileGuid' => $customerProfile->getProfileGuid(),
            'customerIdentification' => $customerProfile->getCustomerIdentification(),
            'markAsPreferred' => $customerProfile->getMarkAsPreferred(),
        ];

        return $data;
    }

    /**
     * three d secure data
     *
     * @param  ThreeDSecureData  $threeDSecureData
     * @return array|null
     */
    protected function createThreeDSecureData($threeDSecureData)
    {
        if (! $threeDSecureData) {
            return null;
        }

        $data = [
            '3dsecure' => $threeDSecureData->getThreeDSecure(),
            'channel' => $threeDSecureData->getChannel(),
            'authenticationIndicator' => $threeDSecureData->getAuthenticationIndicator(),
            'cardholderAuthenticationMethod' => $threeDSecureData->getCardholderAuthenticationMethod(),
            'cardholderAuthenticationDateTime' => $threeDSecureData->getCardholderAuthenticationDateTimeFormatted(),
            'cardHolderAuthenticationData' => $threeDSecureData->getCardHolderAuthenticationData(),
            'challengeIndicator' => $threeDSecureData->getChallengeIndicator(),
            'priorReference' => $threeDSecureData->getPriorReference(),
            'priorAuthenticationMethod' => $threeDSecureData->getPriorAuthenticationMethod(),
            'priorAuthenticationDateTime' => $threeDSecureData->getPriorAuthenticationDateTimeFormatted(),
            'priorAuthenticationData' => $threeDSecureData->getPriorAuthenticationData(),
            'cardholderAccountType' => $threeDSecureData->getCardholderAccountType(),
            'cardholderAccountDate' => $threeDSecureData->getCardholderAccountDateFormatted(),
            'cardholderAccountChangeIndicator' => $threeDSecureData->getCardholderAccountChangeIndicator(),
            'cardholderAccountLastChange' => $threeDSecureData->getCardholderAccountLastChangeFormatted(),
            'cardholderAccountPasswordChangeIndicator' => $threeDSecureData->getCardholderAccountPasswordChangeIndicator(),
            'cardholderAccountLastPasswordChange' => $threeDSecureData->getCardholderAccountLastPasswordChangeFormatted(),
            'shippingAddressUsageIndicator' => $threeDSecureData->getShippingAddressUsageIndicator(),
            'shippingAddressFirstUsage' => $threeDSecureData->getShippingAddressFirstUsageFormatted(),
            'transactionActivityDay' => $threeDSecureData->getTransactionActivityDay(),
            'transactionActivityYear' => $threeDSecureData->getTransactionActivityYear(),
            'addCardAttemptsDay' => $threeDSecureData->getAddCardAttemptsDay(),
            'purchaseCountSixMonths' => $threeDSecureData->getPurchaseCountSixMonths(),
            'suspiciousAccountActivityIndicator' => $threeDSecureData->getSuspiciousAccountActivityIndicator(),
            'shippingNameEqualIndicator' => $threeDSecureData->getShippingNameEqualIndicator(),
            'paymentAccountAgeIndicator' => $threeDSecureData->getPaymentAccountAgeIndicator(),
            'paymentAccountAgeDate' => $threeDSecureData->getPaymentAccountAgeDateFormatted(),
            'billingShippingAddressMatch' => $threeDSecureData->getBillingShippingAddressMatch(),
            'homePhoneCountryPrefix' => $threeDSecureData->getHomePhoneCountryPrefix(),
            'homePhoneNumber' => $threeDSecureData->getHomePhoneNumber(),
            'mobilePhoneCountryPrefix' => $threeDSecureData->getMobilePhoneCountryPrefix(),
            'mobilePhoneNumber' => $threeDSecureData->getMobilePhoneNumber(),
            'workPhoneCountryPrefix' => $threeDSecureData->getWorkPhoneCountryPrefix(),
            'workPhoneNumber' => $threeDSecureData->getWorkPhoneNumber(),
            'purchaseInstalData' => $threeDSecureData->getPurchaseInstalData(),
            'shipIndicator' => $threeDSecureData->getShipIndicator(),
            'deliveryTimeframe' => $threeDSecureData->getDeliveryTimeframe(),
            'deliveryEmailAddress' => $threeDSecureData->getDeliveryEmailAddress(),
            'reorderItemsIndicator' => $threeDSecureData->getReorderItemsIndicator(),
            'preOrderPurchaseIndicator' => $threeDSecureData->getPreOrderPurchaseIndicator(),
            'preOrderDate' => $threeDSecureData->getPreOrderDateFormatted(),
            'giftCardAmount' => $threeDSecureData->getGiftCardAmount(),
            'giftCardCurrency' => $threeDSecureData->getGiftCardCurrency(),
            'giftCardCount' => $threeDSecureData->getGiftCardCount(),
            'purchaseDate' => $threeDSecureData->getPurchaseDateFormatted(),
            'recurringExpiry' => $threeDSecureData->getRecurringExpiryFormatted(),
            'recurringFrequency' => $threeDSecureData->getRecurringFrequency(),
            'transType' => $threeDSecureData->getTransType(),
            'browserChallengeWindowSize' => $threeDSecureData->getBrowserChallengeWindowSize(),
            'browserAcceptHeader' => $threeDSecureData->getBrowserAcceptHeader(),
            'browserIpAddress' => $threeDSecureData->getBrowserIpAddress(),
            'browserJavaEnabled' => $threeDSecureData->getBrowserJavaEnabled(),
            'browserLanguage' => $threeDSecureData->getBrowserLanguage(),
            'browserColorDepth' => $threeDSecureData->getBrowserColorDepth(),
            'browserScreenHeight' => $threeDSecureData->getBrowserScreenHeight(),
            'browserScreenWidth' => $threeDSecureData->getBrowserScreenWidth(),
            'browserTimezone' => $threeDSecureData->getBrowserTimezone(),
            'browserUserAgent' => $threeDSecureData->getBrowserUserAgent(),
            'sdkInterface' => $threeDSecureData->getSdkInterface(),
            'sdkUiType' => $threeDSecureData->getSdkUiType(),
            'sdkAppID' => $threeDSecureData->getSdkAppID(),
            'sdkEncData' => $threeDSecureData->getSdkEncData(),
            'sdkEphemPubKey' => $threeDSecureData->getSdkEphemPubKey(),
            'sdkMaxTimeout' => $threeDSecureData->getSdkMaxTimeout(),
            'sdkReferenceNumber' => $threeDSecureData->getSdkReferenceNumber(),
            'sdkTransID' => $threeDSecureData->getSdkTransID(),
        ];

        return $data;
    }

    /**
     * removes unfilled values
     *   empty() cant be used as it would remove false booleans in the process!!
     *
     * @param $data
     */
    protected function purgeNullValues(&$data)
    {
        foreach ($data as $key => &$value) {
            if (is_array($value)) {
                $this->purgeNullValues($value);
            }
            // remove unfilled values
            if ($value === null || $value === '' || (is_array($value) && count($value) === 0)) {
                unset($data[$key]);
            }
        }
    }

    /**
     * @deprecated not used anymore, only relevant for xml
     *
     * @param  string  $namespaceRoot
     */
    public function setNamespaceRoot($namespaceRoot)
    {
    }

    /**
     * @param  array  $extraData
     * @return array
     */
    protected function stringifyExtraData($extraData)
    {
        if (is_array($extraData)) {
            array_walk($extraData, function (&$v) {
                $v = (string) $v;
            });
        }

        return $extraData;
    }
}
