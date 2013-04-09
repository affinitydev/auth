<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth;

use Affinity\SimpleAuth\Model\PermissionInterface;
use Affinity\SimpleAuth\Model\PropertyInterface;

/**
 * 
 * Represents a permission.  A permission relates one or
 * more properties to a resource.
 *
 * @package Affinity.SimpleAuth
 * 
 */
class Permission implements PermissionInterface
{
    private $resource;
    private $properties;
    
    public function __construct()
    {
        $this->properties = array();
    }
    
    /**
     * @inheritdoc
     */
    public function addProperty(PropertyInterface $property)
    {
        $this->properties[] = $property;
    }

    /**
     * @inheritdoc
     */
    public function getProperties() 
    {
        return $this->properties;
    }

    /**
     * @inheritdoc
     */
    public function getResource()
    {
        return $this->resource;
    }    
}
