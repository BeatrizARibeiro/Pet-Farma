<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6d8c453252d2b12e3a66b863841a6623
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
            'Psr\\Cache\\' => 10,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'N' => 
        array (
            'NFePHP\\NFe\\' => 11,
            'NFePHP\\Gtin\\' => 12,
            'NFePHP\\DA\\' => 10,
            'NFePHP\\Common\\' => 14,
        ),
        'M' => 
        array (
            'MercadoPago\\' => 12,
        ),
        'J' => 
        array (
            'JsonSchema\\' => 11,
        ),
        'D' => 
        array (
            'Doctrine\\Persistence\\' => 21,
            'Doctrine\\Deprecations\\' => 22,
            'Doctrine\\Common\\Lexer\\' => 22,
            'Doctrine\\Common\\Annotations\\' => 28,
            'Doctrine\\Common\\' => 16,
        ),
        'C' => 
        array (
            'Com\\Tecnick\\Color\\' => 18,
            'Com\\Tecnick\\Barcode\\' => 20,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/src',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'NFePHP\\NFe\\' => 
        array (
            0 => __DIR__ . '/..' . '/nfephp-org/sped-nfe/src',
        ),
        'NFePHP\\Gtin\\' => 
        array (
            0 => __DIR__ . '/..' . '/nfephp-org/sped-gtin/src',
        ),
        'NFePHP\\DA\\' => 
        array (
            0 => __DIR__ . '/..' . '/nfephp-org/sped-da/src',
        ),
        'NFePHP\\Common\\' => 
        array (
            0 => __DIR__ . '/..' . '/nfephp-org/sped-common/src',
        ),
        'MercadoPago\\' => 
        array (
            0 => __DIR__ . '/..' . '/mercadopago/dx-php/src/MercadoPago',
            1 => __DIR__ . '/..' . '/mercadopago/dx-php/tests',
            2 => __DIR__ . '/..' . '/mercadopago/dx-php/src/MercadoPago/Generic',
            3 => __DIR__ . '/..' . '/mercadopago/dx-php/src/MercadoPago/Entities',
            4 => __DIR__ . '/..' . '/mercadopago/dx-php/src/MercadoPago/Entities/Shared',
        ),
        'JsonSchema\\' => 
        array (
            0 => __DIR__ . '/..' . '/justinrainbow/json-schema/src/JsonSchema',
        ),
        'Doctrine\\Persistence\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/persistence/src/Persistence',
        ),
        'Doctrine\\Deprecations\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/deprecations/lib/Doctrine/Deprecations',
        ),
        'Doctrine\\Common\\Lexer\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/lexer/src',
        ),
        'Doctrine\\Common\\Annotations\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/annotations/lib/Doctrine/Common/Annotations',
        ),
        'Doctrine\\Common\\' => 
        array (
            0 => __DIR__ . '/..' . '/doctrine/common/src',
            1 => __DIR__ . '/..' . '/doctrine/event-manager/src',
        ),
        'Com\\Tecnick\\Color\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-color/src',
        ),
        'Com\\Tecnick\\Barcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/tecnickcom/tc-lib-barcode/src',
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
