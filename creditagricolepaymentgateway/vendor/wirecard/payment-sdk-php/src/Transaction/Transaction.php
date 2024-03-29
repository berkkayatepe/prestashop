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

use Locale;
use Wirecard\PaymentSdk\Entity\Amount;
use Wirecard\PaymentSdk\Entity\Browser;
use Wirecard\PaymentSdk\Entity\CustomFieldCollection;
use Wirecard\PaymentSdk\Entity\Periodic;
use Wirecard\PaymentSdk\Entity\Redirect;
use Wirecard\PaymentSdk\Exception\MandatoryFieldMissingException;
use Wirecard\PaymentSdk\Exception\UnsupportedOperationException;

/**
 * Interface Transaction
 * @package Wirecard\PaymentSdk\Transaction
 */
abstract class Transaction extends Risk
{
    const PARAM_PAYMENT = 'payment';
    const PARAM_TRANSACTION_TYPE = 'transaction-type';
    const PARAM_PARENT_TRANSACTION_ID = 'parent-transaction-id';
    const ENDPOINT_PAYMENTS = '/engine/rest/payments/';
    const ENDPOINT_PAYMENT_METHODS = '/engine/rest/paymentmethods/';
    const NAME = '';
    const TYPE_AUTHORIZATION = 'authorization';
    const TYPE_AUTHORIZATION_ONLY = 'authorization-only';
    const TYPE_REFERENCED_AUTHORIZATION = 'referenced-authorization';
    const TYPE_CAPTURE_AUTHORIZATION = 'capture-authorization';
    const TYPE_CHECK_ENROLLMENT = 'check-enrollment';
    const TYPE_VOID_AUTHORIZATION = 'void-authorization';
    const TYPE_PENDING_CREDIT = 'pending-credit';
    const TYPE_CREDIT = 'credit';
    const TYPE_PENDING_DEBIT = 'pending-debit';
    const TYPE_DEBIT = 'debit';
    const TYPE_REFUND_CAPTURE = 'refund-capture';
    const TYPE_REFUND_DEBIT = 'refund-debit';
    const TYPE_REFUND_REQUEST = 'refund-request';
    const TYPE_VOID_CAPTURE = 'void-capture';
    const TYPE_PURCHASE = 'purchase';
    const TYPE_REFUND_PURCHASE = 'refund-purchase';
    const TYPE_REFERENCED_PURCHASE = 'referenced-purchase';
    const TYPE_VOID_PURCHASE = 'void-purchase';
    const TYPE_VOID_DEBIT= 'void-debit';
    const TYPE_DEPOSIT = 'deposit';


    /**
     * @var Amount
     */
    protected $amount;

    /**
     * @var string
     */
    protected $notificationUrl;

    /**
     * @var string
     */
    protected $emailNotificationUrl;

    /**
     * @var string
     */
    protected $operation;

    /**
     * @var string
     */
    protected $parentTransactionId;

    /**
     * @var string
     */
    protected $parentTransactionType;

    /**
     * @var string
     */
    protected $requestId;

    /**
     * @var Redirect
     */
    protected $redirect;

    /**
     * @var CustomFieldCollection
     */
    protected $customFields;

    /**
     * @var string
     */
    protected $locale;

    /**
     * @var string
     */
    protected $entryMode;

    /**
     * @var string
     */
    protected $orderId;

    /**
     * @var Periodic
     */
    protected $periodic;

    /**
     * @var  bool|null
     */
    protected $sepaCredit = false;

    /**
     * @var Browser
     */
    protected $browser;

    /**
     * @var array
     */
    protected $articleNumbers = [];

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @param string $entryMode
     * @return Transaction
     */
    public function setEntryMode($entryMode)
    {
        $this->entryMode = $entryMode;
        return $this;
    }

    /**
     * @param string $locale
     * @return Transaction
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return CustomFieldCollection
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }

    /**
     * @param CustomFieldCollection $customFields
     * @return Transaction
     */
    public function setCustomFields($customFields)
    {
        $this->customFields = $customFields;
        return $this;
    }

    /**
     * @param Amount $amount
     * @return Transaction
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @param string $orderId
     * @return Transaction
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @param Browser $browser
     * @return Transaction
     * @since
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;
        return $this;
    }

    /**
     * @return Browser
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * @return string
     */
    public function getParentTransactionId()
    {
        return $this->parentTransactionId;
    }

