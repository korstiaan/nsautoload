<?php
namespace Nsautoload\Tests;

use Drunit\Drunit;

class ModuleTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        Drunit::enableModule(__DIR__.'/../../../module', array('nsautoload'));
        Drunit::enableModule(__DIR__.'/../../modules/nsautoload_drupal');
    }
    public function testRegistered()
    {
        $this->assertTrue(class_exists('NsautoloadDrupal\\Foo'));
    }
}
