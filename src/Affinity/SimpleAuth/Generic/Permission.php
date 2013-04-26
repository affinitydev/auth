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
    private $resourceName;
    private $resourceKey;
    private $actions = array();
    
    /**
     * @inheritdoc
     */
    public function setActions(array $actions)
    {
        $this->actions = $actions;
    }

    /**
     * @inheritdoc
     */
    public function getActions() 
    {
        return $this->actions;
    }

    /**
     * @inheritdoc
     */
    public function getResourceName()
    {
        return $this->resourceName;
    }
    
    /**
     * @inheritdoc
     */
    public function setResourceName($resourceName)
    {
        $this->resourceName = $resourceName;
    }
    
    /**
     * @inheritdoc
     */
    public function getResourceKey()
    {
        return $this->resourceKey;
    }
    
    /**
     * @inheritdoc
     */
    public function setResourceKey($resourceKey)
    {
        $this->resourceKey = $resourceKey;
    }
}
