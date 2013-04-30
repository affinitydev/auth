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

use Affinity\SimpleAuth\Generic\Resource\ObjectResourceProxy;

/**
 * 
 * Class Description.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
trait ObjectResourceTrait
{
    public static function getResource($key = null)
    {
        return new ObjectResourceProxy(self::getResourceName(), $key);
    }
}