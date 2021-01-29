<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2b6aa00254195c5ad999664671350e0d
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'IMSGlobal\\LTI\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'IMSGlobal\\LTI\\' => 
        array (
            0 => __DIR__ . '/..' . '/imsglobal/lti/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2b6aa00254195c5ad999664671350e0d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2b6aa00254195c5ad999664671350e0d::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}