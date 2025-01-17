<?php

namespace PaymentGatewayJson\Client\Transaction\Base;

use PaymentGatewayJson\Client\Data\CustomerProfileData;

/**
 * Interface AddToCustomerProfileInterface
 */
interface AddToCustomerProfileInterface
{
    /**
     * @return CustomerProfileData|null
     */
    public function getCustomerProfileData();

    /**
     * @param  CustomerProfileData  $customerProfileData
     */
    public function setCustomerProfileData(CustomerProfileData $customerProfileData = null);

    /**
     * @param  bool  $addToCustomerProfile
     */
    public function setAddToCustomerProfile($addToCustomerProfile);

    /**
     * @return bool
     */
    public function getAddToCustomerProfile();

    /**
     * @param  string  $profileGuid
     */
    public function setCustomerProfileGuid($profileGuid);

    /**
     * @return string
     */
    public function getCustomerProfileGuid();

    /**
     * @param  string  $identification
     */
    public function setCustomerProfileIdentification($identification);

    /**
     * @return string
     */
    public function getCustomerProfileIdentification();

    /**
     * @return bool
     */
    public function getMarkAsPreferred();

    /**
     * @param  bool  $markAsPreferred
     */
    public function setMarkAsPreferred($markAsPreferred);
}
