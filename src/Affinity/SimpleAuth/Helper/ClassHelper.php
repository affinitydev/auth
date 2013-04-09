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
 * Class Description.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
final class ClassHelper
{
    /**
     * Accepts a fully-qualified classname, and returns the
     * classname without the namespaces.
     * 
     * @param string $className The fully qualified classname.
     * 
     * @return string The input classname with namespaces stripped.
     */
    public static function GetClassnameFromFullyQualified($className)
    {
        $classArray = explode('\\', $className);
        $classIndex = count($classArray);
        if($classIndex > 0)
            return $classArray[$classIndex - 1];
        else
            return $classArray[0];
    }
}
