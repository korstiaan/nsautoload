Namespace Autoload for Drupal 7.x
========================
Drupal module which adds support for autoloading namespaced classes.

Requirements
--------------------------------

* Drupal 7.x
* PHP 5.3.2 or higher

Setup / Initial Installation
--------------------------------

Install it as a normal Drupal module. This means downloading (or git clone'ing) it to site/all/modules and enabling it on "admin/modules/list".

If you're using voiture (http://voiture.hoppinger.com) just add "nsautoload" to cnf/shared/modules.php


Usage
--------------------------------

In order for the autoloading to work the following convention needs to be followed:

* Name of namespace should be the same as the name of the module it's used in (not case sensitive)
* Classes should be put in <module>/class/<classname>.class.inc (all lower case).

For example, the autoloader locates Foo\Bar in foo/class/bar.class.inc 

