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
interface PropertyInterface
{
    /**
     * Sets the name identifier of the property.
     * 
     * @param string $name
     */
    public function setName(string $name);
    
    /**
     * Sets the value of the property.
     * 
     * @param mixed $value
     */
    public function setValue($value);
    
    /**
     * Returns the property identifier, used to identify the
     * property.
     * 
     * @return string The unique property identifier.
     */
    public function getName();
    
    /**
     * Retrieves the property value.
     * 
     * @return mixed The value of the property.
     */
    public function getValue();
}
