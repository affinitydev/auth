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

use Affinity\SimpleAuth\AuthContext;

/**
 * 
 * A context container is an object which can hold
 * an auth context object.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
interface ContextContainerInterface
{
    /**
     * 
     */
    public function getContext();
    
    /**
     * 
     */
    public function setContext(AuthContext $context);
}
