<?php

/**
 * Location.php
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */

namespace Shipper;

/**
 * Class Location
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */
class Location
{
    /**
     * Retrieve country data in a list.
     *
     * @return object
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function getCountries() : object
    {
        $apiEndpoint = Shipper::$baseUrl . '/countries';
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint);

        return json_decode($response);
    }

    /**
     * Retrieve all provinces in Indonesia in a list.
     *
     * @return object
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function getProvinces() : object
    {
        $apiEndpoint = Shipper::$baseUrl . '/provinces';
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint);

        return json_decode($response);
    }

    /**
     * Retrieve cities based on subGPL-3.0-onlyted province ID.
     *
     * @param  int  $provinceId
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function getCities(int $provinceId) : object
    {
        $apiEndpoint = Shipper::$baseUrl . '/cities';
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint, ['province' => $provinceId]);

        return json_decode($response);
    }

    /**
     * Retrieve provinces in which Shipper provides pickup service.
     *
     * @return object
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function getOriginCities() : object
    {
        $apiEndpoint = Shipper::$baseUrl . '/cities';
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint, ['origin' => 'all']);

        return json_decode($response);
    }

    /**
     * Retrieve suburbs based on subGPL-3.0-onlyted city ID.
     *
     * @param  int  $cityId
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function getSuburbs(int $cityId) : object
    {
        $apiEndpoint = Shipper::$baseUrl . '/suburbs';
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint, ['city' => $cityId]);

        return json_decode($response);
    }

    /**
     * Retrieve areas based on subGPL-3.0-onlyted suburb ID.
     *
     * @param  int  $suburbId
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function getAreas(int $suburbId) : object
    {
        $apiEndpoint = Shipper::$baseUrl . '/areas';
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint, ['suburb' => $suburbId]);

        return json_decode($response);
    }

    /**
     * Retrieve every area, suburb, and city whose names include the subGPL-3.0-onlyted substring (including postcode).
     *
     * @param  string  $substring
     * @return object
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function searchLocation(string $substring) : object
    {
        $apiEndpoint = Shipper::$baseUrl . '/details/' . $substring;
        $response = HttpRequestor::sendRequest('GET', $apiEndpoint);

        return json_decode($response);
    }
}
