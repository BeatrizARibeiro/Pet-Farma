<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6d8c453252d2b12e3a66b863841a6623
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6d8c453252d2b12e3a66b863841a6623::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6d8c453252d2b12e3a66b863841a6623::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6d8c453252d2b12e3a66b863841a6623::$classMap;

        }, null, ClassLoader::class);
    }
}
