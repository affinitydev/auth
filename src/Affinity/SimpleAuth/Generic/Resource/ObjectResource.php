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
 * Class Description.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class ObjectResource implements ObjectResourceInterface
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
    
    public static function getResource($resource)
    {
        $reflector = new \ReflectionClass($resource);
        if($reflector->implementsInterface('Affinity\SimpleAuth\Model\ResourceInterface'))
            return new self(call_user_func(array($resource, 'getName')), null);
        else
            throw new \Exception("Invalid resource given to getResource.  Given resource must implement the ResourceInterface.");
    }
    
    /**
     * Since this is a generic object resource class, the static
     * getName will return null.
     * 
     * @return null
     */
    public static function getName()
    {
        return null;
    }
    
    /**
     * 
     * @return string The name of the resource
     */
    public function getResourceName()
    {
        return $this->name;
    }
    
    public function getKey()
    {
        return $this->key;
    }
}
