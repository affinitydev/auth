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

use Affinity\SimpleAuth\Model\PropertyInterface;

/**
 * 
 * Class Description.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class Property implements PropertyInterface
{
    private $name;
    private $value;
    
    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function getValue() 
    {
        return $this->value;
    }

    /**
     * @inheritdoc
     */
    public function setName(string $name) 
    {
        $this->name = $name;
    }

    /**
     * @inheritdoc
     */
    public function setValue($value) 
    {
        $this->value = $value;
    }    
}
