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

use Affinity\SimpleAuth\Model\DecisionInterface;

use Affinity\SimpleAuth\Generic\Action;

use Affinity\SimpleAuth\Helper\PermissionHelper;
use Affinity\SimpleAuth\Helper\Extension\ContextContainerTrait;
use Affinity\SimpleAuth\Helper\Extension\DecisionTrait;

/**
 * 
 * Default decision implementation for string decisions.  Any
 * resource passed to the AuthManager as a String will be run
 * through the StringDecision.  It will check to see if a
 * resource with the same name as the given string exists, and
 * contains an "IsGranted" action set to true.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class StringDecision implements DecisionInterface
{    
    use ContextContainerTrait, DecisionTrait;
    
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
     * Available parameters:
     * 
     *   - NoSort: If set to true, then the users array of
     *             roles will not be sorted.
     * 
     * @param mxied $resource The resource to authenticate.
     * @param array $params Paramaters for authentication.  Each decision will have
     * a different set of named parameters that can be passed in.
     * 
     * @return integer Decision
     */
    public function runDecision($stringResource, array $params = null)
    {
        $roles = $this->getContext()->getUser()->getRoles();
        
        if(!(isset($params['NoSort']) && $params['NoSort'] == true))
            PermissionHelper::SortRoles($roles);
        
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
