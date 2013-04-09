<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Decision;

use Affinity\SimpleAuth\Model\UserInterface;
use Affinity\SimpleAuth\Model\RoleInterface;
use Affinity\SimpleAuth\Model\ResourceInterface;
use Affinity\SimpleAuth\Model\PropertyInterface;
use Affinity\SimpleAuth\Model\PermissionInterface;
use Affinity\SimpleAuth\Model\DecisionInterface;

use Affinity\SimpleAuth\Helper\ContextContainerTrait;

/**
 * 
 * Default decision implementation.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class ResourceDecision implements DecisionInterface
{    
    use ContextContainerTrait;
    
    /**
     * Determines whether or not to use this decision for
     * the given resource.
     * 
     * @param mixed $resource The resource to test for a decision.
     */
    public function testDecision($resource)
    {
        if($resource instanceof ResourceInterface)
            return true;
        
        return false;
    }
    
    public function makeDecision($resource, array $params = null)
    {
        /* @var $resource ResourceInterface */
        return "Resource Decision.  Name: " . $resource->getName() . ", Key: " . $resource->getKey() . " <br/>";
    }
}
