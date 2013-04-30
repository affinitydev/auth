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

trait ResourceKeyTrait
{
    /**
     * Returns the key for the current resource.  The key field can be
     * defined by creating a const on the parent class of this trait
     * named RESOURCE_KEY_FIELD.  If it is not defined, it will search
     * for Id, id, Key, and key fields on the class.
     * 
     * @return string The resource key.
     */    
    function getResourceKey()
    {
        if(defined(get_class($this) . '::RESOURCE_KEY_FIELD'))
        {
            $keyField = self::RESOURCE_KEY_FIELD;
            return $this->$keyField;
        } else
        {
            if(property_exists($this, 'Id'))
                return $this->Id;
            if(property_exists($this, 'id'))
                return $this->id;
            if(property_exists($this, 'Key'))
                return $this->Key;
            if(property_exists($this, 'key'))
                return $this->key;
            
            return null;
        }
    }
}
