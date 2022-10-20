<?php

/**
 * HttpRequestor.php
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */

namespace Shipper;

use GuzzleHttp\Client;

/**
 * Class HttpRequestor
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */
class HttpRequestor
{
    /**
     * Get the HTTP Client for request.
     *
     * @return \GuzzleHttp\Client
     */
    public static function getHttpClient() : Client
    {
        return new Client();
    }

    /**
     * Set request headers.
     *
     * @param  array  $headers
     * @return array
     */
    private static function setHeaders(array $headers) : array
    {
        $defaultHeaders = ['User-Agent' => 'Shipper/'];

        return array_merge($defaultHeaders, $headers);
    }

    /**
     * Set request queries.
     *
     * @param  array  $queries
     * @return array
     */
    private static function setQueries(array $queries) : array
    {
        $defaultQueries = ['apiKey' => Shipper::$apiKey];

        return array_merge($defaultQueries, $queries);
    }

    /**
     * Set request body.
     *
     * @param  array  $body
     * @return array
     */
    private static function setBody(array $body) : array
    {
        $defaultBodies = [];

        return array_merge($defaultBodies, $body);
    }

    /**
     * Send the request and process the response.
     *
     * @param  string  $httpMethod
     * @param  string  $apiEndpoint
     * @param  array   $additionalQueries
     * @param  array   $additionalData
     * @param  array   $additionalHeaders
     * @return string
     * @throws \GuzzleHttp\Exception\ClientException
     */
    public static function sendRequest(string $httpMethod, string $apiEndpoint, array $additionalQueries = [], array $additionalData = [], array $additionalHeaders = []) : string
    {
        $requestHeaders = self::setHeaders($additionalHeaders);
        $requestQueries = self::setQueries($additionalQueries);
        $requestBody = self::setBody($additionalData);
        $httpClient = self::getHttpClient();
        $guzzleOptions = [
            'headers' => $requestHeaders,
            'query' => $requestQueries,
        ];

        if (count($requestBody) > 0) {
            $guzzleOptions['body'] = json_encode($requestBody);
        }

        $response = $httpClient->request($httpMethod, $apiEndpoint, $guzzleOptions);

        return $response->getBody()->getContents();
    }
}
