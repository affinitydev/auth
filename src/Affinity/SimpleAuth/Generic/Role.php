<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Generic;

use Affinity\SimpleAuth\Model\RoleInterface;
use Affinity\SimpleAuth\Model\PermissionInterface;

/**
 * 
 * Class Description.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class Role implements RoleInterface
{
    private $permissions = array();
    private $order = 0;
    private $parentRole = null;
    
    /**
     * @inheritdoc
     */
    public function getOrder()
    {
        return $this->order;
    }
    
    /**
     * @inheritdoc
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @inheritdoc
     */
    public function getParentRole()
    {
        return $this->parentRole;
    }
    
    /**
     * @inheritdoc
     */
    public function setParentRole(RoleInterface $role)
    {
        $this->parentRole = $role;
    }

    /**
     * @inheritdoc
     */
    public function getPermissions() 
    {
        return $this->permissions;
    }
    
    /**
     * @inheritdoc
     */
    public function addPermission(PermissionInterface $permission)
    {
        $this->permissions[] = $permission;
    }
    
    /**
     * 
     * @param array $permissions
     */
    public function setPermissions(array $permissions)
    {
        $this->permissions = $permissions;
    }
}
