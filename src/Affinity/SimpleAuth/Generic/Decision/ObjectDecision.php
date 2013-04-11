<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Generic\Decision;

use Affinity\SimpleAuth\Model\UserInterface;
use Affinity\SimpleAuth\Model\RoleInterface;
use Affinity\SimpleAuth\Model\PropertyInterface;
use Affinity\SimpleAuth\Model\PermissionInterface;
use Affinity\SimpleAuth\Model\DecisionInterface;

use Affinity\SimpleAuth\Generic\Resource\ObjectResourceInterface;
use Affinity\SimpleAuth\Generic\Resource\ObjectResource;
use Affinity\SimpleAuth\Generic\Property;

use Affinity\SimpleAuth\Helper\ContextContainerTrait;

/**
 * 
 * Default decision implementation.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class ObjectDecision implements DecisionInterface
{    
    use ContextContainerTrait;
    
    /**
     * Determines whether or not to use this decision for
     * the given resource.
     * 
     * @param mixed $resource The resource to test for a decision.
     */
    public function testDecision($resource, array $params = null)
    {
        if($resource instanceof ObjectResourceInterface)
            return true;
        
        return false;
    }
    
    public function makeDecision($resource, array $params = null)
    {
        $resourceName = null;
        $resourceKey = null;
        
        if($resource instanceof ObjectResourceInterface)
        {
            $resourceName = $this->_getResourceName($resource);
            $resourceKey = $resource->getKey();
        }
        
        $user = $this->getContext()->getUser();
        $roles = $user->getRoles();
        
        // Loop through roles.
        foreach($roles as $role)
        {
            // Loop through permissions.
            $permissions = $role->getPermissions();
            foreach($permissions as $permission)
            {
                $permissionResource = $permission->getResource();
                if($permissionResource instanceof ObjectResourceInterface)
                {
                    $resName = $this->_getResourceName($permissionResource);
                    $resKey = $permissionResource->getKey();
                    if($resName == $resourceName && ($resKey == $resourceKey || $resKey == null))
                    {
                        /* @var $property PropertyInterface */
                        $properties = $permission->getProperties();
                        foreach($properties as $property)
                        {
                            if($property->getName() == $params["Property"])
                                return $property->getValue();
                        }
                    }
                }
            }
        }        
    }
    
    private function _getResourceName($resource)
    {
        $resourceName = null;
        
        if($resource instanceof ObjectResource)
        {
            $resourceName = $resource->getResourceName();
        }
        else
        {
            $classname = get_class($resource);
            $resourceName = $classname::getName();
        }
        
        return $resourceName;
    }
}
