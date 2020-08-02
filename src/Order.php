<?php

/**
 * Order.php
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */

namespace Shipper;

/**
 * Class Order
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */
class Order
{
    /**
     * Instantiate required parameters for create Domestic Orders.
     *
     * @var array
     */
    private static $domesticOrdersRequiredParameters = [
        'o',
        'd',
        'l',
        'w',
        'h',
        'wt',
        'v',
        'rateID',
        'consigneeName',
        'consigneePhoneNumber',
        'originAddress',
        'originDirection',
        'destinationAddress',
        'destinationDirection',
        'itemName',
        'contents',
        'packageType'
    ];

    /**
     * Instantiate required parameters for create International Orders.
     *
     * @var array
     */
    private static $internationalOrdersRequiredParameters = [
        'o',
        'd',
        'l',
        'w',
        'h',
        'wt',
        'v',
        'rateID',
        'consigneeName',
        'consigneePhoneNumber',
        'originAddress',
        'destinationAddress',
        'itemName',
        'contents',
        'packageType'
    ];

    /**
     * Instantiate required parameters for activate Orders.
     *
     * @var array
     */
    private static $activateOrdersRequiredParameters = ['active'];

    /**
     * Instantiate required parameters for update Orders.
     *
     * @var array
     */
    private static $updateOrdersRequiredParameters = ['l', 'w', 'h', 'wt'];

    /**
     * Instantiate required parameter key types for create Domestic Orders.
     *
     * @var array
     */
    private static $domesticOrdersTypeParameters = [
        'o' => 'integer',
        'd' => 'integer',
        'l' => 'integer|double',
        'w' => 'integer|double',
        'h' => 'integer|double',
        'wt' => 'integer|double',
        'v' => 'integer',
        'rateID' => 'integer',
        'consigneeName' => 'string',
        'consigneePhoneNumber' => 'string',
        'consignerName' => 'string',
        'consignerPhoneNumber' => 'string',
        'originAddress' => 'string',
        'originDirection' => 'string',
        'destinationAddress' => 'string',
        'destinationDirection' => 'string',
        'itemName' => 'string|array',
        'contents' => 'string',
        'useInsurance' => 'integer',
        'externalID' => 'string',
        'paymentType' => 'string',
        'packageType' => 'integer',
        'cod' => 'integer',
        'originCoord' => 'string',
        'destinationCoord' => 'string'
    ];

    /**
     * Instantiate required parameter key types for create International Orders.
     *
     * @var array
     */
    private static $internationalOrdersTypeParameters = [
        'o' => 'integer',
        'd' => 'integer',
        'l' => 'integer|double',
        'w' => 'integer|double',
        'h' => 'integer|double',
        'wt' => 'integer|double',
        'v' => 'integer',
        'rateID' => 'integer',
        'consigneeName' => 'string',
        'consigneePhoneNumber' => 'string',
        'consignerName' => 'string',
        'consignerPhoneNumber' => 'string',
        'originAddress' => 'string',
        'originDirection' => 'string',
        'destinationAddress' => 'string',
        'destinationDirection' => 'string',
        'destinationArea' => 'string',
        'destinationSuburb' => 'string',
        'destinationCity' => 'string',
        'destinationProvince' => 'string',
        'destinationPostcode' => 'string',
        'itemName' => 'string|array',
        'contents' => 'string',
        'useInsurance' => 'integer',
        'externalID' => 'string',
        'paymentType' => 'string',
        'packageType' => 'integer'
    ];

    /**
     * Instantiate required parameter key types for activate Orders.
     *
     * @var array
     */
    private static $activateOrdersTypeParameters = [
        'active' => 'integer',
        'agentId' => 'integer'
    ];

    /**
     * Instantiate required parameter key types for update Orders.
     *
     * @var array
     */
    private static $updateOrdersTypeParameters = [
        'l' => 'integer|double',
        'w' => 'integer|double',
        'h' => 'integer|double',
        'wt' => 'integer|double'
    ];

    /**
     * Create Shipper Domestic Order.
     *
     * @param  array  $parameters
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function createDomesticOrder(array $parameters) : object
    {
        Validator::requireValidation($parameters, self::$domesticOrdersRequiredParameters)->typeValidation($parameters, self::$domesticOrdersTypeParameters);

        $apiEndpoint = Shipper::$baseUrl . '/orders/domestics';
        $response = HttpRequestor::sendRequest('POST', $apiEndpoint, [], $parameters, ['Content-Type' => 'application/json']);

        return json_decode($response);
    }

    /**
     * Create Shipper International Order.
     *
     * @param  array  $parameters
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function createInternationalOrder(array $parameters) : object
    {
        Validator::requireValidation($parameters, self::$internationalOrdersRequiredParameters)->typeValidation($parameters, self::$internationalOrdersTypeParameters);

        $apiEndpoint = Shipper::$baseUrl . '/orders/internationals';
        $response = HttpRequestor::sendRequest('POST', $apiEndpoint, [], $parameters, ['Content-Type' => 'application/json']);

        return json_decode($response);
    }

    /**
     * Get the Tracking ID based on subGPL-3.0-onlyted Order ID.
     *
     * @param  string  $id
     * @return object
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function getTrackingID(string $orderId) : object
    {
        $apiEndpoint = Shipper::$baseUrl . '/orders';
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint, ['id' => $orderId]);

        return json_decode($response);
    }

    /**
     * Activate (initiate Shipper's pickup process) or Deactivate an Order.
     *
     * @param  string  $orderId
     * @param  array   $parameters
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function activateOrder(string $orderId, array $parameters) : object
    {
        Validator::requireValidation($parameters, self::$activateOrdersRequiredParameters)->typeValidation($parameters, self::$activateOrdersTypeParameters);

        $apiEndpoint = Shipper::$baseUrl . '/activations/' . $orderId;
        $response = HttpRequestor::sendRequest('PUT', $apiEndpoint, [], $parameters, ['Content-Type' => 'application/json']);

        return json_decode($response);
    }

    /**
     * Get created Order's detail.
     *
     * @param  string  $orderId
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function getOrderDetail(string $orderId) : object
    {
        $apiEndpoint = Shipper::$baseUrl . '/orders/' . $orderId;
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint);

        return json_decode($response);
    }

    /**
     * Update an Order.
     *
     * @param  string  $orderId
     * @param  array   $parameters
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function updateOrder(string $orderId, array $parameters) : object
    {
        Validator::requireValidation($parameters, self::$updateOrdersRequiredParameters)->typeValidation($parameters, self::$updateOrdersTypeParameters);

        $apiEndpoint = Shipper::$baseUrl . '/orders/' . $orderId;
        $response = HttpRequestor::sendRequest('PUT', $apiEndpoint, [], $parameters, ['Content-Type' => 'application/json']);

        return json_decode($response);
    }

    /**
     * Cancel an Order.
     *
     * @param  string  $orderId
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function cancelOrder(string $orderId) : object
    {
        $apiEndpoint = Shipper::$baseUrl . '/orders/' . $orderId . '/cancel';
        $response = HttpRequestor::sendRequest('PUT', $apiEndpoint, [], [], ['Content-Type' => 'application/json']);

        return json_decode($response);
    }
}
