<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Model;

/**
 * 
 * Interface describing the permission interface.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
interface PermissionInterface
{
    /**
     * Adds a property to the permission.
     * 
     * @param \Affinity\SimpleAuth\Model\PropertyInterface $property
     */
    public function addProperty(PropertyInterface $property);
    
    /**
     * Retrieves a property if it exists.  Should return null otherwise.
     * 
     * @param mixed $propertyName
     */
    public function getProperties();
    
    /**
     * Retrieves the resource associated with this property.
     * 
     * @return mixed Resource.
     */
    public function getResource();
}
