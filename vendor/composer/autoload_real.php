<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit2d488cc944a0002c4363f8f7d8fa1cf6
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit2d488cc944a0002c4363f8f7d8fa1cf6', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit2d488cc944a0002c4363f8f7d8fa1cf6', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit2d488cc944a0002c4363f8f7d8fa1cf6::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
