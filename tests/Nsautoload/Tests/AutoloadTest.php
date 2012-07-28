<?php
namespace Nsautoload\Tests;

use Nsautoload\Nsautoload;

class AutoloadTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getLoaderTests
     */
    public function testFindFile($className, $location)
    {
        $loader = new Nsautoload();
        $file = $loader->findFile($className);

        $this->assertSame(realpath($file), realpath($location));
    }

     /**
     * @dataProvider getLoaderTests
     */
    public function testLoadClass($className)
    {
        $loader = new Nsautoload();
        $loader->loadClass($className);

        $this->assertTrue(class_exists($className));
    }

    public function getLoaderTests()
    {
        $root = __DIR__.'/../..';

        return array(
            array('NsautoloadUs\\Bar',          $root.'/nsautoload_us/class/bar.class.inc'),
            array('\\NsautoloadUs\\Bar2',       $root.'/nsautoload_us/class/bar2.class.inc'),
            array('NsautoloadUs\\Foo',          $root.'/nsautoload_us/NsautoloadUs/Foo.php'),
            array('\\NsautoloadUs\\Foo2',       $root.'/nsautoload_us/NsautoloadUs/Foo2.php'),
            array('NsautoloadUs\\Foo_Bar',      $root.'/nsautoload_us/class/foo_bar.class.inc'),
            array('\\NsautoloadUs\\Foo_Bar2',   $root.'/nsautoload_us/class/foo_bar2.class.inc'),
            array('Nsautoloadtest\\Foo',        $root.'/nsautoloadtest/Nsautoloadtest/Foo.php'),
            array('\\Nsautoloadtest\\Foo2',     $root.'/nsautoloadtest/Nsautoloadtest/Foo2.php'),
            array('Nsautoloadtest\\Bar',        $root.'/nsautoloadtest/class/bar.class.inc'),
            array('\\Nsautoloadtest\\Bar2',     $root.'/nsautoloadtest/class/bar2.class.inc'),
            array('Nsautoloadtest\\Foo_Bar',    $root.'/nsautoloadtest/Nsautoloadtest/Foo/Bar.php'),
            array('\\Nsautoloadtest\\Foo_Bar2', $root.'/nsautoloadtest/Nsautoloadtest/Foo/Bar2.php'),
        );
    }
}
