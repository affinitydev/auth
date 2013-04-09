<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth;

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
    private $permissions;
    private $parentRole = null;
    
    public function __construct()
    {
        $this->permissions = array();
    }
    
    /**
     * @inheritdoc
     */
    public function addPermission(PermissionInterface $permission)
    {
        $this->permissions[] = $permission;
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return $this->parentRole;
    }

    /**
     * @inheritdoc
     */
    public function getPermissions() 
    {
        return $this->permissions;
    }    
}
