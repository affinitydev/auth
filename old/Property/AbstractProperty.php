<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Property;

use Affinity\SimpleAuth\Model\PropertyInterface;
use Affinity\SimpleAuth\Helper\ClassHelper;

/**
 * 
 * Abstract definition 
 * 
 * @package Affinity.SimpleAuth
 * 
 */
abstract class AbstractProperty implements PropertyInterface
{
    /**
     * Unique identifier of the property.
     * 
     * @var mixed $propertyId
     */
    private $propertyId;
    
    /**
     * Value of the property.
     * 
     * @var mixed $propertyValue 
     */
    private $propertyValue;
    
    /**
     * Property constuctor.  Defaults the property Id in as the
     * name of the class, without namespaces.
     * 
     * @param type $default
     */
    public function __construct($default = false)
    {
        $this->setValue($default);
        $this->propertyId = ClassHelper::GetClassnameFromFullyQualified(get_class($this));
    }
    
    /**
     * Returns the unique property identifier.
     * 
     * @return mixed Unique property identifier.
     */
    public function getPropertyId()
    {
        return $this->propertyId;
    }

    /**
     * Returns the value of the property.
     * 
     * @return mixed Property value.
     */
    public function getValue()
    {
        return $this->propertyValue;
    }

    /**
     * Sets the value of the property.
     * 
     * @param mixed $value The value which the property will be set to.
     */
    public function setValue($value)
    {
        $this->propertyValue = $value;
    }
}
