<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Helper;

use Affinity\SimpleAuth\AuthContext;

/**
 * 
 * Class Description.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
trait ContextContainerTrait
{
    /**
     * The Authentication Context for the current user.
     * 
     * @var AuthContext $authContext
     */
    private $authContext;
    
    /**
     * 
     * @return AuthContext The authentication context object.
     */
    public function getContext()
    {
        return $this->authContext;
    }
    
    
    public function setContext(AuthContext $context)
    {
        $this->authContext = $context;
    }
}
