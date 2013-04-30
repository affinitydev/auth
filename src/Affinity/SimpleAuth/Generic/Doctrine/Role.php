<?php
/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Generic\Doctrine;

use Affinity\SimpleAuth\Model\RoleInterface;
use Affinity\SimpleAuth\Model\PermissionInterface;

/**
 * This is a generic version of an annotated Permission entity, compatible
 * with the Doctrine 2 ORM package.
 * 
 * @package Affinity.SimpleAuth
 * 
 * @Entity 
 * @Table(name="Roles")
 */
class Role implements RoleInterface
{
    /***************************
     * Entity Properties
     ***************************/
    
    /**
     * @Id 
     * @Column(type="integer") 
     * @GeneratedValue
     */
    protected $Id;
    
    /**
     * @Column(type="string")
     */
    protected $RoleName;
    
    /**
     * @column(type="integer")
     */
    protected $RoleOrder;
    
    /**
     * @Column(type="integer")
     */
    protected $ParentRoleId;
    
    /**
     * @OneToMany(targetEntity="Permission", mappedBy="role")
     */
    protected $permissions;
  
    /**
     * @OneToOne(targetEntity="Role")
     * @JoinColumn(name="ParentRoleId", referencedColumnName="Id")
     */
    protected $parentRole;
    
    /**
     * @ManyToMany(targetEntity="User", mappedBy="roles")
     */
    protected $users;
    
    /***************************
     * Entity Getters and Setters
     ***************************/
   
    public function getRoleName()
    {
        return $this->RoleName;
    }
    
    public function setRoleName($roleName)
    {
        $this->RoleName = $roleName;
    }
    
    public function getOrder()
    {
        return $this->RoleOrder;
    }

    public function setOrder($order)
    {
        $this->RoleOrder = $order;
    }   

    public function getParentRole()
    {
        return $this->parentRole;
    }

    public function setParentRole(RoleInterface $role)
    {
        $this->parentRole = $role;
    } 

    public function getPermissions()
    {
        return $this->permissions;
    }
    
    public function addPermission(PermissionInterface $permission)
    {
        $this->permissions[] = $permission;
    }
}