<?php

/**
 * Tracking.php
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */

namespace Shipper;

/**
 * Class Tracking
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */
class Tracking
{
    /**
     * Get all Tracking status.
     *
     * @return object
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function getAllStatus() : object
    {
        $apiEndpoint = Shipper::$baseUrl . '/logistics/status';
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint);

        return json_decode($response);
    }
}
