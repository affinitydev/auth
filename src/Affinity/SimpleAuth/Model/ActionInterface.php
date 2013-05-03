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

/**
 * 
 * Describes the methods for a Property object.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
interface ActionInterface
{
    /**
     * Returns the action identifier, used to identify the
     * action.
     * 
     * @return string The unique action identifier.
     */
    public function getName();
    
    /**
     * Retrieves the action value.
     * 
     * @return mixed The value of the action.
     */
    public function getValue();
}
