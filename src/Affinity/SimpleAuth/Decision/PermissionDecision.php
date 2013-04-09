<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Decision;

use Affinity\SimpleAuth\Model\UserInterface;
use Affinity\SimpleAuth\Model\DecisionInterface;

use Affinity\SimpleAuth\Helper\PermissionHelper;
use Affinity\SimpleAuth\Helper\ContextContainerTrait;

/**
 * 
 * Default decision implementation.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class PermissionDecision implements DecisionInterface
{    
    use ContextContainerTrait;
    
    /**
     * Determines whether or not to use this decision for
     * the given resource.
     * 
     * @param mixed $resource The resource to test for a decision.
     */
    public function testDecision($resource)
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
        $decision = false;
        
        echo "Running decision: " . $resource . "<br/>";
        echo "Username: " . $this->getContext()->getUser()->username;
        return;
        
        
        $roles = $this->user->getRoles();
        
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
                    $property = $permission->getProperty("IsGranted");
                    if($property != null)
                    {
                        if($property->getValue() == true)
                            $decision = true;
                    }
                }
            }
        }
        
        
        return $decision;
    }
}
