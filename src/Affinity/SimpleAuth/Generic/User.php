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
    /**
     * Array of roles which the user belongs to.
     * 
     * @var array $roles
     */
    private $roles = array();
    
    /**
     * Custom fields to emulate a full user.  Use the
     * magic getters and setters to access these fields.
     * 
     * @var array $fields
     */
    private $fields = array();
    
    /**
     * @inheritdoc
     */
    public function addRole(RoleInterface $role)
    {
        $this->roles[] = $role;
    }
     
   /**
     * 
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
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
