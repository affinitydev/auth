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

use Affinity\SimpleAuth\Model\ActionInterface;
use Affinity\SimpleAuth\Model\PermissionInterface;

use Affinity\SimpleAuth\Generic\Action;

/**
 * 
 * Test class for the PermissionHelper class.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class PermissionHelperTest extends \PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }
    
    
    protected function tearDown()
    {
        parent::tearDown();
    }
    
    public function testGetActionFromPermission()
    {
        // Create mock objects.
        $mockPermission = $this->getMock("Affinity\SimpleAuth\Model\PermissionInterface");
        $mockAction_1 = $this->getMock("Affinity\SimpleAuth\Model\ActionInterface");
        $mockAction_2 = $this->getMock("Affinity\SimpleAuth\Model\ActionInterface");
        
        $mockAction_1->expects($this->any())
                     ->method('getName')
                     ->will($this->returnValue(Action::Create));
        
        $mockAction_2->expects($this->any())
                     ->method('getName')
                     ->will($this->returnValue(Action::Delete));
        
        $mockPermission->expects($this->exactly(2))
                       ->method('getActions')
                       ->will($this->returnValue(array($mockAction_1, $mockAction_2)));
        
        // Assert that it finds the delete object.
        $this->assertEquals($mockAction_2, Helper\PermissionHelper::GetActionFromPermission($mockPermission, Action::Delete));
        
        // Assert that it returns null on a non-existing action.
        $this->assertEquals(null, Helper\PermissionHelper::GetActionFromPermission($mockPermission, Action::Update));
    }
    
    public function testMergeActionArrays()
    {
        // The MergeActionArrays will merge two arrays containing actions.
       
        $mockAction_1 = $this->getMock("Affinity\SimpleAuth\Model\ActionInterface");
        $mockAction_1->expects($this->any())
                     ->method('getName')
                     ->will($this->returnValue(Action::Delete));
        
        $mockAction_2 = $this->getMock("Affinity\SimpleAuth\Model\ActionInterface");
        $mockAction_2->expects($this->any())
                     ->method('getName')
                     ->will($this->returnValue(Action::Create));
        
        $mockAction_3 = $this->getMock("Affinity\SimpleAuth\Model\ActionInterface");
        $mockAction_3->expects($this->any())
                     ->method('getName')
                     ->will($this->returnValue(Action::Update));
        
        // Create the arrays.
        $array1 = array($mockAction_1, $mockAction_2);
        $array2 = array($mockAction_2, $mockAction_3);
        $array3 = array($mockAction_1);
        
        // Result arrays, for comparison.
        $resultArray1 = array($mockAction_1, $mockAction_2, $mockAction_2, $mockAction_3);
        $resultArray2 = array($mockAction_1, $mockAction_2, $mockAction_3);
        $resultArray3 = array($mockAction_1, $mockAction_2);
        
        $overwritesFalse = Helper\PermissionHelper::MergeActionArrays($array1, $array2, false);
        $overwritesTrue1 = Helper\PermissionHelper::MergeActionArrays($array1, $array2, true);
        $overwritesTrue2 = Helper\PermissionHelper::MergeActionArrays($array1, $array3, true);
        
        for($i = 0; $i < count($resultArray1); $i++)
        {
            $this->assertEquals($resultArray1[$i], $overwritesFalse[$i]);
        }
        
        for($i = 0; $i < count($resultArray2); $i++)
        {
            $this->assertEquals($resultArray2[$i], $overwritesTrue1[$i]);
        }
        
        for($i = 0; $i < count($resultArray3); $i++)
        {
            $this->assertEquals($resultArray3[$i], $overwritesTrue2[$i]);
        }
    }
}
