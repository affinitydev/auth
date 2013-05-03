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
    public function getParentRole();
    
    /**
     * Returns the ordering number of the role.
     * A lower number represents a greater precedence of
     * permissions.
     * 
     * @return int The order the role should be processed in.
     */
    public function getOrder();
    
    /**
     * Returns an array of permissions.
     * 
     * @return PermissionInterface[] The permissions which pertain to this role.
     */
    public function getPermissions();
}
