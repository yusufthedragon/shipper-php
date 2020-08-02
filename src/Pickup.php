<?php

/**
 * Pickup.php
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */

namespace Shipper;

/**
 * Class Pickup
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */
class Pickup
{
    /**
     * Instantiate required parameters for create Pickups.
     *
     * @var array
     */
    private static $createPickupRequiredParameters = ['orderIds', 'datePickup', 'agentId'];

    /**
     * Instantiate required parameters for cancel Pickups.
     *
     * @var array
     */
    private static $cancelPickupRequiredParameters = ['orderIds'];

    /**
     * Instantiate required parameter key types for create Pickups.
     *
     * @var array
     */
    private static $createPickupTypeParameters = [
        'orderIds' => 'array',
        'datePickup' => 'string',
        'agentId' => 'integer'
    ];

    /**
     * Instantiate required parameter key types for cancel Pickups.
     *
     * @var array
     */
    private static $cancelPickupTypeParameters = [
        'orderIds' => 'array'
    ];

    /**
     * Assign agent and activate orders.
     *
     * @param  array  $parameters
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function createPickup(array $parameters) : object
    {
        Validator::requireValidation($parameters, self::$createPickupRequiredParameters)->typeValidation($parameters, self::$createPickupTypeParameters);

        $apiEndpoint = Shipper::$baseUrl . '/pickup';
        $response = HttpRequestor::sendRequest('POST', $apiEndpoint, [], $parameters, ['Content-Type' => 'application/json']);

        return json_decode($response);
    }

    /**
     * Cancel Pickup request.
     *
     * @param  array  $parameters
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function cancelPickup(array $parameters) : object
    {
        Validator::requireValidation($parameters, self::$cancelPickupRequiredParameters)->typeValidation($parameters, self::$cancelPickupTypeParameters);

        $apiEndpoint = Shipper::$baseUrl . '/pickup/cancel';
        $response = HttpRequestor::sendRequest('PUT', $apiEndpoint, [], $parameters, ['Content-Type' => 'application/json']);

        return json_decode($response);
    }

    /**
     * Get agent by origin suburb ID.
     *
     * @param int $suburbId
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function getAgents(int $suburbId) : object
    {
        $apiEndpoint = Shipper::$baseUrl . '/agents';
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint, ['suburbId' => $suburbId]);

        return json_decode($response);
    }
}
