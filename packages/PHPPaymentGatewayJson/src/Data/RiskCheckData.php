<?php

namespace PaymentGatewayJson\Client\Data;

use PaymentGatewayJson\Client\Json\DataObject;

/**
 * Class RiskCheckData
 *
 *
 * @property string riskCheckResult
 * @property int riskScore
 * @property bool threeDSecureRequired
 *
 * @method string getRiskCheckResult()
 * @method void setRiskCheckResult($value)
 * @method int getRiskScore()
 * @method void setRiskScore($value)
 * @method bool getThreeDSecureRequired()
 * @method void setThreeDSecureRequired($value)
 */
class RiskCheckData extends DataObject
{
}
