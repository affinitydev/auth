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

use Affinity\SimpleAuth\Model\ActionInterface;

/**
 * 
 * Generic Action class to be used with SimpleAuth.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class Action implements ActionInterface
{
    /**
     * The string name of the action.
     * 
     * @var string $actionName
     */
    private $actionName;
    
    /**
     * The value of the action.
     * 
     * @var mixed $actionValue
     */
    private $actionValue;
    
    /**
     * Default action names to be used.  Note that any string can be
     * used as an action name, however it is best to always use constant
     * values defined in code to avoid discrepancies in the database.
     */
    const IsGranted = "SimpleAuth_IsGranted";
    const Create = "SimpleAuth_Create";
    const Read = "SimpleAuth_Read";
    const Update = "SimpleAuth_Update";
    const Delete = "SimpleAuth_Delete";
    const Undelete = "SimpleAuth_Undelete";
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->actionName;
    }

    /**
     * @inheritdoc
     */
    public function getValue() 
    {
        return $this->actionValue;
    }

    /**
     * @inheritdoc
     */
    public function setName($name) 
    {
        $this->actionName = $name;
    }

    /**
     * @inheritdoc
     */
    public function setValue($value) 
    {
        $this->actionValue = $value;
    }    
}
