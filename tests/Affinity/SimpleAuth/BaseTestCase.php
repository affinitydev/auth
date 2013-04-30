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

use Affinity\SimpleAuth\Model\ActionInterface;
use Affinity\SimpleAuth\Model\PermissionInterface;

/**
 * 
 * Base test class for setting up authorization parameters.
 * 
 * @package Affinity.SimpleAuth
 * 
 */
class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    var $actions    = array();
    var $perms      = array();
    var $roles      = array();
    var $users      = array();
    
    const Resource1 = "Resource1";
    const Resource2 = "Resource2";
    const Resource3 = "Resource3";
    
    const Resource1_Key = 1;
    const Resource2_Key = 2;
    const Resource3_Key = 3;
    
    protected function setUp()
    {
        // Setup test data for all of the SimpleAuth tests to use.
        $this->setUpActions();
        $this->setUpPermissions();
        $this->setUpRoles();
        $this->setUpUsers();
        
        parent::setUp();
    }
    
    protected function tearDown()
    {
        unset($this->actions);
        unset($this->perms);
        unset($this->roles);
        unset($this->users);
        
        parent::tearDown();
    }
    
    private function setUpUsers()
    {
        
    }
    
    /*
     * Sets up one of each action, with both a true and a false version.
     */
    private function setUpActions()
    {
        $this->actions["CreateFalse"] = $this->createMockAction(Action::Create, false);
        $this->actions["CreateTrue"] = $this->createMockAction(Action::Create, true);
        $this->actions["ReadFalse"] = $this->createMockAction(Action::Read, false);
        $this->actions["ReadTrue"] = $this->createMockAction(Action::Read, true);
        $this->actions["UpdateFalse"] = $this->createMockAction(Action::Update, false);
        $this->actions["UpdateTrue"] = $this->createMockAction(Action::Update, true);
        $this->actions["DeleteFalse"] = $this->createMockAction(Action::Delete, false);
        $this->actions["DeleteTrue"] = $this->createMockAction(Action::Delete, true);
        $this->actions["IsGrantedFalse"] = $this->createMockAction(Action::IsGranted, false);
        $this->actions["IsGrantedTrue"] = $this->createMockAction(Action::IsGranted, true);
    }
    
    /**
     * Setup a large amount of test permissions to use.
     */
    private function setUpPermissions()
    {
        $crudArray1 = array(
            $this->actions["CreateFalse"],
            $this->actions["DeleteFalse"],
            $this->actions["UpdateTrue"],
            $this->actions["ReadTrue"]
        );
        
        $crudArray2 = array(
            $this->actions["CreateTrue"],
            $this->actions["DeleteTrue"],
            $this->actions["UpdateFalse"],
            $this->actions["ReadFalse"]
        );
        
        $this->perms["Permissions_Res1_Crud1"] = $this->createMockPermission(self::Resource1, null, $crudArray1);
        $this->perms["Permissions_Res1_Crud2"] = $this->createMockPermission(self::Resource1, self::Resource1_Key, $crudArray1);
        $this->perms["Permissions_Res1_Crud3"] = $this->createMockPermission(self::Resource1, null, $crudArray2);
        $this->perms["Permissions_Res1_Crud4"] = $this->createMockPermission(self::Resource1, self::Resource1_Key, $crudArray2);
        $this->perms["Permissions_Res2_Crud1"] = $this->createMockPermission(self::Resource2, null, $crudArray1);
        $this->perms["Permissions_Res2_Crud2"] = $this->createMockPermission(self::Resource2, self::Resource2_Key, $crudArray1);
        $this->perms["Permissions_Res2_Crud3"] = $this->createMockPermission(self::Resource2, null, $crudArray2);
        $this->perms["Permissions_Res2_Crud4"] = $this->createMockPermission(self::Resource2, self::Resource2_Key, $crudArray2);
        $this->perms["Permissions_Res3_Crud1"] = $this->createMockPermission(self::Resource3, null, $crudArray1);
        $this->perms["Permissions_Res3_Crud2"] = $this->createMockPermission(self::Resource3, self::Resource3_Key, $crudArray1);
        $this->perms["Permissions_Res3_Crud3"] = $this->createMockPermission(self::Resource3, null, $crudArray2);
        $this->perms["Permissions_Res3_Crud4"] = $this->createMockPermission(self::Resource3, self::Resource3_Key, $crudArray2);
        
        $stringArray1 = array(
           $this->actions["IsGrantedTrue"]
        );
        
        $stringArray2 = array(
           $this->actions["IsGrantedFalse"]
        );
        
        $this->perms["Permissions_Res1_String1"] = $this->createMockPermission(self::Resource1, null, $stringArray1);
        $this->perms["Permissions_Res1_String2"] = $this->createMockPermission(self::Resource1, self::Resource1_Key, $stringArray1);
        $this->perms["Permissions_Res1_String3"] = $this->createMockPermission(self::Resource1, null, $stringArray2);
        $this->perms["Permissions_Res1_String4"] = $this->createMockPermission(self::Resource1, self::Resource1_Key, $stringArray2);
        $this->perms["Permissions_Res2_String1"] = $this->createMockPermission(self::Resource2, null, $stringArray1);
        $this->perms["Permissions_Res2_String2"] = $this->createMockPermission(self::Resource2, self::Resource2_Key, $stringArray1);
        $this->perms["Permissions_Res2_String3"] = $this->createMockPermission(self::Resource2, null, $stringArray2);
        $this->perms["Permissions_Res2_String4"] = $this->createMockPermission(self::Resource2, self::Resource2_Key, $stringArray2);
        $this->perms["Permissions_Res3_String1"] = $this->createMockPermission(self::Resource3, null, $stringArray1);
        $this->perms["Permissions_Res3_String2"] = $this->createMockPermission(self::Resource3, self::Resource3_Key, $stringArray1);
        $this->perms["Permissions_Res3_String3"] = $this->createMockPermission(self::Resource3, null, $stringArray2);
        $this->perms["Permissions_Res3_String4"] = $this->createMockPermission(self::Resource3, self::Resource3_Key, $stringArray2);
    }
    
    private function setUpRoles()
    {
        /**
         * Role1: Simple role with only 2 permissions; one with a key, and one without.
         * Permissions are on Resource1.
         */
        $tempPerms = array($this->perms["Permissions_Res1_Crud1"], $this->perms["Permissions_Res1_Crud4"], $this->perms["Permissions_Res1_String1"]);
        $this->roles["Role1"] = $this->createMockRole($tempPerms, 0, null);
            
        /**
         * Role2: IsGranted permission on Resource2.
         */
        $tempPerms = array($this->perms["Permissions_Res2_String1"], $this->perms["Permissions_Res2_String4"], $this->perms["Permissions_Res1_String3"]);
        $this->roles["Role2"] = $this->createMockRole($tempPerms, 1, null);
        
        /**
         * Role3: Parent role for role 4.  Contains Resource2 CRUD permissions.
         */
        $tempPerms = array($this->perms["Permissions_Res3_Crud1"], $this->perms["Permissions_Res3_String1"]);
        $this->roles["Role3"] = $this->createMockRole($tempPerms, 2, null);
        
        /**
         * Role4: Has Role3 as its parent role.
         */
        $tempPerms = array($this->perms["Permissions_Res3_Crud4"], $this->perms["Permissions_Res3_String4"]);
        $this->roles["Role4"] = $this->createMockRole($tempPerms, 3, $this->roles["Role3"]);
        
        /**
         * 
         * Role5: Has a keyed permission and unkeyed permission with same actions,
         * different values.
         */
        $tempPerms = array($this->perms["Permissions_Res1_Crud1"], $this->perms["Permissions_Res1_Crud4"]);
        $this->roles["Role5"] = $this->createMockRole($tempPerms, 4, null);
    }
    
    private function createMockAction($name, $value)
    {
        
        $returnMock = $this->getMock("Affinity\SimpleAuth\Model\ActionInterface");
        $returnMock->expects($this->any())
                     ->method('getName')
                     ->will($this->returnValue($name));
        $returnMock->expects($this->any())
                     ->method('getValue')
                     ->will($this->returnValue($value));
        
        return $returnMock;
    }
    
    private function createMockPermission($resourceName, $resourceKey, $actions)
    {
        $returnMock = $this->getMock("Affinity\SimpleAuth\Model\PermissionInterface");
        $returnMock->expects($this->any())
                     ->method('getActions')
                     ->will($this->returnValue($actions));
        $returnMock->expects($this->any())
                     ->method('getResourceName')
                     ->will($this->returnValue($resourceName));
        $returnMock->expects($this->any())
                     ->method('getResourceKey')
                     ->will($this->returnValue($resourceKey));
        
        return $returnMock;
    }
    
    private function createMockRole($permission, $order, $parent)
    {
        $returnMock = $this->getMock("Affinity\SimpleAuth\Model\RoleInterface");
        $returnMock->expects($this->any())
                    ->method('getPermissions')
                    ->will($this->returnValue($permission));
        $returnMock->expects($this->any())
                    ->method('getOrder')
                    ->will($this->returnValue($order));
        $returnMock->expects($this->any())
                    ->method('getParentRole')
                    ->will($this->returnValue($parent));
        
        return $returnMock;
    }
    
    public function compareActions($action1, $action2)
    {
        if($action1 == null || $action2 == null)
            return false;
        
        if(is_array($action1) && is_array($action2))
        {
            if(count($action1) != count($action2))
                return false;
            
            for($i = 0; $i < count($action1); $i++)
            {
                if(!$this->compareActions($action1[$i], $action2[$i]))
                    return false;
            }
            
            return true;
        }
        else
        {
            if($action1->getName() == $action2->getName() && $action1->getValue() == $action2->getValue())
            {
                return true;
            }

            return false;
        }
    }
}