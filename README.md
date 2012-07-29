# Nsautoload for Drupal 7.x

Drupal 7.x module which autoloads your modules namespaced classes.

[![Build Status](https://secure.travis-ci.org/korstiaan/nsautoload.png?branch=refactoring)](http://travis-ci.org/korstiaan/nsautoload)

## Requirements

* Drupal 7.x
* PHP 5.3.3+

## Installation

### Download the module

The recommended way to install Nsautoload is with [Composer](http://getcomposer.org). 
Just add the following to your `composer.json`:

```json
   {
   	   "minimum-stability": "dev",
	   "require": {
		   "korstiaan/nsautoload": "dev-master"
	   }
   }
```

Now update Composer and install the newly added requirement and its dependencies:

``` bash
$ php composer.phar update korstiaan/nsautoload
```

If all went well and `composer/installers` did its job, Nsautoload was installed to `modules/nsautoload`. 
If you don't want it there, or it's not part of your Drupal rootdir, symlink it to your folder of choice.   

### Using Composer

Using `Composer` means enabling its autoloader. This can be done in 2 ways:

#### 1. Require _autoload.php_ in _settings.php_ (recommended) 

Add the following to your project's settings.php:

```php
<?php
// /path/to/sites/default/settings.php

require '/path/to/vendor/autoload.php';
```

#### 2. Use [composer_loader](https://github.com/korstiaan/composer_loader)

Just follow its readme.

### Enable Nsautoload

There are 2 ways to enable Nsautoload:

#### 1. Add a few lines to _settings.php_ (recommended)

Add the following to your project's settings.php:

```php
<?php
// /path/to/sites/default/settings.php

use Nsautoload\Nsautoload;

$loader = new Nsautoload();
$loader->register();
```

#### 2. Enable it as a Drupal module.

Go to `site/all/modules` and enable it on `http://yourdomain.com/admin/modules/list`. 
(If you're using [voiture](http://voiture.hoppinger.com) just add `nsautoload` to `cnf/shared/modules.php`)

## Usage

In order for Nsautoload to be able to find your classes some conventions have to be followed:

###	Naming your namespace
 
Your namespace must be the name of your module with an `under_score` to `CamelCase` conversion.
For example:

* `my_module` has namespace `MyModule`
* `my_foo_module` has namespace `MyFooModule`
* `mymodule` has namespace `Mymodule` 

###	Location of your classes
	
Two conventions can be used for this, one following the [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) standard, and a more Drupal'ish convention:

#### 1. PSR-0

This one completely follows the [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) standard, for example:

* `MyModule\Foo` is located at `/path/to/my_module/MyModule/Foo.php`
* `Mymodule\Foo\Bar_Crux` is located at `/path/to/mymodule/Mymodule/Foo/Bar/Crux.php`

#### 2. Drupal-style (deprecated)

When this convention is followed, a class is located at `module_name/class/_class_.class.inc`. Only a 2 level namespace can be used. Examples:

* `MyModule\Foo` is located at `/path/to/my_module/class/foo.class.inc`
* `MyModule\Foo_Bar` is located at `/path/to/my_module/class/foo_bar.class.inc`
* `MyModule\Foo\Bar` can't be mapped with this convention.

## License

Nsautoload is licensed under the MIT license.
