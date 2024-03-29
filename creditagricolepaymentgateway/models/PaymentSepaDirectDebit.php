<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Crédit Agricole and are explicitly not part
 * of the Crédit Agricole range of products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License version 3 (GPLv3) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Crédit Agricole does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Crédit Agricole does not guarantee their full
 * functionality neither does Crédit Agricole assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Crédit Agricole does not guarantee the full functionality
 * for customized shop systems or installed plugins of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the plugin's functionality before starting productive
 * operation.
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 * @author    Crédit Agricole
 * @copyright Crédit Agricole
 * @license   GPLv3
 */

namespace WirecardEE\Prestashop\Models;

use Wirecard\PaymentSdk\Transaction\SepaDirectDebitTransaction;
use Wirecard\PaymentSdk\Config\SepaConfig;
use Wirecard\PaymentSdk\Entity\AccountHolder;
use Wirecard\PaymentSdk\Entity\Mandate;

/**
 * Class PaymentSepaDirectDebit
 *
 * @extends Payment
 *
 * @since 1.3.0
 */
class PaymentSepaDirectDebit extends Payment
{
    /**
     * PaymentSepaDirectDebit constructor.
     *
     * @since 1.3.0
     */
    public function __construct($module)
    {
        parent::__construct($module);

        $this->type = 'sepadirectdebit';
        $this->name = 'Crédit Agricole SEPA Direct Debit';
        $this->formFields = $this->createFormFields();
        $this->setAdditionalInformationTemplate($this->type, $this->setTemplateData());
        $this->setLoadJs(true);

        $this->cancel  = array('pending-debit');
        $this->capture = array('authorization');
        $this->refund  = array('debit');
    }

    /**
     * Create form fields for SEPA
     *
     * @return array|null
     * @since 1.3.0
     */
    public function createFormFields()
    {
        return array(
            'tab' => 'sepadirectdebit',
            'fields' => array(
                array(
                    'name' => 'enabled',
                    'label' => $this->l('text_enable'),
                    'type' => 'onoff',
                    'doc' => $this->l('enable_heading_title_sepadd'),
                    'default' => 0,
                ),
                array(
                    'name' => 'title',
                    'label' => $this->l('config_title'),
                    'type' => 'text',
                    'default' => $this->l('heading_title_sepadd'),
                    'required' => true,
                ),
                array(
                    'name' => 'merchant_account_id',
                    'label'   => $this->l('config_merchant_account_id'),
                    'type'    => 'text',
                    'default' => '933ad170-88f0-4c3d-a862-cff315ecfbc0',
                    'required' => true,
                ),
                array(
                    'name' => 'secret',
                    'label'   => $this->l('config_merchant_secret'),
                    'type'    => 'text',
                    'default' => '5caf2ed9-5f79-4e65-98cb-0b70d6f569aa',
                    'required' => true,
                ),
                array(
                    'name' => 'base_url',
                    'label'       => $this->l('config_base_url'),
                    'type'        => 'text',
                    'doc' => $this->l('config_base_url_desc'),
                    'default'     => 'https://api-test.wirecard.com',
                    'required' => true,
                ),
                array(
                    'name' => 'http_user',
                    'label'   => $this->l('config_http_user'),
                    'type'    => 'text',
                    'default' => '16390-testing',
                    'required' => true,
                ),
                array(
                    'name' => 'http_pass',
                    'label'   => $this->l('config_http_password'),
                    'type'    => 'text',
                    'default' => '3!3013=D3fD8X7',
                    'required' => true,
                ),
                array(
                    'name' => 'creditor_id',
                    'label'   => $this->l('config_creditor_id'),
                    'type'    => 'text',
                    'default' => 'DE98ZZZ09999999999',
                    'required' => true,
                ),
                array(
                    'name' => 'creditor_name',
                    'label'   => $this->l('config_creditor_name'),
                    'type'    => 'text',
                    'default' => '',
                    'required' => false,
                ),
                array(
                    'name' => 'creditor_city',
                    'label'   => $this->l('config_creditor_city'),
                    'type'    => 'text',
                    'default' => '',
                    'required' => false,
                ),
                array(
                    'name' => 'sepa_mandate_textextra',
                    'label'   => $this->l('config_mandate_text'),
                    'type'    => 'textarea',
                    'doc'     => $this->l('config_mandate_text_desc'),
                    'default' => '',
                    'required' => false,
                ),
                array(
                    'name' => 'payment_action',
                    'type'    => 'select',
                    'default' => 'authorization',
                    'label'   => $this->l('config_payment_action'),
                    'options' => array(
                        array('key' => 'reserve', 'value' => $this->l('text_payment_action_reserve')),
                        array('key' => 'pay', 'value' => $this->l('text_payment_action_pay')),
                    ),
                ),
                array(
                    'name' => 'descriptor',
                    'label'   => $this->l('config_descriptor'),
                    'type'    => 'onoff',
                    'default' => 0,
                ),
                array(
                    'name' => 'send_additional',
                    'label'   => $this->l('config_additional_info'),
                    'type'    => 'onoff',
                    'default' => 1,
                ),
                array(
                    'name' => 'enable_bic',
                    'label'   => $this->l('config_enable_bic'),
                    'type'    => 'onoff',
                    'default' => 0,
                ),
                array(
                    'name' => 'test_credentials',
                    'type' => 'linkbutton',
                    'required' => false,
                    'buttonText' => $this->l('test_config'),
                    'id' => 'SepaDirectDebitConfig',
                    'method' => 'sepadirectdebit',
                    'send' => array(
                        'WIRECARD_PAYMENT_GATEWAY_SEPADIRECTDEBIT_BASE_URL',
                        'WIRECARD_PAYMENT_GATEWAY_SEPADIRECTDEBIT_HTTP_USER',
                        'WIRECARD_PAYMENT_GATEWAY_SEPADIRECTDEBIT_HTTP_PASS'
                    )
                )
            )
        );
    }

