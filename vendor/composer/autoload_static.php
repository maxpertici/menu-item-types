<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite73746999016f68c6ba32422bbd87176
{
    public static $files = array (
        'ec224cf6c752fb07fdf33257d272c280' => __DIR__ . '/../..' . '/functions/register.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MXP\\MITypes\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MXP\\MITypes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite73746999016f68c6ba32422bbd87176::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite73746999016f68c6ba32422bbd87176::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite73746999016f68c6ba32422bbd87176::$classMap;

        }, null, ClassLoader::class);
    }
}
