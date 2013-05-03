<?php

/**
 * This file is part of the Affinity Development 
 * open source toolset.
 * 
 * @author Brendan Bates <brendanbates89@gmail.com>
 * @package Affinity.SimpleAuth
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */

use Affinity\SimpleAuth\AuthContext;
use Affinity\SimpleAuth\AuthManager;
use Affinity\SimpleAuth\Generic\Decision\ObjectDecision;
use Affinity\SimpleAuth\Generic\Decision\StringDecision;
use Affinity\SimpleAuth\Generic\User;

/*
 * This file instantiates a new instances of the SimpleAuth
 * framework manually.  It assumes no autoloader has been
 * registered, and manually loads all class files.
 */

$_simpleAuthRoot = __DIR__ . "/src/Affinity/SimpleAuth";

require_once $_simpleAuthRoot . "/AuthContext.php";
require_once $_simpleAuthRoot . "/AuthManager.php";
require_once $_simpleAuthRoot . "/Generic/User.php";
require_once $_simpleAuthRoot . "/Model/ActionInterface.php";
require_once $_simpleAuthRoot . "/Model/ContextContainerInterface.php";
require_once $_simpleAuthRoot . "/Model/DecisionInterface.php";
require_once $_simpleAuthRoot . "/Model/PermissionInterface.php";
require_once $_simpleAuthRoot . "/Model/RoleInterface.php";
require_once $_simpleAuthRoot . "/Model/UserInterface.php";
require_once $_simpleAuthRoot . "/Helper/ClassHelper.php";
require_once $_simpleAuthRoot . "/Helper/PermissionHelper.php";
require_once $_simpleAuthRoot . "/Helper/Extension/ContextContainerTrait.php";
require_once $_simpleAuthRoot . "/Helper/Extension/ObjectResourceTrait.php";
require_once $_simpleAuthRoot . "/Helper/Extension/ResourceClassNameTrait.php";
require_once $_simpleAuthRoot . "/Helper/Extension/ResourceFullClassNameTrait.php";
require_once $_simpleAuthRoot . "/Helper/Extension/ResourceKeyTrait.php";
require_once $_simpleAuthRoot . "/Generic/User.php";
require_once $_simpleAuthRoot . "/Generic/Action.php";
require_once $_simpleAuthRoot . "/Generic/Role.php";
require_once $_simpleAuthRoot . "/Generic/Permission.php";
require_once $_simpleAuthRoot . "/Generic/Resource/ObjectResourceInterface.php";
require_once $_simpleAuthRoot . "/Generic/Resource/ObjectResourceProxy.php";
require_once $_simpleAuthRoot . "/Generic/Decision/StringDecision.php";
require_once $_simpleAuthRoot . "/Generic/Decision/ObjectDecision.php";
require_once $_simpleAuthRoot . "/Exception/Exception.php";
require_once $_simpleAuthRoot . "/Exception/StrategyNotFoundException.php";
require_once $_simpleAuthRoot . "/Exception/UserNotProvidedException.php";

return new AuthContext(
    new AuthManager(array(
        new StringDecision(),
        new ObjectDecision()
    )),
    new User()
);