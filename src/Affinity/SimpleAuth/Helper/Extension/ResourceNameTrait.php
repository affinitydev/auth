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

trait ResourceNameTrait
{
    /**
     * Returns only the classname (not the namespace path) as
     * the resource identifier for authentication.
     * 
     * @return string The resource identifier.
     */
    public static function getResourceName()
    {
        if(defined(get_class($this) . '::RESOURCE_NAME'))
        {
            return self::RESOURCE_NAME;
        }
        else
        {
            throw new Exception("The const 'RESOURCE_NAME' not defined in class utilizing ResourceNameTrait.");
        }
    }
}
