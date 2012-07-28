<?php

namespace Nsautoload;

class Nsautoload
{
    public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'loadClass'), true, $prepend);
    }
    
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }
    
    public function loadClass($class) 
    {

        $file = $this->findFile($class);
        if ($file) {
            include $file;
            return true;
        }
    }
    
    public function findFile($class)
    {
        $class  = ltrim($class,'\\');
        
        $expl   = explode('\\',$class);
		$module = strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/','_$1', $expl[0]));	
		if (2 === count($expl)) {
			// Locate Foo\Bar in foo/class/bar.class.inc  			
			$className 	= strtolower(end($expl));
			$file		= 
			    DRUPAL_ROOT.
			    DIRECTORY_SEPARATOR.
			    drupal_get_path('module', $module).
			    DIRECTORY_SEPARATOR.
			    'class'.
			    DIRECTORY_SEPARATOR.
			    "{$className}.class.inc";
			
			if (file_exists($file)) {
				return $file;
			}
		}
		
		if (1 !== count($expl)) {
			// Locate FooBar\Crux\Class in foo_bar/FooBar/Crux/Class.php
			$classPath	= str_replace('_', DIRECTORY_SEPARATOR, array_pop($expl));	
			$file		= 
				DRUPAL_ROOT.
				DIRECTORY_SEPARATOR.
				drupal_get_path('module', $module).
				DIRECTORY_SEPARATOR.
				implode(DIRECTORY_SEPARATOR, $expl).
				DIRECTORY_SEPARATOR.
				"{$classPath}.php"
			;
			
			if (file_exists($file)) {
				return $file;
			}						
		}
    }
    
    
}