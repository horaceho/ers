<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0988454af4d8f3e452381d6bd5199fe4
{
    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Horaceho\\Ers\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Horaceho\\Ers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0988454af4d8f3e452381d6bd5199fe4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0988454af4d8f3e452381d6bd5199fe4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0988454af4d8f3e452381d6bd5199fe4::$classMap;

        }, null, ClassLoader::class);
    }
}
