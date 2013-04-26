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
     * Adds an action to the permission.
     * 
     * @param array $actions Array of actions to add to the permission.
     */
    public function setActions(array $actions);
    
    /**
     * Returns an array of the actions linked to this permission.
     * 
     * @param mixed $propertyName
     */
    public function getActions();
    
    /**
     * Retrieves the resource key.
     * 
     * @return mixed The resource key.
     */
    public function getResourceKey();
    
    /**
     * Sets the key to map to the resource.
     * 
     * @param mixed $key The resource key.
     */
    public function setResourceKey($key);
    
    /**
     * Retrieves the resource associated with this property.
     * 
     * @return mixed Resource.
     */
    public function getResourceName();
    
    /**
     * Sets the resource.
     * 
     * @param mxied $resource
     */
    public function setResourceName($resource);
}
