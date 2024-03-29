{*
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
* @author Crédit Agricole
* @copyright Crédit Agricole
* @license GPLv3
*}
<div id="payment-processing-gateway-ratepay-form">
    <input type="hidden" class="form-control" name="invoiceDeviceIdent" id="invoiceDeviceIdent" value="{$deviceIdent|escape:'htmlall':'UTF-8'}"/>
    <form id="invoiceDataProtection" method="GET">
        <ul>
            <li>
                <div class="float-xs-left">
                    <span class="custom-checkbox">
                        <input id="invoiceDataProtectionCheckbox" name="invoiceDataProtectionCheckbox" required="" type="checkbox" value="1" class="ps-shown-by-js">
                        <span><i class="material-icons rtl-no-flip checkbox-checked"></i></span>
                    </span>
                </div>
                <div class="condition-label">
                    <label id="invoiceDataProtectionLabel" for="invoiceDataProtectionCheckbox">
                        {lFallback s='text_terms_accept' mod='creditagricolepaymentgateway'}
                    </label>
                </div>
            </li>
        </ul>
        <small id="invoiceDataProtectionHint" class="text-danger" style="display: none;">{lFallback s='text_terms_notice' mod='creditagricolepaymentgateway'}</small>
    </form>
</div>
