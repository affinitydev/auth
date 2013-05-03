<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Helper\Extension;

/**
 * 
 * A couple of commonly used
 * 
 * @package Affinity.SimpleAuth
 * 
 */
trait DecisionTrait
{
    private $hasDecisionRan = false;
    
    /**
     * @inheritdoc
     */
    public function hasDecisionRan()
    {
        return $this->hasDecisionRan;
    }
    
    /**
     * @inheritdoc
     */
    public function setDecisionRan($value)
    {
        $this->hasDecisionRan = $value;
    }
}
