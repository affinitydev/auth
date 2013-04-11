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
 * 
 * Interface describing a resource for authentication.  A resource must
 * have:
 *      - A resource name.  This represents the type of resource, for
 *        example: "BlogPost" as an object resource, or "canEditOwnComments"
 *        as a permission resource.
 * 
 *      - A resource key.  If the resource is a domain object, then the
 *        key represents a specific instance of that domain object.  If the
 *        key is null, then the resource spans the breadth of all instances
 *        of the domain object.
 * 
 * @package Affinity.Auth
 * 
 */
interface ObjectResourceInterface
{
    /**
     * Returns the unique name identifier for the resource.
     * 
     * @return mixed
     */
    public static function getName();
    
    /**
     * Returns the key for the resource.  Can be null.
     * 
     * @return mixed
     */
    public function getKey();    
}
