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
*}
<div id="payment-processing-gateway-sepa-form">
    <div class="form-group row">
        <label class="col-md-3 form-control-label">{lFallback s='first_name_input' mod='creditagricolepaymentgateway'}</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="sepaFirstName" id="sepaFirstName" />
        </div>
        <div class="col-md-3 form-control-comment">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 form-control-label">{lFallback s='last_name_input' mod='creditagricolepaymentgateway'}</label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="sepaLastName" id="sepaLastName" />
        </div>
        <div class="col-md-3 form-control-comment">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 form-control-label required"> {lFallback s='iban_input' mod='creditagricolepaymentgateway'}</label>
        <div class="col-md-6">
            <input type="tel" class="form-control" name="sepaIban" id="sepaIban" />
        </div>
        <div class="col-md-3 form-control-comment">
        </div>
    </div>

    {if $bicEnabled == 'true' }
        <div class="form-group row">
            <label class="col-md-3 form-control-label required"> {lFallback s='bic_input' mod='creditagricolepaymentgateway'}</label>
            <div class="col-md-6">
                <input type="tel" class="form-control" name="sepaBic" id="sepaBic" />
            </div>
            <div class="col-md-3 form-control-comment">
            </div>
        </div>
    {/if}
</div>
<div id="sepaDialog"></div>