    /**
     * Create config for SEPA transactions
     *
     * @param \CreditAgricolePaymentGateway $paymentModule
     * @return \Wirecard\PaymentSdk\Config\Config
     * @since 1.3.0
     */
    public function createPaymentConfig($paymentModule)
    {
        $baseUrl  = $paymentModule->getConfigValue($this->type, 'base_url');
        $httpUser = $paymentModule->getConfigValue($this->type, 'http_user');
        $httpPass = $paymentModule->getConfigValue($this->type, 'http_pass');

        $merchantAccountId = $paymentModule->getConfigValue($this->type, 'merchant_account_id');
        $secret = $paymentModule->getConfigValue($this->type, 'secret');

        $config = $this->createConfig($baseUrl, $httpUser, $httpPass);
        $paymentConfig = new SepaConfig(SepaDirectDebitTransaction::NAME, $merchantAccountId, $secret);
        $paymentConfig->setCreditorId($paymentModule->getConfigValue($this->type, 'creditor_id'));
        $config->add($paymentConfig);

        return $config;
    }

    /**
     * Create sepa transaction
     *
     * @param \CreditAgricolePaymentGateway $module
     * @param \Cart $cart
     * @param array $values
     * @param int $orderId
     * @return null|SepaDirectDebitTransaction
     * @since 1.3.0
     */
    public function createTransaction($module, $cart, $values, $orderId)
    {
        $transaction = new SepaDirectDebitTransaction();
        if (isset($values['sepaFirstName']) && isset($values['sepaLastName']) && isset($values['sepaIban'])) {
            $account_holder = new AccountHolder();
            $account_holder->setFirstName($values['sepaFirstName']);
            $account_holder->setLastName($values['sepaLastName']);

            $transaction->setAccountHolder($account_holder);
            $transaction->setIban($values['sepaIban']);

            if ($module->getConfigValue('sepadirectdebit', 'enable_bic')) {
                if (isset($values['sepaBic'])) {
                    $transaction->setBic($values['sepaBic']);
                }
            }

            $mandate = new Mandate($this->generateMandateId($module, $orderId));
            $transaction->setMandate($mandate);
        }

        return $transaction;
    }

    /**
     * Create refund SepaDirectDebitTransaction
     *
     * @param Transaction $transactionData
     * @return SepaDirectDebitTransaction
     * @since 1.3.0
     */
    public function createRefundTransaction($transactionData, $module)
    {
        $sepa = new PaymentSepaCreditTransfer($module);
        return $sepa->createRefundTransaction($transactionData, $module);
    }

    /**
     * Set template variables
     *
     * @return array
     * @since 1.3.0
     */
    private function setTemplateData()
    {
        $test = \Configuration::get(
            sprintf(
                'WIRECARD_PAYMENT_GATEWAY_%s_%s',
                \Tools::strtoupper($this->type),
                \Tools::strtoupper('enable_bic')
            )
        );

        return array('bicEnabled' => (bool) $test);
    }

    /**
     * Generate the mandate id for SEPA
     *
     * @param int $orderId
     * @return string
     * @since 1.3.0
     */
    public function generateMandateId($paymentModule, $orderId)
    {
        return $paymentModule->getConfigValue($this->type, 'creditor_id') . '-' . $orderId
            . '-' . strtotime(date('Y-m-d H:i:s'));
    }
}