    /**
     * @return string
     */
    public function getParentTransactionType()
    {
        return $this->parentTransactionType;
    }

    /**
     * @param string $parentTransactionId
     * @return Transaction
     */
    public function setParentTransactionId($parentTransactionId)
    {
        $this->parentTransactionId = $parentTransactionId;
        return $this;
    }

    /**
     * @param string $parentTransactionType
     * @return Transaction
     */
    public function setParentTransactionType($parentTransactionType)
    {
        $this->parentTransactionType = $parentTransactionType;
        return $this;
    }

    /**
     * @param mixed $requestId
     * @return Transaction
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
        return $this;
    }

    /**
     * @param string $notificationUrl
     * @return Transaction
     */
    public function setNotificationUrl($notificationUrl)
    {
        $this->notificationUrl = $notificationUrl;
        return $this;
    }

    /**
     * Setter for optional parameter. If it is set it will forward notifications to email as well.
     *
     * @param $email
     * @return $this
     */
    public function setEmailNotification($email)
    {
        $this->emailNotificationUrl = $email;
        return $this;
    }

    /**
     * @param string $operation
     * @return Transaction
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;
        return $this;
    }

    /**
     * @return Periodic
     */
    public function getPeriodic()
    {
        return $this->periodic;
    }

    /**
     * @param Periodic $periodic
     * @return Transaction
     */
    public function setPeriodic($periodic)
    {
        if ($periodic instanceof Periodic) {
            $this->periodic = $periodic;
        }
        return $this;
    }

    /**
     * This method can be used to set article numbers in the transaction. These article numbers can and will be used
     * in the TransactionService class.
     * @since 3.0.0
     * @param array $articleNumber
     * @return Transaction
     */
    public function setArticleNumbers($articleNumber)
    {
        $this->articleNumbers = array_merge($articleNumber, $this->articleNumbers);
        return $this;
    }

    /**
     * @since 3.0.0
     * @return array
     */
    public function getArticleNumbers()
    {
        return $this->articleNumbers;
    }

