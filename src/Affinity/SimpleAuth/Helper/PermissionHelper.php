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
use Affinity\SimpleAuth\Model\PropertyInterface;
/**
 * 
 * Class Description.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
final class PermissionHelper
{
    public static function GetPropertyFromRole(RoleInterface $role, PropertyInterface $property)
    {
        $permissions = $role->getPermissions();
        
        /* @var $permission PermissionInterface */
        foreach($permissions as $permission)
        {
            $property = $permission->getProperty($property->getPropertyId());
            if($property != null)
                return $property;
        }
    }
}
