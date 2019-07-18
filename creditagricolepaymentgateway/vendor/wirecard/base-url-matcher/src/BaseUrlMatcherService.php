<?php
/**
 * Shop System Plugins:
 * - Terms of Use can be found under:
 * https://github.com/wirecard/base-url-matcher/blob/master/TERMS_OF_USE
 * - License can be found under:
 * https://github.com/wirecard/base-url-matcher/blob/master/LICENSE
 */

namespace Wirecard\BaseUrlMatcher;

/**
 * Class BaseUrlMatcher
 * @package Wirecard
 * @since 1.0.0
 */
class BaseUrlMatcherService
{
    const API_WIRECARD_URL = 'https://api.wirecard.com';
    const API_WDCEE_WIRECARD_URL = 'https://api-wdcee.wirecard.com';
    const API_TEST_WIRECARD_URL = 'https://api-test.wirecard.com';
    const API_WDCEE_TEST_WIRECARD_URL = 'https://api-wdcee-test.wirecard.com';
    const WPP_DEFAULT_WIRECARD_URL = 'https://wpp-test.wirecard.com';

    /**
     * Get WppUrl from base Url
     * @param string $baseUrl
     * @return string
     * @since 1.0.0
     */
    public static function getWppUrl($baseUrl)
    {
        switch ($baseUrl) {
            case self::API_TEST_WIRECARD_URL:
            case self::API_WIRECARD_URL:
            case self::API_WDCEE_TEST_WIRECARD_URL:
            case self::API_WDCEE_WIRECARD_URL:
                return str_replace('api', 'wpp', $baseUrl);
            default:
                return self::WPP_DEFAULT_WIRECARD_URL;
        }
    }
}
