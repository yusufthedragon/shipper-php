<?php

/**
 * Rates.php
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */

namespace Shipper;

/**
 * Class Rates
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */
class Rates
{
    /**
     * Instantiate required parameters.
     *
     * @var array
     */
    private static $requiredParameters = ['o', 'd', 'l', 'w', 'h', 'wt', 'v'];

    /**
     * Instantiate required parameter key types for Domestic Rates.
     *
     * @var array
     */
    private static $domesticRatesTypeParameters = [
        'o' => 'integer',
        'd' => 'integer',
        'l' => 'integer|double',
        'w' => 'integer|double',
        'h' => 'integer|double',
        'wt' => 'integer|double',
        'v' => 'integer',
        'type' => 'integer',
        'cod' => 'integer',
        'order' => 'integer',
        'originCoord' => 'string',
        'destinationCoord' => 'string'
    ];

    /**
     * Instantiate required parameter key types for International Rates.
     *
     * @var array
     */
    private static $internationalRatesTypeParameters = [
        'o' => 'integer',
        'd' => 'integer',
        'l' => 'integer|double',
        'w' => 'integer|double',
        'h' => 'integer|double',
        'wt' => 'integer|double',
        'v' => 'integer',
        'type' => 'integer',
        'order' => 'integer'
    ];

    /**
     * Get Shipper Domestic Rates.
     *
     * @param  array  $parameters
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     */
    public static function getDomesticRates(array $parameters) : object
    {
        Validator::requireValidation($parameters, self::$requiredParameters)->typeValidation($parameters, self::$domesticRatesTypeParameters);

        $apiEndpoint = Shipper::$baseUrl . '/domesticRates';
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint, $parameters);

        return json_decode($response);
    }

    /**
     * Get Shipper International Rates.
     *
     * @param  array  $parameters
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     */
    public static function getInternationalRates(array $parameters) : object
    {
        Validator::requireValidation($parameters, self::$requiredParameters)->typeValidation($parameters, self::$internationalRatesTypeParameters);

        $apiEndpoint = Shipper::$baseUrl . '/intlRates';
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint, $parameters);

        return json_decode($response);
    }
}
