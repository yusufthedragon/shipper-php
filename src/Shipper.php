<?php

/**
 * Shipper.php
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */

namespace Shipper;

/**
 * Class Shipper
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */
class Shipper
{
    /**
     * API Key obtained from Shipper.
     *
     * @var string
     */
    public static $apiKey;

    /**
     * Base URL for API.
     *
     * @var string
     */
    public static $baseUrl = 'https://api.sandbox.shipper.id/public/v1';

    /**
     * Set the API Key.
     *
     * @param  string  $apiKey
     * @return void
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     */
    public static function setApiKey(string $apiKey) : void
    {
        self::$apiKey = $apiKey;
    }

    /**
     * Set the Base URL to production.
     *
     * @param  bool  $value
     * @return self
     * @throws \ArgumentCountError
     * @throws \InvalidArgumentException
     */
    public static function setProductionMode(bool $value) : self
    {
        if ($value) {
            self::$baseUrl = 'https://api.shipper.id/prod/public/v1';
        }

        return new self;
    }
}
