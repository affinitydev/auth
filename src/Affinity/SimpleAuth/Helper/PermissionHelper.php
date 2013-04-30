<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Helper;

use Affinity\SimpleAuth\Model\RoleInterface;
use Affinity\SimpleAuth\Model\PermissionInterface;
use Affinity\SimpleAuth\Model\ActionInterface;
use Affinity\SimpleAuth\Exception\Exception;
/**
 * 
 * Permission helper.  Contains several static functions to help
 * with parsing permission trees.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
final class PermissionHelper
{
    /**
     * Sifts through a role, and its parents, to find any actions against the given
     * resource and key.  If no key is defined, then only permissions with no resource
     * key will be iterated upon.  If a key is defined, then both permissions with no
     * resource key, as well as permissions with matching resource keys, will be iterated
     * through.  Actions under keyed permissions will always take precedence over unkeyed
     * actions.
     * 
     * @param \Affinity\SimpleAuth\Model\RoleInterface $role
     * @param string $action The action name to search for
     * @param string $resourceName The resource name to search for.
     * @param string $resourceKey The resource key to search for.  If a key is given, then a search is done
     * for a resource with the given key, and resources with no keys.
     * @param boolean $returnFirst Return on the first action found in the role tree.
     * @param integer $maxIterations The maximum number of iterations before an exception is thrown.
     * 
     * @return array Array of actions found.
     */
    public static function GetActionsFromRole(RoleInterface $role, $actionName, $resourceName, $resourceKey = null, $returnFirst = true, $maxIterations = 20)
    {        
        $keyedArray = array();
        $unkeyedArray = array();
        $returnArray = array();
        $parentArray = array();
        
        // Check for an "infinite" loop.
        if($maxIterations < 1)
        {
            throw new Exception("The maximum allowed number of iterations through a role parent tree has been reached.  " .
                                "Check for an infinite loop in your role parent tree, or increase the number " . 
                                "of maximum allowed iterations in your decision (currently " . $maxIterations . ").");
        }
           
        /* @var $permission PermissionInterface */
        $permissions = $role->getPermissions();
        foreach($permissions as $permission)
        {
            if($permission->getResourceName() == $resourceName)
            {
                if($permission->getResourceKey() == null)
                {
                    $action = PermissionHelper::GetActionFromPermission($permission, $actionName);
                    if($action != null)
                    {
                        $unkeyedArray[] = $action;
                    }
                }
                else if($resourceKey != null && $permission->getResourceKey() == $resourceKey)
                {
                    $action = PermissionHelper::GetActionFromPermission($permission, $actionName);
                    if($action != null)
                    {
                        $keyedArray[] = $action;
                    }
                }
            }
        }
        
        $returnArray = array_merge($keyedArray, $unkeyedArray);
        
        // If there is a result, and we only are interested in the
        // first result, then return it in its own array.
        if($returnFirst && count($returnArray) > 0)
        {
            return array($returnArray[0]);
        }
        
        // Check for parent roles, and recursively find roles inherited by parents.
        if($role->getParentRole() != null)
        {
            $parentArray = PermissionHelper::GetActionsFromRole(
                $role->getParentRole(), 
                $actionName, 
                $resourceName, 
                $resourceKey, 
                $returnFirst, 
                ($maxIterations - 1)
            );
        }

        // Perform a merge if there are parent actions.
        if(count($parentArray) > 0)
        {
            $returnArray = PermissionHelper::MergeActionArrays($returnArray, $parentArray, false);
        }

        return $returnArray;
    }
    
    /**
     * Finds an action associated with a permission.  Note: there should never be
     * two of the same actions with a permission.  This function finds and returns
     * the first action only.
     * 
     * @param \Affinity\SimpleAuth\Model\PermissionInterface $permission
     * @param type $actionName
     * 
     * @return ActionInterface|null If found, the matching action.  Otherwise, null.
     */
    public static function GetActionFromPermission(PermissionInterface $permission, $actionName)
    {
        $actions = $permission->getActions();
        /* @var $action ActionInterface */
        foreach($actions as $action)
        {
            if($action->getName() == $actionName)
                return $action;
        }
        
        return null;
    }
    
    /**
     * Merges two arrays of actions, a primary and parent.  The primary array
     * keys will be the lowest in the array.  If $overwriteActions is set to
     * true, then if at least one action exists in $primaryActions, then any of
     * the same actions in $parentActions will not be merged in.
     * 
     * @param array $primaryActions
     * @param array $parentActions
     * @param type $overwriteActions
     * 
     * @return type
     */
    public static function MergeActionArrays(array $primaryActions, array $parentActions, $overwriteActions)
    {
        // Do not include actions from the parentActions array  that exist in the
        // primaryActions array.
        if($overwriteActions)
        {
            /* @var $parentAction ActionInterface */
            foreach($parentActions as $parentAction)
            {
                $match = false;
                
                /* @var $primaryAction ActionInterface */
                foreach($primaryActions as $primaryAction)
                {
                    if($parentAction->getName() == $primaryAction->getName())
                    {
                        $match = true;
                        break;
                    }
                }
                
                // Only add if the action does not exist.
                if(!$match)
                {
                    $primaryActions[] = $parentAction;
                }
            }
            
            return $primaryActions;
        }
        else
        {
            return array_merge($primaryActions, $parentActions);
        }
    }
    
    /**
     * Sorts roles by their order number.  Roles will be
     * sorted in ascending order. 
     */
    public static function SortRoles(array &$roles)
    {
        // Sort roles by their order, if specified.
        uasort($roles, function($role1, $role2) {
            if($role1->getOrder() == $role2->getOrder())
                return 0;
            
            return ($role1->getOrder() < $role2->getOrder()) ? -1 : 1;
        });
    }
}
