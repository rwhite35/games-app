<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb66e9184b492d42c3e215f8bb8880ca5
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\ClassLoader\\' => 30,
        ),
        'E' => 
        array (
            'EightQueens\\' => 12,
        ),
        'A' => 
        array (
            'Application\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\ClassLoader\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/class-loader',
        ),
        'EightQueens\\' => 
        array (
            0 => __DIR__ . '/../..' . '/module/EightQueens/src',
        ),
        'Application\\' => 
        array (
            0 => __DIR__ . '/../..' . '/module/Application/src',
        ),
    );

    public static $classMap = array (
        'EightQueens\\Gameboard\\CalcDiagonalsInterface' => __DIR__ . '/../..' . '/module/EightQueens/src/Gameboard/CalcDiagonalsInterface.php',
        'EightQueens\\Gameboard\\Calculate\\Diagonals\\CalcDiagonals' => __DIR__ . '/../..' . '/module/EightQueens/src/Gameboard/CalcDiagonals.php',
        'EightQueens\\Gameboard\\Controller\\BoardController' => __DIR__ . '/../..' . '/module/EightQueens/src/Gameboard/BoardController.php',
        'EightQueens\\Gameboard\\Model\\Board' => __DIR__ . '/../..' . '/module/EightQueens/src/Gameboard/Model/Board.php',
        'EightQueens\\Gameboard\\Model\\Validate' => __DIR__ . '/../..' . '/module/EightQueens/src/Gameboard/Model/Validate.php',
        'EightQueens\\Gameboard\\Solutions\\Solution' => __DIR__ . '/../..' . '/module/EightQueens/src/Gameboard/Solution.php',
        'Symfony\\Component\\ClassLoader\\ApcClassLoader' => __DIR__ . '/..' . '/symfony/class-loader/ApcClassLoader.php',
        'Symfony\\Component\\ClassLoader\\ClassCollectionLoader' => __DIR__ . '/..' . '/symfony/class-loader/ClassCollectionLoader.php',
        'Symfony\\Component\\ClassLoader\\ClassLoader' => __DIR__ . '/..' . '/symfony/class-loader/ClassLoader.php',
        'Symfony\\Component\\ClassLoader\\ClassMapGenerator' => __DIR__ . '/..' . '/symfony/class-loader/ClassMapGenerator.php',
        'Symfony\\Component\\ClassLoader\\MapClassLoader' => __DIR__ . '/..' . '/symfony/class-loader/MapClassLoader.php',
        'Symfony\\Component\\ClassLoader\\Psr4ClassLoader' => __DIR__ . '/..' . '/symfony/class-loader/Psr4ClassLoader.php',
        'Symfony\\Component\\ClassLoader\\WinCacheClassLoader' => __DIR__ . '/..' . '/symfony/class-loader/WinCacheClassLoader.php',
        'Symfony\\Component\\ClassLoader\\XcacheClassLoader' => __DIR__ . '/..' . '/symfony/class-loader/XcacheClassLoader.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb66e9184b492d42c3e215f8bb8880ca5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb66e9184b492d42c3e215f8bb8880ca5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb66e9184b492d42c3e215f8bb8880ca5::$classMap;

        }, null, ClassLoader::class);
    }
}
