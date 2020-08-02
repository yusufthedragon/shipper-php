<?php

/**
 * AWB.php
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */

namespace Shipper;

/**
 * Class AWB
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */
class AWB
{
    /**
     * Instantiate required parameter key types.
     *
     * @var array
     */
    private static $typeParameters = [
        'eid' => 'string',
        'oid' => 'string'
    ];

    /**
     * Generate AWB Number from related logistic, in case AWB Number is not generated yet where order sent.
     *
     * @param  array  $parameters
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function generate(array $parameters) : object
    {
        Validator::typeValidation($parameters, self::$typeParameters);

        $apiEndpoint = Shipper::$baseUrl . '/awbs/generate';
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint, $parameters);

        return json_decode($response);
    }
}
