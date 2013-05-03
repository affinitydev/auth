<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.Auth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

namespace Affinity\SimpleAuth\Generic\Resource;

/**
 * Interface describing a resource for authentication.
 * 
 * @package Affinity.Auth
 */
interface ObjectResourceInterface
{
    /**
     * Returns a generic ObjectResourceProxy instance of the current
     * object.  This is intended to be used to authenticate on
     * an uninitialized object, without calling new on it.
     * 
     * @return Affinity\SimpleAuth\Generic\Resource\ObjectResource
     */
    public static function getResource($key = null);
    
    /**
     * Returns the unique name identifier for the resource.
     * 
     * @return mixed
     */
    public static function getResourceName();
    
    /**
     * Returns the key for the resource.  Can be null.
     * 
     * @return mixed
     */
    public function getResourceKey();
}
