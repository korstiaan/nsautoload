<?php

namespace Nsautoload;

class Nsautoload
{
    /**
     * Registers this instance as an autoloader
     *
     * @param bool $prepend
     */
    public function register($prepend = false)
    {
        spl_autoload_register(array($this, 'loadClass'), true, $prepend);
    }

    /**
     * Unregisters this instance as an autoloader.
     */
    public function unregister()
    {
        spl_autoload_unregister(array($this, 'loadClass'));
    }

    /**
     * Tries to load given class by locating and including its file.
     *
     * @param string $class The name of the class
     *
     * @return bool|null True if loaded
     */
    public function loadClass($class)
    {
        $file = $this->findFile($class);
        if ($file) {
            include $file;

            return true;
        }
    }

    /**
     * Tries to locate the file where the class is defined.
     *
     * @param string $class The name of the class
     *
     * @return string|null Location of the file, or null if not found
     */
    public function findFile($class)
    {
        if (!function_exists('drupal_get_path')) {
            return;
        }
        $class  = ltrim($class, '\\');

        $expl   = explode('\\', $class);
    
        // Convert CamelCase to camel_case
        $module = strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/', '_$1', reset($expl)));

        if (2 === count($expl)) {
            // Locate Foo\Bar in foo/class/bar.class.inc (for BC purposes)
            foreach (array($module, strtolower(reset($expl))) as $mod) { 
                $className = strtolower(end($expl));
                $file      =
                    DRUPAL_ROOT.
                    DIRECTORY_SEPARATOR.
                    drupal_get_path('module', $mod).
                    DIRECTORY_SEPARATOR.
                    'class'.
                    DIRECTORY_SEPARATOR.
                    "{$className}.class.inc";
    
                if (file_exists($file)) {
                    return $file;
                }
            }
        }

        if (1 !== count($expl)) {
            // Locate FooBar\Crux\Class in foo_bar/FooBar/Crux/Class.php
            $classPath = str_replace('_', DIRECTORY_SEPARATOR, array_pop($expl));
            $file      =
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
