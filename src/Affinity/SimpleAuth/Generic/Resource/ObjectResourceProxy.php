<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Generic\Resource;

/**
 * 
 * This is a generic 
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class ObjectResourceProxy implements ObjectResourceInterface
{
    private $name;
    private $key;
    
    /**
     * Constructor for a generic resource.  A name must be provided, and
     * an optional key can also be provided.
     * 
     * @param string $name
     * @param string $key
     */
    public function __construct($name, $key = null)
    {
        $this->name = $name;
        $this->key = $key;
    }
    
    /**
     * Since this is a generic object resource proxy class, the static
     * getName will return null.
     * 
     * @return null
     */
    public static function getResource()
    {
        return null;
    }
    
    /**
     * Since this is a generic object resource proxy class, the getKey
     * function will always 
     * 
     * @return null
     */
    public static function getResourceName()
    {
        return null;
    }
    
    /**
     * Returns the key.  Key is an immutable property, defined when
     * the proxy object is created.
     * 
     * @return null
     */
    public function getResourceKey()
    {
        return $this->key;
    }
    
    /**
     * This function will return the immutable name of the
     * resource, defined when the proxy object is created.
     * 
     * @return string The name of the resource
     */
    public function getResourceProxyName()
    {
        return $this->name;
    }
}