    /**
     * @throws MandatoryFieldMissingException
     * @throws UnsupportedOperationException
     * @return array
     *
     * A template method for the mapping of the transaction properties:
     *  - the common properties are mapped here,
     *  - an abstract operation is defined for the payment type specific properties.
     */
    public function mappedProperties()
    {
        $result = ['payment-methods' => ['payment-method' => [[
            'name' => $this->paymentMethodNameForRequest()
        ]]]];

        $result = array_merge($result, parent::mappedProperties());

        if ($this->amount instanceof Amount) {
            $result['requested-amount'] = $this->amount->mappedProperties();
        }

        if (null !== $this->parentTransactionId) {
            $result[self::PARAM_PARENT_TRANSACTION_ID] = $this->parentTransactionId;
        }

        if (null !== $this->notificationUrl) {
            $onlyNotificationUrl = ['notification' => [['url' => $this->notificationUrl]]];
            $result['notifications'] = $onlyNotificationUrl;
        }

        if (null !== $this->emailNotificationUrl) {
            $result['notifications']['notification'][] = ['url' => "mailto:{$this->emailNotificationUrl}"];
        }

        if ($this->redirect instanceof Redirect) {
            $result['success-redirect-url'] = $this->redirect->getSuccessUrl();
            if ($this->redirect->getCancelUrl()) {
                $result['cancel-redirect-url'] = $this->redirect->getCancelUrl();
            }
            if ($this->redirect->getFailureUrl()) {
                $result['fail-redirect-url'] = $this->redirect->getFailureUrl();
            }
        }

        if (null !== $this->customFields) {
            $result['custom-fields'] = $this->customFields->mappedProperties();
        }

        if (null !== $this->locale) {
            $result['locale'] = $this->locale;
        } else {
            $result['locale'] = substr(Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']), 0, 2);
        }

        if (null !== $this->entryMode) {
            $result['entry-mode'] = $this->entryMode;
        } else {
            $result['entry-mode'] = 'ecommerce';
        }

        if (null !== $this->orderId) {
            $result['order-id'] = $this->orderId;
        }

        $result[self::PARAM_TRANSACTION_TYPE] = $this->retrieveTransactionType();

        $specificProperties = $this->mappedSpecificProperties();

        if (in_array(
            $this->retrieveTransactionType(),
            [Transaction::TYPE_CHECK_ENROLLMENT, Transaction::TYPE_AUTHORIZATION, Transaction::TYPE_PURCHASE]
        ) && array_key_exists('card-token', $specificProperties) && is_null($this->periodic)) {
            $this->periodic = new Periodic('recurring');
        }

        if (null !== $this->periodic) {
            $result['periodic'] = $this->periodic->mappedProperties();
        }

        if ($this->browser instanceof Browser) {
            $browser = $this->browser->mappedProperties();
            if (count($browser) > 0) {
                $result['browser'] = $this->browser->mappedProperties();
            }
        }

        return array_merge($result, $specificProperties);
    }

    /**
     * @return string
     */
    protected function paymentMethodNameForRequest()
    {
        return $this->getConfigKey();
    }

    /**
     * @param string|null
     * @return string
     */
    public function getConfigKey()
    {
        return $this::NAME;
    }

    /**
     * @throws UnsupportedOperationException|MandatoryFieldMissingException
     * @return string
     */
    protected function retrieveTransactionType()
    {
        switch ($this->operation) {
            case Operation::RESERVE:
                $transactionType = $this->retrieveTransactionTypeForReserve();
                break;
            case Operation::PAY:
                $transactionType = $this->retrieveTransactionTypeForPay();
                break;
            case Operation::CANCEL:
                $transactionType = $this->retrieveTransactionTypeForCancel();
                break;
            case Operation::REFUND:
                $transactionType = $this->retrieveTransactionTypeForRefund();
                break;
            case Operation::CREDIT:
                $transactionType = $this->retrieveTransactionTypeForCredit();
                break;
            default:
                throw new UnsupportedOperationException();
        }

        return $transactionType;
    }

    /**
     * @throws UnsupportedOperationException
     * @return string
     */
    protected function retrieveTransactionTypeForReserve()
    {
        throw new UnsupportedOperationException();
    }

    /**
     * @throws UnsupportedOperationException
     * @return string
     */
    protected function retrieveTransactionTypeForPay()
    {
        throw new UnsupportedOperationException();
    }

    /**
     * @throws UnsupportedOperationException
     * @return string
     */
    protected function retrieveTransactionTypeForCancel()
    {
        throw new UnsupportedOperationException();
    }

    /**
     * @throws UnsupportedOperationException
     * @return string
     */
    protected function retrieveTransactionTypeForRefund()
    {
        throw new UnsupportedOperationException();
    }

    /**
     * @throws UnsupportedOperationException
     * @return string
     */
    protected function retrieveTransactionTypeForCredit()
    {
        throw new UnsupportedOperationException();
    }

    /**
     * @return array
     */
    abstract protected function mappedSpecificProperties();

    /**
     * @param $endpoint
     * @return Transaction
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * return string
     */
    public function getEndpoint()
    {
        return self::ENDPOINT_PAYMENT_METHODS;
    }

    /**
     * @param Redirect $redirect
     * @return Transaction
     */
    public function setRedirect(Redirect $redirect)
    {
        $this->redirect = $redirect;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSuccessUrl()
    {
        if (null === $this->redirect) {
            return null;
        }

        return $this->redirect->getSuccessUrl();
    }

    /**
     * @return Amount
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getNotificationUrl()
    {
        return $this->notificationUrl;
    }

    /**
     * @return string|bool
     */
    public function getBackendOperationForPay()
    {
        try {
            return $this->retrieveTransactionTypeForPay();
        } catch (UnsupportedOperationException $e) {
            return false;
        }
    }

    /**
     * @return string|bool
     */
    public function getBackendOperationForCancel()
    {
        try {
            return $this->retrieveTransactionTypeForCancel();
        } catch (UnsupportedOperationException $e) {
            return false;
        }
    }

    /**
     * @return string|bool
     */
    public function getBackendOperationForRefund()
    {
        try {
            return $this->retrieveTransactionTypeForRefund();
        } catch (UnsupportedOperationException $e) {
            return false;
        }
    }

    /**
     * @return string|bool
     */
    public function getBackendOperationForCredit()
    {
        try {
            return $this->retrieveTransactionTypeForCredit();
        } catch (UnsupportedOperationException $e) {
            return false;
        }
    }

    /**
     * @return bool|null
     */
    public function getSepaCredit()
    {
        return $this->sepaCredit;
    }
}
