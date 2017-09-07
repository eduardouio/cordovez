<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd436282064fc8da81e7cd19f51f74176
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twig\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twig\\' => 
        array (
            0 => __DIR__ . '/..' . '/twig/twig/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'Twig_' => 
            array (
                0 => __DIR__ . '/..' . '/twig/twig/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd436282064fc8da81e7cd19f51f74176::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd436282064fc8da81e7cd19f51f74176::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitd436282064fc8da81e7cd19f51f74176::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
