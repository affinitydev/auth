<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Helper;

use Affinity\SimpleAuth\Generic\Resource\ObjectResource;

/**
 * 
 * Class Description.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
trait ObjectResourceTrait
{
    public static function getResource()
    {
        return new ObjectResource(self::getName());
    }
    
    /**
     * Returns the fully qualified classname as the
     * resource identifier for authentication.
     * 
     * @return string The resource identifier.
     */
    public static function getName()
    {
        return __CLASS__;
    }
    
    /**
     * Returns the key for the current resource.  The key field can be
     * defined by creating a const on the parent class of this trait
     * named RESOURCE_KEY_FIELD.  If it is not defined, it will search
     * for Id, id, Key, and key fields on the class.
     * 
     * @return string The resource key.
     */
    function getKey()
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
