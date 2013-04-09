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
class AuthManager
{    
    /**
     * The UserInterface object.
     * 
     * @var AuthContext The UserInterface.
     */
    private $authContext;
    
    /**
     * The DecisionManager determines what type of strategy
     * to use for deciding access on a resource.
     * 
     * @var DecisionManager
     */
    private $decisionManager;
    
    /**
     * Constructor.
     * 
     */
    public function __construct(AuthContext $authContext, DecisionManager $decisionManager)
    {
        $this->decisionManager = $decisionManager;
        $this->authContext = $authContext;
        
        // Set the Context, so that user objects can be accessed.
        $this->decisionManager->setContext($authContext);
    }
    
    /**
     * Decide if the current user context can authenticate to the given
     * object.
     * 
     * @param mixed $resource
     * @param array $parameters
     */
    public function authenticate($object, $parameters = null)
    {
        // Attempt to resolve a decision strategy.
        
        /* @var $strategy DecisionInterface */
        $strategy = $this->decisionManager->getDecisionStrategy($object);
        
        if(!($strategy instanceof DecisionInterface))
            throw new InvalidDecisionException("An invalid decision strategy was returned from the decision manager.  Perhaps the object returned was not a DecisionInterface object.");
        
        $strategy->makeDecision($object, $parameters);
    }
    
    public function getUser()
    {
        return $this->authContext->getUser();
    }
    
    public function setUser(UserInterface $user)
    {
        $this->authContext->setUser($user);
    }
}
