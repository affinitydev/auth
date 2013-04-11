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
use Affinity\SimpleAuth\Model\DecisionInterface;
use Affinity\SimpleAuth\Model\PropertyInterface;
use Affinity\SimpleAuth\Model\RoleInterface;
use Affinity\SimpleAuth\Model\PermissionInterface;

use Affinity\SimpleAuth\Generic\Property;

use Affinity\SimpleAuth\Helper\PermissionHelper;
use Affinity\SimpleAuth\Helper\ContextContainerTrait;

/**
 * 
 * Default decision implementation.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class StringDecision implements DecisionInterface
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
        if(is_string($resource))
            return true;
        
        return false;
    }
    
    /**
     * Makes a decision.
     * 
     * @param mxied $resource The resource to authenticate.
     * @param array $params Paramaters for authentication.
     * 
     * @return integer Decision
     */
    public function makeDecision($resource, array $params = null)
    {
        // The final decision to return.
        $decision = false;
        
        $user = $this->getContext()->getUser();
        $roles = $user->getRoles();
        
        // Loop through roles.
        foreach($roles as $role)
        {
            // Loop through permissions.
            $permissions = $role->getPermissions();
            foreach($permissions as $permission)
            {
                if($permission->getResource() == $resource)
                {
                    /* @var $property PropertyInterface */
                    $properties = $permission->getProperties();
                    foreach($properties as $property)
                    {
                        if($property->getName() == Property::IsGranted)
                            $decision = $property->getValue();                       
                    }
                }
            }
        }
        
        
        return $decision;
    }
}
