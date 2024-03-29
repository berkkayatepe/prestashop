<?php
/**
 * Shop System SDK - Terms of Use
 *
 * The SDK offered are provided free of charge by Wirecard AG and are explicitly not part
 * of the Wirecard AG range of products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 3 (GPLv3) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Wirecard AG does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the SDK at their own risk. Wirecard AG does not guarantee their full
 * functionality neither does Wirecard AG assume liability for any disadvantages related to
 * the use of the SDK. Additionally, Wirecard AG does not guarantee the full functionality
 * for customized shop systems or installed SDK of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the SDK's functionality before starting productive
 * operation.
 *
 * By installing the SDK into the shop system the customer agrees to these terms of use.
 * Please do not use the SDK if you do not agree to these terms of use!
 */

namespace Wirecard\PaymentSdk\Transaction;

use Wirecard\PaymentSdk\Entity\IdealBic;
use Wirecard\PaymentSdk\Exception\MandatoryFieldMissingException;

/**
 * Class IdealTransaction
 * @package Wirecard\PaymentSdk\Transaction
 */
class IdealTransaction extends Transaction
{
    const NAME = 'ideal';

    /**
     * Maximum characters: 35
     */
    const DESCRIPTOR_LENGTH = 35;

    /**
     * Allowed characters:
     * umlaut space 0-9 a-z A-Z ' + , - .
     */
    const DESCRIPTOR_ALLOWED_CHAR_REGEX = "/[^a-zA-Z0-9\s\'\+\,\-\.\Ä\Ö\Ü\ä\ö\ü]/u";

    /**
     * @var string
     */
    private $bic;

    /**
     * @var bool
     */
    protected $sepaCredit = true;

    /**
     * @param string $bank
     * @throws MandatoryFieldMissingException
     */
    public function setBic($bank)
    {
        $this->bic = IdealBic::search($bank);
        if (!$this->bic) {
            throw new MandatoryFieldMissingException('Bank does not participate in iDEAL or does not exist.');
        }
    }

    /**
     * @return array
     * @internal param null $requestId
     */
    protected function mappedSpecificProperties()
    {
        $join = (parse_url($this->redirect->getSuccessUrl(), PHP_URL_QUERY) ? '&' : '?');
        $successUrl = $this->redirect->getSuccessUrl() . $join . 'request_id=' . $this->requestId;
        $result['success-redirect-url'] = $successUrl;

        if (null !== $this->bic) {
            $result['bank-account']['bic'] = $this->bic;
        }
        if (null !== $this->descriptor) {
            $result['descriptor'] = $this->descriptor;
        }

        return $result;
    }

    /**
     * @return string
     */
    protected function retrieveTransactionTypeForPay()
    {
        return self::TYPE_DEBIT;
    }
}
