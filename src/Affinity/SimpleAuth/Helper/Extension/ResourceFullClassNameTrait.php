<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Helper\Extension;

/**
 * 
 * Allows for a class to utilize the ResourceInterface
 * automatically.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
trait ResourceFullClassNameTrait
{
    /**
     * Returns the fully qualified classname as the
     * resource identifier for authentication.
     * 
     * @return string The resource identifier.
     */
    public static function getResourceName()
    {
        return get_called_class();
    }
}