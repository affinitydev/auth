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

use Affinity\SimpleAuth\Model\ActionInterface;

/**
 * This is a generic version of an annotated Action entity, compatible
 * with the Doctrine 2 ORM package.
 * 
 * @package Affinity.SimpleAuth
 * 
 * @Entity 
 * @Table(name="Actions")
 */
class Action implements ActionInterface
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
    protected $PermissionId;
    
    /**
     * @Column(type="string")
     */
    protected $Name;
    
    /**
     * @Column(type="string")
     */
    protected $Value;
    
    /**
     * @ManyToOne(targetEntity="Permission", inversedBy="actions")
     * @JoinColumn(name="PermissionId", referencedColumnName="Id")
     */
    protected $permission;
    
    /***************************
     * Entity Getters and Setters
     ***************************/
    
    public function getId()
    {
        return $this->Id;
    }

    public function getName()
    {
        return $this->Name;
    }
    
    public function setName($name)
    {
        $this->Name = $name;
    }

    public function getValue()
    {
        return $this->Value;
    }

    public function setValue($value)
    {
        $this->Value = $value;
    }
    
    public function getPermission()
    {
        return $this->permission;
    }
}