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

use Affinity\SimpleAuth\Generic\Action;
use Affinity\SimpleAuth\Helper\PermissionHelper;

use Affinity\SimpleAuth\Exception\Exception;

/**
 * 
 * Test class for the PermissionHelper class.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class PermissionHelperTest extends BaseTestCase
{
    /**
     * @test testGetActionFromPermission
     * 
     * This test will check to see if actions are property returned
     * from an individual permission.  It currently checks for:
     *      - A permission that exists, and
     *      - A permission that doesn't exist.
     */
    public function testGetActionFromPermission()
    {       
        // Assert that it finds the delete object.
        $returnAction = PermissionHelper::GetActionFromPermission($this->perms["Permissions_Res1_Crud1"], Action::Delete);
        $this->assertTrue($this->compareActions($this->actions["DeleteFalse"], $returnAction));
        
        // Assert that it finds the delete object.
        $returnAction = PermissionHelper::GetActionFromPermission($this->perms["Permissions_Res1_String1"], Action::Delete);
        $this->assertFalse($this->compareActions($this->actions["DeleteFalse"], $returnAction));
    }
    
    /**
     * @test testMergeActionArrays
     * 
     * Tests the two methods for merging arrays of actions.  One is
     * using overwrites, and the other is not.
     */
    public function testMergeActionArrays()
    {
        // The MergeActionArrays will merge two arrays containing actions.
        $mockAction_1 = $this->actions["DeleteFalse"];
        $mockAction_2 = $this->actions["CreateTrue"];
        $mockAction_3 = $this->actions["IsGrantedTrue"];
        
        // Create the arrays.
        $array1 = array($mockAction_1, $mockAction_2);
        $array2 = array($mockAction_2, $mockAction_3);
        $array3 = array($mockAction_1);
        
        // Create the arrays to compare the results to.
        $resultArray1 = array($mockAction_1, $mockAction_2, $mockAction_2, $mockAction_3);
        $resultArray2 = array($mockAction_1, $mockAction_2, $mockAction_3);
        $resultArray3 = array($mockAction_1, $mockAction_2);
        
        // Run the MergeActionArrays.
        $overwritesFalse = PermissionHelper::MergeActionArrays($array1, $array2, false);
        $overwritesTrue1 = PermissionHelper::MergeActionArrays($array1, $array2, true);
        $overwritesTrue2 = PermissionHelper::MergeActionArrays($array1, $array3, true);
        
        $this->assertTrue($this->compareActions($resultArray1, $overwritesFalse));
        $this->assertTrue($this->compareActions($resultArray2, $overwritesTrue1));
        $this->assertTrue($this->compareActions($resultArray3, $overwritesTrue2));
    }
    
    /**
     * @test testGetActionsFromRole
     * 
     * A large array of tests for the getActionsFromRole function.  Tests include
     * simple role checks, and more advanced role checks with traversals.
     */
    public function testGetActionsFromRole()
    {
        // Simple Role, no key.
        $compareArray = array($this->actions["CreateFalse"]);  
        $returnArray = PermissionHelper::GetActionsFromRole($this->roles["Role1"], Action::Create, BaseTestCase::Resource1);
        $this->assertTrue($this->compareActions($returnArray, $compareArray));
        
        // Simple role, with key.
        $returnArray = PermissionHelper::GetActionsFromRole($this->roles["Role1"], Action::Create, BaseTestCase::Resource1, BaseTestCase::Resource1_Key);
        $compareArray = array($this->actions["CreateTrue"]);
        $this->assertTrue($this->compareActions($returnArray, $compareArray));
        
        // Simple role, not found.
        $returnArray = PermissionHelper::GetActionsFromRole($this->roles["Role1"], "NonExistantAction", BaseTestCase::Resource1);
        $this->assertEquals(array(), $returnArray);
        
        // Simple role, no key.
        $returnArray = PermissionHelper::GetActionsFromRole($this->roles["Role2"], Action::IsGranted, BaseTestCase::Resource2);
        $compareArray = array($this->actions["IsGrantedTrue"]);
        $this->assertTrue($this->compareActions($returnArray, $compareArray));
        
        // Simple role, with key.
        $returnArray = PermissionHelper::GetActionsFromRole($this->roles["Role2"], Action::IsGranted, BaseTestCase::Resource2, BaseTestCase::Resource2_Key);
        $compareArray = array($this->actions["IsGrantedFalse"]);
        $this->assertTrue($this->compareActions($returnArray, $compareArray));
        
        // Role with parent (Role 4)
        // Check with key first, should return child action.
        $returnArray = PermissionHelper::GetActionsFromRole($this->roles["Role4"], Action::Create, BaseTestCase::Resource3, BaseTestCase::Resource3_Key);
        $compareArray = array($this->actions["CreateTrue"]);
        $this->assertTrue($this->compareActions($returnArray, $compareArray));
        
        // Check without key.  Should match on parent role.
        $returnArray = PermissionHelper::GetActionsFromRole($this->roles["Role4"], Action::Create, BaseTestCase::Resource3);
        $compareArray = array($this->actions["CreateFalse"]);
        $this->assertTrue($this->compareActions($returnArray, $compareArray));
        
        /**
         * Check with key.  Should match on child role.
         * 
         * $returnFirst will be set to false.  This means that it should traverse the entire tree,
         * even if it finds the key in the first Role.  It should return a CreateTrue and CreateFalse.
         */
        $returnArray = PermissionHelper::GetActionsFromRole($this->roles["Role4"], Action::Create, BaseTestCase::Resource3, BaseTestCase::Resource3_Key, false);
        $compareArray = array($this->actions["CreateTrue"], $this->actions["CreateFalse"]);
        $this->assertTrue($this->compareActions($returnArray, $compareArray));
        
        /**
         * Check with a key.  It should return all of the keyed actions first, then
         * the unkeyed actions after.
         */
        $returnArray = PermissionHelper::GetActionsFromRole($this->roles["Role5"], Action::Create, BaseTestCase::Resource1, BaseTestCase::Resource1_Key, false);
        $compareArray = array($this->actions["CreateTrue"], $this->actions["CreateFalse"]);
        $this->assertTrue($this->compareActions($returnArray, $compareArray));
        
        /**
         * Check without key.  Should match on parent role.
         * 
         * Test $maxIterations.  By setting it to 1, it should not traverse the Role tree past
         * the first Role.  If it does, an exception should be thrown.
         */
        $exceptionThrown = false;
        try
        {
            $returnArray = PermissionHelper::GetActionsFromRole($this->roles["Role4"], Action::Create, BaseTestCase::Resource3, BaseTestCase::Resource3_Key, false, 1);
        } catch(Exception $ex)
        {
            $exceptionThrown = true;
        }
        $this->assertTrue($exceptionThrown);
    }
}
