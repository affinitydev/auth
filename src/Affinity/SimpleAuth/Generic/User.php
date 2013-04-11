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

use Affinity\SimpleAuth\Model\UserInterface;
use Affinity\SimpleAuth\Model\PermissionInterface;
use Affinity\SimpleAuth\Model\RoleInterface;

/**
 * 
 * Class Description.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class User implements UserInterface
{
    private $permissions;
    private $roles;
    
    private $fields;
    
    public function __construct()
    {
        $this->permissions = array();
        $this->roles = array();
        $this->fields = array();
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
    public function addRole(RoleInterface $role)
    {
        $this->roles[] = $role;
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
    public function getRoles()
    {
        return $this->roles;
    }
    
    /**
     * Magic setter, so that public class properties can be defined for
     * the generic user.
     * 
     * @param type $name
     * @param type $value
     */
    public function __set($name, $value)
    {
        $this->fields[$name] = $value;
    }
    
    /**
     * Magic getter for the public class properties.
     * 
     * @param string $name
     * 
     * @return mixed The value of the field (null if unset).
     */
    public function __get($name) 
    {
        if(isset($this->fields[$name]))
            return $this->fields[$name];
        else
            return null;
    }
}
