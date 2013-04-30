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
use Affinity\SimpleAuth\Generic\Resource\ObjectResourceProxy;

use Affinity\SimpleAuth\Helper\PermissionHelper;

use Affinity\SimpleAuth\Helper\Extension\ContextContainerTrait;

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
    
    /**
     * Attempts to find a given action, defined in $params["Action"], associated
     * with the given ObjectResource.  Also accepts an ObjectResourceProxy, which
     * is a mocked ObjectResource object (useful for passing in uninstantiated
     * domain objects).
     * 
     * @param type $resource
     * @param array $params
     * 
     * @return boolean
     */
    public function runDecision($resource, array $params = null)
    {
        $resourceName = null;
        $resourceKey = null;
        
        if($resource instanceof ObjectResourceProxy)
            $resourceName = $resource->getResourceProxyName();
        else if($resource instanceof ObjectResourceInterface)
            $resourceName = $resource::getResourceName();
        else
            return false;
        
        $resourceKey = $resource->getResourceKey();
        
        $roles = $this->getContext()->getUser()->getRoles();
        
        if(!(isset($params['NoSort']) && $params['NoSort'] == true))
            PermissionHelper::SortRoles($roles);
        
        // Loop through roles.
        foreach($roles as $role)
        {
            $actions = PermissionHelper::GetActionsFromRole($role, $params["Action"], $resourceName, $resourceKey);

            if(isset($actions[0]))
            {
                return $actions[0]->getValue();
            }
        }        
    }
}
