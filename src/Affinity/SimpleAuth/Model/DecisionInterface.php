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
 * Interface to model a decision.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
interface DecisionInterface extends ContextContainerInterface
{    
    /**
     * Determines whether or not to use this decision for
     * the given resource.
     * 
     * @param mixed $resource The resource to test for a decision.
     */
    public function testDecision($resource);
    
    /**
     * Makes a decision based on a given User context, a property
     * to decide against, and a resource (which may be null).
     * 
     * @param mixed $resource Resource to validate the current user context by. 
     * @param array $params Parameters to assist validation of the user context.
     */
    public function makeDecision($resource, array $params = null);
}
