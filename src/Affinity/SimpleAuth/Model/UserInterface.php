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

use Affinity\SimpleAuth\Model\RoleInterface;
use Affinity\SimpleAuth\Model\PermissionInterface;

/**
 * 
 * Describes the interface for a user.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
interface UserInterface
{
    /**
     * Applies a role to the user.
     * 
     * @param RoleInterface $role The role to add.
     */
    public function addRole(RoleInterface $role);
    
    /**
     * Returns an array of Roles.
     * 
     * @return RoleInterface[] Array of roles pertaining to the user.
     */
    public function getRoles();
    
}
