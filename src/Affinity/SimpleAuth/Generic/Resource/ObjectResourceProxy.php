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
 * This is a generic Proxy object for an ObjectResource.
 * It can be used in place of an ObjectResource
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class ObjectResourceProxy 
{
    private $class;
    private $name;
    private $key;
    
    /**
     * Constructor for a generic resource.  A name must be provided, and
     * an optional key can also be provided.
     * 
     * @param string $name
     * @param string $key
     */
    public function __construct($class, $name, $key = null)
    {
        $this->name = $name;
        $this->key = $key;
        $this->class = $class;
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
    
    /**
     * Returns the key.  Key is an immutable property, defined when
     * the proxy object is created.
     * 
     * @return null
     */
    public function getResourceProxyKey()
    {
        return $this->key;
    }
    
    /**
     * This function will return the immutable name of the
     * resource, defined when the proxy object is created.
     * 
     * @return string The name of the resource
     */
    public function getResourceProxyClass()
    {
        return $this->class;
    }
    
    /**
     * Dummy __get
     */
    public function __get($name)
    {
        return null;
    }
    
    /**
     * Dummy __call
     */
    public function __call($name, $arguments)
    {
        return null;
    }
}
