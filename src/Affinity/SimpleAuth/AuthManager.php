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

use Affinity\SimpleAuth\Helper\Extension\ContextContainerTrait;

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
    use ContextContainerTrait { ContextContainerTrait::setContext as _setContext; }
    
    /**
     * Array of DecisionInterface strategies, to use for validation
     * of the user context against resources.
     * 
     * @var array $strategies 
     */
    private $decisions = array();
    
    /**
     * The counter representing the number of strategies currently
     * injected.
     * 
     * @var int $strategyCount
     */
    private $decisionCount = 0;
    
    /**
     * Constructor.
     * 
     * @param array $decisionStrategies
     */
    public function __construct(array $decisions = null)
    {
        $this->strategies = array();
        
        if($decisions != null)
        {
            /* @var $strategy DecisionInterface */
            foreach($decisions as $decision)
            {
                $this->addDecision($decision);
            }
        }
    }
    
    /**
     * Decide if the current user context can authenticate to the given
     * object.
     * 
     * @param mixed $resource
     * @param mixed $parameters
     */
    public function allowed($object, $parameters = null)
    {
        // Attempt to resolve a decision strategy.
        if((!is_array($parameters)) && $parameters != null)
            $parameters = array("Action" => $parameters);
        
        /* @var $strategy DecisionInterface */
        $strategy = $this->getDecision($object, $parameters);
        
        if(!($strategy instanceof DecisionInterface))
            throw new InvalidDecisionException("An invalid decision strategy was returned from the decision manager.  Perhaps the object returned was not a DecisionInterface object.");
        
        // Return a strict true/false value.
        return ($strategy->runDecision($object, $parameters) ? true : false);
    }
    
    /**
     * Injects a new test and strategy into the decision manager.  If
     * location is set, then the strategy will be inserted at the
     * location given.
     * 
     * @param callback $test
     * @param callback $strategy
     * @param int $location 
     */
    public function addDecision(DecisionInterface $decision, $location = null)
    {
        if(isset($location))
        {
            if($location > (count($this->decisionCount) - 1))
                throw new \OutOfRangeException("The location to insert a new test and strategy is out of bounds.");
            
            // Splice the arrays to push up any values after the inserted strategy.
            $tempDecisionArray = array($decision);            
            array_splice($this->decisions, $location, 0, $tempDecisionArray);
        } 
        else
        {
            $this->decisions[] = $decision;
        }
        
        // Since the decision is a ContextContainer, the context can be directly
        // injected.
        if($this->getContext() != null)
            $decision->setContext($this->getContext());
    }
    
    /**
     * Returns a strategy for determining the decision on a
     * resource.
     * 
     * @return DecisionInterface The decision strategy for the object.
     */
    public function getDecision($resource, array $parameters = null)
    {
        /* @var $strategy DecisionInterface */
        foreach($this->decisions as $decision)
        {
            if($decision->testDecision($resource, $parameters))
                return $decision;
        }
        
        throw new StrategyNotFoundException("No strategy was matched for the resource provided.  Did you inject a strategy to handle the type of resource you are authenticating?");
    }
    
    /**
     * This function overrides the setContext given by the
     * trait.  When called, it sets the context of the
     * decisions as well. 
     * 
     * @param \Affinity\SimpleAuth\AuthContext $authContext
     */
    public function setContext(AuthContext $authContext)
    {
        // Call function from trait.
        $this->_setContext($authContext);
        
        /* @var $decision DecisionInterface */
        foreach($this->decisions as $decision)
        {
            $decision->setContext($authContext);
        }
    }
}
