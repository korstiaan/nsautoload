# nsautoload for Drupal 7.x

Drupal 7.x module which autoloads your modules namespaced classes.

[![Build Status](https://secure.travis-ci.org/korstiaan/nsautoload.png?branch=refactoring)](http://travis-ci.org/korstiaan/nsautoload)

## Requirements

* Drupal 7.x
* PHP 5.3.3+

## Installation

### Download the module

The recommended way to install `nsautoload` is with [Composer](http://getcomposer.org). 
Just add the following to your `composer.json`:

```json
   {
   	   "minimum-stability": "dev",
	   "require": {
		   "korstiaan/nsautoload": "dev-master"
	   }
   }
```

Now update composer and install the newly added requirement and its dependencies:

``` bash
$ php composer.phar update korstiaan/nsautoload
```

If all went well and `composer/installers` did its job, `nsautoload` was installed to `modules/nsautoload`. 
If you don't want it there, or it's not part of your Drupal rootdir, symlink it to your folder of choice.   

### Using Composer

Using `Composer` means enabling its autoloader. This can be done in 2 ways:

#### 1. Require _autoload.php_ in _settings.php_ (recommended) 

Add the following to your project's settings.php:

```php
// /path/to/sites/default/settings.php

require '/path/to/vendor/autoload.php';
```

#### 2. Use [composer_loader](https://github.com/korstiaan/composer_loader)

Just follow its readme.

### Enable `nsautoload`

There are 2 ways to enable `nsautoload`

#### 1. Add a few lines to _settings.php_ (recommended)

Add the following to your project's settings.php:

```php
// /path/to/sites/default/settings.php

use Nsautoload\Nsautoload;

$loader = new Nsautoload();
$loader->register();
```

#### 2. Enable it as a Drupal module.

Go to `site/all/modules` and enable it on `http://yourdomain.com/admin/modules/list`. 
(If you're using [voiture](http://voiture.hoppinger.com) just add `nsautoload` to `cnf/shared/modules.php`)

## Usage


## License

nsautoload is licensed under the MIT license.
