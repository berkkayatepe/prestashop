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
<div class="modal fade" id="sepaMandateModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"></div>
            <div class="modal-body">
                <table border="0" cellpadding="0" cellspacing="0" class="stretch">
                    <tr>
                        <td class="text11justify">
                            <table border="0" width="100%">
                                <tr>
                                    <td class="text11justify">
                                        <i>{lFallback s='creditor' mod='creditagricolepaymentgateway'}</i><br />
                                        {$creditorName|escape:'htmlall':'UTF-8'}
                                        {if strlen($creditorName)}
                                            ,
                                        {/if}
                                        {$creditorStoreCity|escape:'htmlall':'UTF-8'}
                                        {if strlen($creditorName) || strlen($creditorStoreCity)}<br />{/if}
                                        {lFallback s='creditor_id_input' mod='creditagricolepaymentgateway'}: {$creditorId|escape:'htmlall':'UTF-8'}<br />
                                    </td>
                                    <td width="10%">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" width="100%">
                                <tr>
                                    <td class="text11">
                                        <i>{lFallback s='debtor' mod='creditagricolepaymentgateway'}</i><br />
                                        {lFallback s='debtor_acc_owner' mod='creditagricolepaymentgateway'}: <span class="first_last_name"></span><br />
                                        {lFallback s='iban' mod='creditagricolepaymentgateway'}: <span class="bank_iban"></span><br />
                                        {if $enableBic == true }
                                            {lFallback s='bic' mod='creditagricolepaymentgateway'}: <span class="bank_bic"></span><br />
                                        {/if}
                                    </td>
                                    <td width="10%">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="text11justify">
                            <table border="0" width="100%">
                                <tr>
                                    <td class="text11justify">
                                        {lFallback s='sepa_text_1' mod='creditagricolepaymentgateway'}
                                        {$creditorName|escape:'htmlall':'UTF-8'}
                                        {lFallback s='sepa_text_2' mod='creditagricolepaymentgateway'}
                                        {$creditorName|escape:'htmlall':'UTF-8'} {$additionalText|escape:'htmlall':'UTF-8'}
                                        {lFallback s='sepa_text_2b' mod='creditagricolepaymentgateway'}
                                    </td>
                                    <td width="10%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text11justify">
                                        {lFallback s='sepa_text_3' mod='creditagricolepaymentgateway'}
                                    </td>
                                    <td width="10%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="text11justify">
                                        {lFallback s='sepa_text_4' mod='creditagricolepaymentgateway'}
                                        {$creditorName|escape:'htmlall':'UTF-8'}
                                        {lFallback s='sepa_text_5' mod='creditagricolepaymentgateway'}
                                    </td>
                                    <td width="10%">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="text11justify">
                            <table border="0" width="100%">
                                <tr>
                                    <td class="text11justify">
                                        {if strlen($creditorStoreCity)}
                                            {$creditorStoreCity|escape:'htmlall':'UTF-8'},
                                        {/if}
                                        {$date|escape:'htmlall':'UTF-8'} <span class="first_last_name"></span>
                                    </td>
                                    <td width="10%">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <div class="w-100" style="text-align: left;">
                    <input type="checkbox" id="sepaCheck">&nbsp;<label for="sepaCheck">{lFallback s='sepa_text_6' mod='creditagricolepaymentgateway'}</label>
                </div>
                <button class="btn btn-primary" id="sepaCancelButton">{lFallback s='cancel' mod='creditagricolepaymentgateway'}</button>
                <button class="btn btn-primary disabled" id="sepaConfirmButton">{lFallback s='text_confirm' mod='creditagricolepaymentgateway'}</button>
            </div>
        </div>
    </div>
</div>