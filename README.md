# Affinity.SimpleAuth

The SimpleAuth package is a small, modular, and object-oriented **resource authorization framework** for PHP 5.4 applications.  Some would consider it a _Role-Based Access Control_ (or _RBAC_) framework.  However, we'd like to think it's flexible enough to suite any application; ranging from a small blog with a couple of permissions to suite to an overly complex, workflow-ridden CMS with an advanced role hierarchy, SimpleAuth has you covered.

## Introduction

When talking about security in a web application, it can be broken up into two domains:
- __Authentication__: Verifying a users identity (e.g. logging in, preventing cross-site forgery attacks), and assigning a user credentials.
- __Authorization__: Using a users credentials to grant them access to protected resources.  This could be pages of a website, certain fields of a domain object; theoretically, any kind of data the user has access to.

The SimpleAuth package is provided to conquer __Authorization__.  In order to describe how a user can access a web application, SimpleAuth uses roles and permissions in a relational manner.  Another function of SimpleAuth is to help decouple the authentication and authorization logic in an application, and to keep your authorization logic simple and non-redundant.

## Getting Started

### Terminology

- __User__: The context for the authentication.  Contains all roles and permissions required to authorize against a resource.
- __Role__: A method of grouping permissions together.  Something like a CMS might have commonly used groups, such as moderators.  These groups can be assigned a role, so that all users in the group share moderator permissions.
- __Resource__: Anything that a user can request access to.  A couple examples include a domain object (for example, a comment in a news article system), or a string-based permission (such as "CanHideOnlineStatus", a true/false flag indicating if a user can hide their online status).
- __Action__: A freeform, text-based collection of data, describing operations which can be authenticated against resources.  A domain object may have CRUD-like actions (Create/Read/Update/Delete), where-as a string-based permission might just have one simple true/false action.
- __Permission__: Ties a resource and one or more actions together.

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

### Instantiating SimpleAuth

There are two ways of instantiating SimpleAuth.  One is directly creating all of the required classes.  SimpleAuth is PSR-0 compliant with autoloading, so using Composer or any other PSR-0 autoloader makes instantiating as easy as this:
````php
<?php

use Custom\UserClass;

use Affinity\SimpleAuth\AuthContext;
use Affinity\SimpleAuth\AuthManager;
use Affinity\SimpleAuth\Generic\Decision\StringDeision;
use Affinity\SimpleAuth\Generic\Decision\ObjectDecision;

$authContext = new AuthContext(
    new AuthManager(array(
        new StringDecision(),
        new ObjectDecision()
    )),
    new UserClass()
);
````
Another method is to include the "src.php" from the root SimpleAuth directory:
````php
<?php

$authContext = require_once('vendor/affinitydev/auth/src.php');
````
