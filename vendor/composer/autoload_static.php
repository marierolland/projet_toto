<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc2a76e5e6574e92bf817e98d20b7fa22
{
    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Whatsma\\ZodiacSign\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Whatsma\\ZodiacSign\\' => 
        array (
            0 => __DIR__ . '/..' . '/whatsma/zodiacsign/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc2a76e5e6574e92bf817e98d20b7fa22::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc2a76e5e6574e92bf817e98d20b7fa22::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
