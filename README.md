# Affinity.SimpleAuth

The SimpleAuth package is a small, modular, and object-oriented **resource authorization framework** for PHP 5.4 applications.  Some would consider it a _Role-Based Access Control_ (or _RBAC_) framework.  However, we'd like to think it's flexible enough to suite any application; ranging from a small blog with a couple of permissions to suite to an overly complex, workflow-ridden CMS with an advanced role hierarchy, SimpleAuth has you covered.

## Introduction

When talking about security in a web application, it can be broken up into two domains:
- __Authentication__: Verifying a users identity (e.g. logging in, preventing cross-site forgery attacks), and assigning a user credentials.
- __Authorization__: Using a users credentials to grant them access to protected resources.  This could be pages of a website, certain fields of a domain object; theoretically, any kind of data the user has access to.

The SimpleAuth package is provided to conquer __Authorization__.  In order to describe how a user can access a web application, SimpleAuth uses roles and permissions in a relational manner.  Another function of SimpleAuth is to help decouple the authentication and authorization logic in an application, and to keep your authorization logic simple and non-redundant.

## The Basics

### Terminology

- __User__: The context for the authentication.  Contains all roles and permissions required to authorize against a resource.
- __Role__: A method of grouping permissions together.  Something like a CMS might have commonly used groups, such as moderators.  These groups can be assigned a role, so that all users in the group share moderator permissions.
- __Resource__: Anything that a user can request access to.  A couple examples include a domain object (for example, a comment in a news article system), or a string-based permission (such as "CanHideOnlineStatus", a true/false flag indicating if a user can hide their online status).
- __Action__: A freeform, text-based collection of data, describing operations which can be authenticated against resources.  A domain object may have CRUD-like actions (Create/Read/Update/Delete), where-as a string-based permission might just have one simple true/false action.
- __Permission__: Ties a resource and one or more actions together.

### How It Works

Since SimpleAuth finds its roots in RBAC, the system is based roles.  A `UserInterface` object serves as the gateway into a users role data.  A user can have many `RoleInterface` instances as roles.  A `RoleInterface` object also supports inheritance from other Roles.  Each `RoleInterface` object holds the users permissions;  the permissions are what dictates if users can perform certain actions on given resources.  Permissions are represented as objects which implement the `PermissionInterface`.  A `PermissionInterface` object holds the resource name, resource key, and an `ActionInterface` object.  Think of a resource as something like a page on a CMS, and think of an action as something a user would do on that page.  For example, a permission with a resource name of `CmsPage` might have an action called `Edit`; if set to true, then the user could edit the pages of the CMS.

### File Structure

SimpleAuth is small, and browsing the source code is easy.  Here is a map describing the structure:

````
SimpleAuth/            Root Folder
   Exception/          Custom SimpleAuth Exceptions
   Generic/            Generic implementations of objects, such as Actions and Roles.
      Decision/        Default decision engines.
      Resource/        An implementation of a type of resource.
   Helper/             Helper classes, meant to reduce code duplication and speed up development.
      Extension/       Traits to help implement SimpleAuth classes.
   Model/              All SimpleAuth class interfaces, used to implement your own classes.
   AuthContext.php     The AuthContext class is a container for all other SimpleAuth classes.
   AuthManager.php     The front-facing class, responsible for running authorization logic.
````

## Getting Started

The Getting Started section will offer some basic examples of using SimpleAuth, give some insight into the inner workings, and provide boilerplate code to get SimpleAuth up and running.

### Instantiation

There are two ways of instantiating SimpleAuth.  One is directly creating all of the required classes.  SimpleAuth is PSR-0 compliant with autoloading, so using Composer or any other PSR-0 autoloader makes instantiating as easy as this:
````php
<?php

use Affinity\SimpleAuth\AuthContext;
use Affinity\SimpleAuth\AuthManager;
use Affinity\SimpleAuth\Generic\Decision\StringDeision;
use Affinity\SimpleAuth\Generic\Decision\ObjectDecision;
use Affinity\SimpleAuth\Generic\User;

$authContext = new AuthContext(
    new AuthManager(array(
        new StringDecision(),
        new ObjectDecision()
    )),
    new User()
);
````
Another method is to include the "src.php" from the root SimpleAuth directory:
````php
<?php
define("VENDOR_DIR", "../vendor");
$authContext = require_once(VENDOR_DIR . "affinitydev/auth/src.php");
````

### Using the AuthManager and User

To begin with the basics of SimpleAuth, first an instance of the `AuthManager` must be retrieved.  This can be done very simply by using the `AuthContext`:
````php
$authManager = $authContext->getAuthManager();
$user = $authContext->getUser();
````
The `AuthManager` is the primary class in the SimpleAuth system.  It is in charge of figuring out whether or not users have the ability to access resources.    It uses the `UserInterface` object provided to it to access the users roles and permissions.  This is what the `allowed` function is used for:
````php
AuthManager->allowed($resource, $params = null);
````
The `$params` can be one of two things: an array of named parameters, to assist with authorization; or a string.  If a string is passed in, the `$params` will be converted to an array, and the string will be in `$params["Action"]`.  The array key `$params['Action']` represents the Action which SimpleAuth will test against the resource.

### String Permissions
A string permission is exactly what it sounds like: it's a permission in which the resource is a string.  This is useful for describing permissions not on objects, but instead describe the users allowed behavior.  For example, the following would check to see if the user is allowed on the "CanHideOnlineStatus" permission (for a message board or instant messenger):
````php
$canHide = $authManager->allowed("CanHideOnlineStatus");
````
Note that no second parameter is passed.  This is because all String Permissions are checked to have the `IsGranted` action set to `true`.  The following permission would the "CanHideOnlineStatus" permission to `true`:
````php
$action = new Action(Action::IsGranted, true);

$permission = new Permission();
$permission->setResourceName("CanHideOnlineStatus");
$permission->addAction($action);
````
