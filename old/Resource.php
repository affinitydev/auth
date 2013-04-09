<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth;

use Affinity\SimpleAuth\Model\ResourceInterface;
use Affinity\SimpleAuth\Helper\ClassHelper;
use Affinity\SimpleAuth\Exception\UnknownResourceTypeException;

/**
 * 
 * Default SimpleAuth resource implementation.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class Resource implements ResourceInterface
{   
    /**
     *
     * @var string $resourceId 
     */
    private $resourceId;
    
    /**
     *
     * @var string $resourceId 
     */
    private $resourceKey;
    
    /**
     * Constructor, accepting a string form of the resource identifier.
     * 
     * If a string is provided, then it will use that as the resource
     * ID.  Otherwise, it will 
     * 
     * @param mixed $resourceId
     */
    public function __construct($resource, $fullyQualified = true)
    {
        if(is_string($resource))
        {
            $this->resourceId = $resource;
        }
        else
        {
            if(!($className = get_class($resource)))
            {
                throw new UnknownResourceTypeException("Unknown resource type given for Resource constructor; unable to create resource.");
            }
            
            if(!$fullyQualified)
                $this->resourceId = ClassHelper::GetClassnameFromFullyQualified ($className);
            else
                $this->resourceId = $className;
        }
    }
     
   /**
     * Returns the unique resource identifier.
     * 
     * @return string The resource identifier.
     */
    public function getResourceName()
    {
       return $this->resourceId; 
    }
    
    /**
     * Returns the resource key.
     * 
     * @return string The resource key.
     */
    public function getResourceKey()
    {
        return $this->resourceKey;
    }
}
