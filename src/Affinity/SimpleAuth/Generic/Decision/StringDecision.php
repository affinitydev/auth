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
use Affinity\SimpleAuth\Model\ActionInterface;
use Affinity\SimpleAuth\Model\RoleInterface;

use Affinity\SimpleAuth\Generic\Action;

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
    public function runDecision($stringResource, array $params = null)
    {        
        $user = $this->getContext()->getUser();
        $roles = $user->getRoles();
        
        // Sort roles by their order, if specified.
        uasort($roles, function($role1, $role2) {
            if($role1->getOrder() == $role2->getOrder())
                return 0;
            
            return ($role1->getOrder() < $role2->getOrder()) ? -1 : 1;
        });
        
        // Loop through roles, and check for an IsGranted permission.
        foreach($roles as $role)
        {
            $actions = PermissionHelper::GetActionsFromRole($role, Action::IsGranted, $stringResource);
            if(isset($actions[0]) && $actions[0]->getName() == Action::IsGranted)
            {
                return $actions[0]->getValue();
            }
        }
        
        return false;
    }
}
