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

use Affinity\SimpleAuth\Model\ContextContainerInterface;
use Affinity\SimpleAuth\Model\UserInterface;

use Affinity\SimpleAuth\AuthManager;
use Affinity\SimpleAuth\DecisionManager;

/**
 * Offers a context for a UserInterface object, so that any
 * module within SimpleAuth can have access to the current
 * UserInterface.  
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class AuthContext
{
    /**
     * The current user object.
     * 
     * @var UserInterface $user
     */
    private $user;
    private $authManager;
    
    public function __construct(AuthManager $authManager = null, UserInterface $user = null)
    {
        if($authManager != null)
        {
            $this->authManager = $authManager;
            $this->authManager->setContext($this);
        }
        
        if($user != null)
            $this->user = $user;
    }
    
    /**
     * Returns the current user object.
     * 
     * @return UserInterface The current user object.
     */
    public function getUser()
    {
       return $this->user; 
    }
    
    /**
     * Sets the user object to the given UserInterface object.
     * 
     * @param \Affinity\SimpleAuth\Model\UserInterface $user
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;
    }
    
    /**
     * Returns the auth manager.
     * 
     * @return AuthManager
     */
    public function getAuthManager()
    {
        return $this->authManager;
    }
    
    /**
     * 
     * @param \Affinity\SimpleAuth\AuthManager $authManager
     */
    public function setAuthManager(AuthManager $authManager)
    {
        $this->authManager = $authManager;
    }
}
