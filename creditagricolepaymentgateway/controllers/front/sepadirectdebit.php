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

/**
 * @property CreditAgricolePaymentGateway module
 *
 * @since 1.0.0
 */
class CreditAgricolePaymentGatewaySepaDirectDebitModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        $this->ajax = true;
        parent::initContent();
    }

    /**
     * Return the SEPA mandate template
     * @since 1.0.0
     */
    public function displayAjaxSepaMandate()
    {
        $data = array();
        $data['creditorName']      = $this->module->getConfigValue('sepadirectdebit', 'creditor_name');
        $data['creditorStoreCity'] = $this->module->getConfigValue('sepadirectdebit', 'creditor_city');
        $data['creditorId']        = $this->module->getConfigValue('sepadirectdebit', 'creditor_id');
        $data['enableBic']         = (bool) $this->module->getConfigValue('sepadirectdebit', 'creditor_name');
        $data['additionalText']    = $this->module->getConfigValue('sepadirectdebit', 'sepa_mandate_textextra');
        $data['date']              = date('d.m.Y');

        $this->context->smarty->assign($data);
        $template = $this->context->smarty->fetch(_PS_MODULE_DIR_ . 'creditagricolepaymentgateway'. DIRECTORY_SEPARATOR .
            'views' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . 'front' . DIRECTORY_SEPARATOR .
            'sepa_mandate.tpl');
        header('Content-Type: application/json; charset=utf8');
        die(Tools::jsonEncode(array('html' => $template)));
    }
}
