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

use Affinity\SimpleAuth\Generic\Resource\ObjectResourceInterface;
use Affinity\SimpleAuth\Generic\Resource\ObjectResourceProxy;

use Affinity\SimpleAuth\Helper\PermissionHelper;

use Affinity\SimpleAuth\Helper\Extension\ContextContainerTrait;
use Affinity\SimpleAuth\Helper\Extension\DecisionTrait;

/**
 * 
 * Default decision implementation.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class ObjectDecision implements DecisionInterface
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
        $resourceData = $this->getObjectResourceData($resource);
        if($resourceData != null && is_array($resourceData))
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
        // Get the resource data from the given resource.
        $resourceData = $this->getObjectResourceData($resource);
        if($resourceData == null || !is_array($resourceData))
            return false;
        
        $roles = $this->getContext()->getUser()->getRoles();
        
        if(!(isset($params['NoSort']) && $params['NoSort'] == true))
            PermissionHelper::SortRoles($roles);
        
        // Loop through roles.
        foreach($roles as $role)
        {
            $actions = PermissionHelper::GetActionsFromRole(
                $role, 
                $params["Action"], 
                $resourceData['resourceName'], 
                $resourceData['resourceKey']
            );

            if(isset($actions[0]))
            {
                return $actions[0]->getValue();
            }
        }        
    }
    
    /**
     * Returns an array of the ObjectResource data.  The array contains
     * three keys:
     *      resourceName
     *      resourceKey
     *      resourceClass
     * 
     * This function will get the data from an ObjectResource or an
     * ObjectResourceProxy.  Since the decision may expect either, then
     * this function should always be used to get ObjectResource data.
     */
    public static function getObjectResourceData($resource)
    {
        $returnArray = null;
        
        // To keep the logic in one place, all ObjectResources are converted to
        // ObjectProxies, then the data is extracted out that way.
        if($resource instanceof ObjectResourceProxy)
        {
            $returnArray = array();
            
            $returnArray["resourceName"] = $resource->getResourceProxyName();
            $returnArray["resourceKey"] = $resource->getResourceProxyKey();
            $returnArray["resourceClass"] = $resource->getResourceProxyClass();
        }
        else if($resource instanceof ObjectResourceInterface)
        {
            return self::getObjectResourceData(
                new ObjectResourceProxy(
                        get_class($resource),
                        $resource->getResourceName(),
                        $resource->getResourceKey()
                    )
            );
        }
        
        return $returnArray;
    }
}
