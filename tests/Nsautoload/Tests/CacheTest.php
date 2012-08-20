<?php
namespace Nsautoload\Tests;

use Nsautoload\Nsautoload;
use Symfony\Component\ClassLoader\ApcClassLoader;

require_once __DIR__.'/AutoloadTest.php';

class CacheTest extends \PHPUnit_Framework_TestCase
{   
    public function setUp()
    {
        if (!class_exists('Symfony\Component\ClassLoader\ApcClassLoader')) {
            $this->markTestSkipped('Class loader not found');
        }
    }
    
	/**
     * @dataProvider getLoaderTests
     */
    public function testFindFile($className, $location)
    {
        $loader = new ApcClassLoader(md5(__DIR__), new Nsautoload());
        $file   = $loader->findFile($className);

        $this->assertSame(realpath($file), realpath($location));
    }
    
    public function getLoaderTests()
    {
        return AutoloadTest::getLoaderTests();
    }
}
