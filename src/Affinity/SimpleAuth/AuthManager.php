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

use Affinity\SimpleAuth\Model\UserInterface;
use Affinity\SimpleAuth\Model\PropertyInterface;
use Affinity\SimpleAuth\Model\DecisionInterface;
use Affinity\SimpleAuth\Model\PermissionInterface;
use Affinity\SimpleAuth\Model\ContextContainerInterface;

use Affinity\SimpleAuth\Exception\UserNotProvidedException;
use Affinity\SimpleAuth\Exception\InvalidPropertyException;

use Affinity\SimpleAuth\Helper\ContextContainerTrait;

use Affinity\SimpleAuth\DecisionManager;
use Affinity\SimpleAuth\UserContext;

/**
 * 
 * The context for a single users authentication.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class AuthManager implements ContextContainerInterface
{
    use ContextContainerTrait;
    
    /**
     * Decide if the current user context can authenticate to the given
     * object.
     * 
     * @param mixed $resource
     * @param mixed $parameters
     */
    public function authenticate($object, $parameters = null)
    {
        // Attempt to resolve a decision strategy.
        $decisionManager = $this->getContext()->getDecisionManager();
        if((!is_array($parameters)) && $parameters != null)
            $parameters = array("Property" => $parameters);
        
        /* @var $strategy DecisionInterface */
        $strategy = $decisionManager->getDecisionStrategy($object, $parameters);
        
        if(!($strategy instanceof DecisionInterface))
            throw new InvalidDecisionException("An invalid decision strategy was returned from the decision manager.  Perhaps the object returned was not a DecisionInterface object.");
        
        return $strategy->makeDecision($object, $parameters);
        return ($strategy->makeDecision($object, $parameters) ? true : false);
    }
    
}
