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

use Affinity\SimpleAuth\Model\PermissionInterface;
use Affinity\SimpleAuth\Model\PropertyInterface;
use Affinity\SimpleAuth\Model\ResourceInterface;

/**
 * 
 * Class Description.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class Permission implements PermissionInterface
{
    /**
     * Array of properties which belong to this permission.
     * 
     * @var PropertyInterface[] $properties
     */
    private $properties;
    
    /**
     * The resource which this property binds to.
     *
     * @var ResourceInterface $resource
     */
    private $resource;
    
    public function __construct()
    {
        $this->properties = new \ArrayObject();
    }
    
    /**
     * 
     * @inheritdoc
     */
    public function addProperty(PropertyInterface $property)
    {
        $this->properties->append($property);
    }

    /**
     * 
     * @inheritdoc
     */
    public function removeProperty(PropertyInterface $property)
    {
        foreach($this->properties as $property)
        {
            unset($property);
        }
    }

    /**
     * 
     * @inheritdoc
     */
    public function setResource(ResourceInterface $resource)
    {
        
    }
    
    /**
     * 
     * @inheritdoc
     */
    public function getProperty($propertyId)
    {        
        foreach($this->properties as $property)
        {
            if($property->getPropertyId() == $propertyId)
                return $property;
        }
        
        return null;
    }
}
