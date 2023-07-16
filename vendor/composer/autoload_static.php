<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite4c9c9ab205a25407a41f7145587f149
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Grav\\Plugin\\TagManager\\' => 23,
        ),
        'A' => 
        array (
            'Aura\\Autoload\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Grav\\Plugin\\TagManager\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
        'Aura\\Autoload\\' => 
        array (
            0 => __DIR__ . '/..' . '/aura/autoload/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Grav\\Plugin\\TagManagerPlugin' => __DIR__ . '/../..' . '/tag-manager.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite4c9c9ab205a25407a41f7145587f149::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite4c9c9ab205a25407a41f7145587f149::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite4c9c9ab205a25407a41f7145587f149::$classMap;

        }, null, ClassLoader::class);
    }
}