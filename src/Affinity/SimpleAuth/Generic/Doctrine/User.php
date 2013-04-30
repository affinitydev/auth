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

use Affinity\SimpleAuth\Model\UserInterface;
use Affinity\SimpleAuth\Model\RoleInterface;

/**
 * This is a generic version of an annotated Permission entity, compatible
 * with the Doctrine 2 ORM package.
 * 
 * @package Affinity.SimpleAuth
 * 
 * @Entity 
 * @Table(name="Users")
 */
class User implements UserInterface
{
    /***************************
     * Entity Properties
     ****************************/
    
    
    /**
     * @Id 
     * @Column(type="integer") 
     * @GeneratedValue
     */
    protected $Id;
    
    /**
     * @ManyToMany(targetEntity="Role")
     * @JoinTable(name="UsersRoles",
     *      joinColumns={@JoinColumn(name="UserId", referencedColumnName="Id")},
     *      inverseJoinColumns={@JoinColumn(name="GroupId", referencedColumnName="Id"}
     * )
     */
    protected $roles;
    
    public function __construct()
    {
        $this->roles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /***************************
     * Entity Getters and Setters
     ****************************/
    
    public function addRole(RoleInterface $role)
    {
        $this->roles[] = $role;
    }

    public function getRoles()
    {
        return $this->roles;
    }
}