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

use Affinity\SimpleAuth\Exception\StrategyNotFoundException;

use Affinity\SimpleAuth\Helper\ContextContainerTrait;

use Affinity\SimpleAuth\Model\DecisionInterface;
use Affinity\SimpleAuth\Model\ContextContainerInterface;

/**
 * 
 * Class Description.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class DecisionManager
{    
    /**
     * Array of DecisionInterface strategies, to use for validation
     * of the user context against resources.
     * 
     * @var array $strategies 
     */
    private $strategies;
    
    /**
     * The counter representing the number of strategies currently
     * injected.
     * 
     * @var int $strategyCount
     */
    private $strategyCount = 0;
    
    /**
     * The authentication context.
     * 
     * @var AuthContext $authContext
     */
    private $authContext = null;
    
    /**
     * Constructor.
     * 
     * @param array $decisionStrategies
     */
    public function __construct(array $decisionStrategies)
    {
        $this->strategies = array();
        
        /* @var $strategy DecisionInterface */
        foreach($decisionStrategies as $strategy)
        {
            $this->injectStrategy($strategy);
        }
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
    public function injectStrategy(DecisionInterface $strategy, $location = null)
    {
        if(isset($location))
        {
            if($location > $this->strategyCount)
                throw new \OutOfRangeException("The location to insert a new test and strategy is out of bounds.");
            
            $tempStrategyArray = array($strategy);
            
            array_splice($this->strategies, $location, 0, $tempStrategyArray);
        } 
        else
        {
            $this->strategies[$this->strategyCount] = $strategy;
        }
        
        // Inject the current authContext.
        if($this->authContext != null)
            $strategy->setContext($this->authContext);
        
        $this->strategyCount++;
    }
    
    /**
     * Returns a strategy for determining the decision on a
     * resource.
     * 
     * @return DecisionInterface The decision strategy for the object.
     */
    public function getDecisionStrategy($resource, array $parameters = null)
    {
        /* @var $strategy DecisionInterface */
        foreach($this->strategies as $strategy)
        {
            if($strategy->testDecision($resource, $parameters))
                return $strategy;
        }
        
        throw new StrategyNotFoundException("No strategy was matched for the resource provided.  Did you inject a strategy to handle the type of resource you are authenticating?");
    }
    
    /**
     * Sets the current authentication context, and also passes it
     * to the underlying strategies.
     * 
     * @param \Affinity\SimpleAuth\AuthContext $context
     */
    public function setContext(AuthContext $context)
    {
        /* @var $strategy DecisionInterface */
        foreach($this->strategies as $strategy)
            $strategy->setContext ($context);
        
        $this->authContext = $context;
    }
}
