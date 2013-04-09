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

use Affinity\SimpleAuth\Model\AuthContextInterface;
use Affinity\SimpleAuth\Model\UserInterface;

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
    
    public function __construct(UserInterface $user = null)
    {
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
}
