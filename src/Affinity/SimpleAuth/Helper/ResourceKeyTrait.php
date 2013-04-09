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

/**
 * 
 * Allows for a class to utilize the ResourceInterface
 * automatically.
 * 
 * @package Affinity.SimpleAuth
 * 
 */

trait ResourceKeyTrait
{
    /**
     * Returns the key for the current resource.
     * 
     * @return string The resource key.
     */
    function getKey()
    {
        if(isset($this->Id))
            return $this->Id;
        if(isset($this->id))
            return $this->id;
        if(isset($this->Key))
            return $this->Key;
        if(isset($this->key))
            return $this->key;
    }
}
