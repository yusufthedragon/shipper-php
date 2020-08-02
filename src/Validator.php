<?php

/**
 * Validator.php
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */

namespace Shipper;

use InvalidArgumentException;

/**
 * Class Validator
 *
 * @category Class
 * @package  Shipper
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */
class Validator
{
    /**
     * Check if required parameters are exist.
     *
     * @param  array  $parameters
     * @param  array  $requiredParameters
     * @return self
     * @throws \InvalidArgumentException
     */
    public static function requireValidation(array $parameters, array $requiredParameters) : self
    {
        foreach ($requiredParameters as $requiredParameter) {
            if (! isset($parameters[$requiredParameter])) {
                throw new InvalidArgumentException("'{$requiredParameter}' is required.");
            }
        }

        return new self;
    }

    /**
     * Check if parameters have correct variable type.
     *
     * @param  array  $parameters
     * @param  array  $typeParameters
     * @return void
     * @throws \InvalidArgumentException
     */
    public static function typeValidation(array $parameters, array $typeParameters) : void
    {
        foreach ($typeParameters as $key => $typeParameter) {
            if (isset($parameters[$key])) {
                $acceptedTypes = explode('|', $typeParameter);

                if (! in_array(gettype($parameters[$key]), $acceptedTypes)) {
                    throw new InvalidArgumentException("'{$key}' type must be {$typeParameter}.");
                }
            }
        }
    }
}
