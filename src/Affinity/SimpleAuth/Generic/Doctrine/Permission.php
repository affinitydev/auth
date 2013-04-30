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

use Affinity\SimpleAuth\Model\PermissionInterface;

/**
 * This is a generic version of an annotated Permission entity, compatible
 * with the Doctrine 2 ORM package.
 * 
 * @package Affinity.SimpleAuth
 * 
 * @Entity 
 * @Table(name="Permissions")
 */
class Permission implements PermissionInterface
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
     * @Column(type="integer")
     */
    protected $RoleId;
    
    /**
     * @Column(type="string")
     */
    protected $ResourceName;
    
    /**
     * @Column(type="string")
     */
    protected $ResourceKey;
    
    /**
     * @OneToMany(targetEntity="Action", mappedBy="permission")
     */
    protected $actions;
    
    /**
     * @ManyToOne(targetEntity="Role", inversedBy="permissions")
     * @JoinColumn(name="RoleId", referencedColumnName="Id")
     */
    protected $role;
    
    
    /***************************
     * Entity Getters and Setters
     ***************************/
    
    public function getId()
    {
        return $this->Id;
    }
    
    public function getResourceName()
    {
        return $this->ResourceName;
    }
    
    public function setResourceName($name)
    {
        $this->ResourceName = $name;
    }

    public function getActions()
    {
        return $this->actions;
    }

    public function setActions(array $actions)
    {
        $this->actions = $actions;
    }

    public function getResourceKey()
    {
        return $this->ResourceKey;
    }
    
    public function setResourceKey($key)
    {
        $this->ResourceKey = $key;
    }
}