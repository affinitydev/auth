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
 * Describes the interface of a Role.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
interface RoleInterface
{
    /**
     * Returns a parent Role, if one exists.
     * 
     * @return RoleInterface The parent role.
     */
    public function getParent();
    
    /**
     * Returns an array of permissions.
     * 
     * @return PermissionInterface[] The permissions which pertain to this role.
     */
    public function getPermissions();
    
    /**
     * Adds a permission to the role.
     * 
     * @param \Affinity\SimpleAuth\Model\PermissionInterface $permission
     */
    public function addPermission(PermissionInterface $permission);
}
