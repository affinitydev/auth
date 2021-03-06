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
     * Returns whether or not the decision has ran.  Useful if
     * you need to run multiple decisions on the same object.
     * 
     * @return boolean Represents if the decision has been run
     * in this authorization.
     */
    public function hasDecisionRan();
    
    /**
     * Sets the flag determining if the decision has ran in
     * the current authorization.
     * 
     * @param boolean $value
     */
    public function setDecisionRan($value);
    
    /**
     * Determines whether or not to use this decision for
     * the given resource.  The parameters array may contain
     * a named list of parameters for the decision.
     * 
     * @param mixed $resource The resource to test for a decision.
     */
    public function testDecision($resource, array $params = null);
    
    /**
     * Makes a decision based on a given User context, a property
     * to decide against, and a resource (which may be null).
     * 
     * @param mixed $resource Resource to validate the current user context by. 
     * @param array $params Parameters to assist validation of the user context.
     */
    public function runDecision($resource, array $params = null);
}
