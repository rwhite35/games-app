<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb66e9184b492d42c3e215f8bb8880ca5
{
    public static $files = array (
        'e277be14c90068cf94faed2c43dbe6d8' => __DIR__ . '/..' . '/symfony/polyfill-php71/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Php71\\' => 23,
            'Symfony\\Contracts\\' => 18,
            'Symfony\\Component\\VarExporter\\' => 30,
            'Symfony\\Component\\ClassLoader\\' => 30,
            'Symfony\\Component\\Cache\\' => 24,
        ),
        'P' => 
        array (
            'Psr\\SimpleCache\\' => 16,
            'Psr\\Log\\' => 8,
            'Psr\\Cache\\' => 10,
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
        'Symfony\\Polyfill\\Php71\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-php71',
        ),
        'Symfony\\Contracts\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/contracts',
        ),
        'Symfony\\Component\\VarExporter\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/var-exporter',
        ),
        'Symfony\\Component\\ClassLoader\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/class-loader',
        ),
        'Symfony\\Component\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/cache',
        ),
        'Psr\\SimpleCache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/simple-cache/src',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
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
        'EightQueens\\Gameboard\\Module' => __DIR__ . '/../..' . '/module/EightQueens/src/Gameboard/config/local.php',
        'EightQueens\\Gameboard\\Solutions\\Solution' => __DIR__ . '/../..' . '/module/EightQueens/src/Gameboard/Solution.php',
        'Symfony\\Component\\Cache\\Adapter\\AbstractAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/AbstractAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\AdapterInterface' => __DIR__ . '/..' . '/symfony/cache/Adapter/AdapterInterface.php',
        'Symfony\\Component\\Cache\\Adapter\\ApcuAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/ApcuAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\ArrayAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/ArrayAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\ChainAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/ChainAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\DoctrineAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/DoctrineAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\FilesystemAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/FilesystemAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\MemcachedAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/MemcachedAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\NullAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/NullAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\PdoAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/PdoAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\PhpArrayAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/PhpArrayAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\PhpFilesAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/PhpFilesAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\ProxyAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/ProxyAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\RedisAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/RedisAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\SimpleCacheAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/SimpleCacheAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\TagAwareAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/TagAwareAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\TagAwareAdapterInterface' => __DIR__ . '/..' . '/symfony/cache/Adapter/TagAwareAdapterInterface.php',
        'Symfony\\Component\\Cache\\Adapter\\TraceableAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/TraceableAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\TraceableAdapterEvent' => __DIR__ . '/..' . '/symfony/cache/Adapter/TraceableAdapter.php',
        'Symfony\\Component\\Cache\\Adapter\\TraceableTagAwareAdapter' => __DIR__ . '/..' . '/symfony/cache/Adapter/TraceableTagAwareAdapter.php',
        'Symfony\\Component\\Cache\\CacheItem' => __DIR__ . '/..' . '/symfony/cache/CacheItem.php',
        'Symfony\\Component\\Cache\\DataCollector\\CacheDataCollector' => __DIR__ . '/..' . '/symfony/cache/DataCollector/CacheDataCollector.php',
        'Symfony\\Component\\Cache\\DependencyInjection\\CacheCollectorPass' => __DIR__ . '/..' . '/symfony/cache/DependencyInjection/CacheCollectorPass.php',
        'Symfony\\Component\\Cache\\DependencyInjection\\CachePoolClearerPass' => __DIR__ . '/..' . '/symfony/cache/DependencyInjection/CachePoolClearerPass.php',
        'Symfony\\Component\\Cache\\DependencyInjection\\CachePoolPass' => __DIR__ . '/..' . '/symfony/cache/DependencyInjection/CachePoolPass.php',
        'Symfony\\Component\\Cache\\DependencyInjection\\CachePoolPrunerPass' => __DIR__ . '/..' . '/symfony/cache/DependencyInjection/CachePoolPrunerPass.php',
        'Symfony\\Component\\Cache\\DoctrineProvider' => __DIR__ . '/..' . '/symfony/cache/DoctrineProvider.php',
        'Symfony\\Component\\Cache\\Exception\\CacheException' => __DIR__ . '/..' . '/symfony/cache/Exception/CacheException.php',
        'Symfony\\Component\\Cache\\Exception\\InvalidArgumentException' => __DIR__ . '/..' . '/symfony/cache/Exception/InvalidArgumentException.php',
        'Symfony\\Component\\Cache\\Exception\\LogicException' => __DIR__ . '/..' . '/symfony/cache/Exception/LogicException.php',
        'Symfony\\Component\\Cache\\LockRegistry' => __DIR__ . '/..' . '/symfony/cache/LockRegistry.php',
        'Symfony\\Component\\Cache\\Marshaller\\DefaultMarshaller' => __DIR__ . '/..' . '/symfony/cache/Marshaller/DefaultMarshaller.php',
        'Symfony\\Component\\Cache\\Marshaller\\MarshallerInterface' => __DIR__ . '/..' . '/symfony/cache/Marshaller/MarshallerInterface.php',
        'Symfony\\Component\\Cache\\PruneableInterface' => __DIR__ . '/..' . '/symfony/cache/PruneableInterface.php',
        'Symfony\\Component\\Cache\\ResettableInterface' => __DIR__ . '/..' . '/symfony/cache/ResettableInterface.php',
        'Symfony\\Component\\Cache\\Simple\\AbstractCache' => __DIR__ . '/..' . '/symfony/cache/Simple/AbstractCache.php',
        'Symfony\\Component\\Cache\\Simple\\ApcuCache' => __DIR__ . '/..' . '/symfony/cache/Simple/ApcuCache.php',
        'Symfony\\Component\\Cache\\Simple\\ArrayCache' => __DIR__ . '/..' . '/symfony/cache/Simple/ArrayCache.php',
        'Symfony\\Component\\Cache\\Simple\\ChainCache' => __DIR__ . '/..' . '/symfony/cache/Simple/ChainCache.php',
        'Symfony\\Component\\Cache\\Simple\\DoctrineCache' => __DIR__ . '/..' . '/symfony/cache/Simple/DoctrineCache.php',
        'Symfony\\Component\\Cache\\Simple\\FilesystemCache' => __DIR__ . '/..' . '/symfony/cache/Simple/FilesystemCache.php',
        'Symfony\\Component\\Cache\\Simple\\MemcachedCache' => __DIR__ . '/..' . '/symfony/cache/Simple/MemcachedCache.php',
        'Symfony\\Component\\Cache\\Simple\\NullCache' => __DIR__ . '/..' . '/symfony/cache/Simple/NullCache.php',
        'Symfony\\Component\\Cache\\Simple\\PdoCache' => __DIR__ . '/..' . '/symfony/cache/Simple/PdoCache.php',
        'Symfony\\Component\\Cache\\Simple\\PhpArrayCache' => __DIR__ . '/..' . '/symfony/cache/Simple/PhpArrayCache.php',
        'Symfony\\Component\\Cache\\Simple\\PhpFilesCache' => __DIR__ . '/..' . '/symfony/cache/Simple/PhpFilesCache.php',
        'Symfony\\Component\\Cache\\Simple\\Psr6Cache' => __DIR__ . '/..' . '/symfony/cache/Simple/Psr6Cache.php',
        'Symfony\\Component\\Cache\\Simple\\RedisCache' => __DIR__ . '/..' . '/symfony/cache/Simple/RedisCache.php',
        'Symfony\\Component\\Cache\\Simple\\TraceableCache' => __DIR__ . '/..' . '/symfony/cache/Simple/TraceableCache.php',
        'Symfony\\Component\\Cache\\Simple\\TraceableCacheEvent' => __DIR__ . '/..' . '/symfony/cache/Simple/TraceableCache.php',
        'Symfony\\Component\\Cache\\Traits\\AbstractTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/AbstractTrait.php',
        'Symfony\\Component\\Cache\\Traits\\ApcuTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/ApcuTrait.php',
        'Symfony\\Component\\Cache\\Traits\\ArrayTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/ArrayTrait.php',
        'Symfony\\Component\\Cache\\Traits\\ContractsTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/ContractsTrait.php',
        'Symfony\\Component\\Cache\\Traits\\DoctrineTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/DoctrineTrait.php',
        'Symfony\\Component\\Cache\\Traits\\FilesystemCommonTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/FilesystemCommonTrait.php',
        'Symfony\\Component\\Cache\\Traits\\FilesystemTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/FilesystemTrait.php',
        'Symfony\\Component\\Cache\\Traits\\MemcachedTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/MemcachedTrait.php',
        'Symfony\\Component\\Cache\\Traits\\PdoTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/PdoTrait.php',
        'Symfony\\Component\\Cache\\Traits\\PhpArrayTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/PhpArrayTrait.php',
        'Symfony\\Component\\Cache\\Traits\\PhpFilesTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/PhpFilesTrait.php',
        'Symfony\\Component\\Cache\\Traits\\ProxyTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/ProxyTrait.php',
        'Symfony\\Component\\Cache\\Traits\\RedisClusterProxy' => __DIR__ . '/..' . '/symfony/cache/Traits/RedisClusterProxy.php',
        'Symfony\\Component\\Cache\\Traits\\RedisProxy' => __DIR__ . '/..' . '/symfony/cache/Traits/RedisProxy.php',
        'Symfony\\Component\\Cache\\Traits\\RedisTrait' => __DIR__ . '/..' . '/symfony/cache/Traits/RedisTrait.php',
        'Symfony\\Component\\ClassLoader\\ApcClassLoader' => __DIR__ . '/..' . '/symfony/class-loader/ApcClassLoader.php',
        'Symfony\\Component\\ClassLoader\\ClassCollectionLoader' => __DIR__ . '/..' . '/symfony/class-loader/ClassCollectionLoader.php',
        'Symfony\\Component\\ClassLoader\\ClassLoader' => __DIR__ . '/..' . '/symfony/class-loader/ClassLoader.php',
        'Symfony\\Component\\ClassLoader\\ClassMapGenerator' => __DIR__ . '/..' . '/symfony/class-loader/ClassMapGenerator.php',
        'Symfony\\Component\\ClassLoader\\MapClassLoader' => __DIR__ . '/..' . '/symfony/class-loader/MapClassLoader.php',
        'Symfony\\Component\\ClassLoader\\Psr4ClassLoader' => __DIR__ . '/..' . '/symfony/class-loader/Psr4ClassLoader.php',
        'Symfony\\Component\\ClassLoader\\WinCacheClassLoader' => __DIR__ . '/..' . '/symfony/class-loader/WinCacheClassLoader.php',
        'Symfony\\Component\\ClassLoader\\XcacheClassLoader' => __DIR__ . '/..' . '/symfony/class-loader/XcacheClassLoader.php',
        'Symfony\\Component\\VarExporter\\Exception\\ClassNotFoundException' => __DIR__ . '/..' . '/symfony/var-exporter/Exception/ClassNotFoundException.php',
        'Symfony\\Component\\VarExporter\\Exception\\ExceptionInterface' => __DIR__ . '/..' . '/symfony/var-exporter/Exception/ExceptionInterface.php',
        'Symfony\\Component\\VarExporter\\Exception\\NotInstantiableTypeException' => __DIR__ . '/..' . '/symfony/var-exporter/Exception/NotInstantiableTypeException.php',
        'Symfony\\Component\\VarExporter\\Instantiator' => __DIR__ . '/..' . '/symfony/var-exporter/Instantiator.php',
        'Symfony\\Component\\VarExporter\\Internal\\Exporter' => __DIR__ . '/..' . '/symfony/var-exporter/Internal/Exporter.php',
        'Symfony\\Component\\VarExporter\\Internal\\Hydrator' => __DIR__ . '/..' . '/symfony/var-exporter/Internal/Hydrator.php',
        'Symfony\\Component\\VarExporter\\Internal\\Reference' => __DIR__ . '/..' . '/symfony/var-exporter/Internal/Reference.php',
        'Symfony\\Component\\VarExporter\\Internal\\Registry' => __DIR__ . '/..' . '/symfony/var-exporter/Internal/Registry.php',
        'Symfony\\Component\\VarExporter\\Internal\\Values' => __DIR__ . '/..' . '/symfony/var-exporter/Internal/Values.php',
        'Symfony\\Component\\VarExporter\\VarExporter' => __DIR__ . '/..' . '/symfony/var-exporter/VarExporter.php',
        'Symfony\\Contracts\\Cache\\CacheInterface' => __DIR__ . '/..' . '/symfony/contracts/Cache/CacheInterface.php',
        'Symfony\\Contracts\\Cache\\CacheTrait' => __DIR__ . '/..' . '/symfony/contracts/Cache/CacheTrait.php',
        'Symfony\\Contracts\\Cache\\ItemInterface' => __DIR__ . '/..' . '/symfony/contracts/Cache/ItemInterface.php',
        'Symfony\\Contracts\\Cache\\TagAwareCacheInterface' => __DIR__ . '/..' . '/symfony/contracts/Cache/TagAwareCacheInterface.php',
        'Symfony\\Contracts\\Service\\ResetInterface' => __DIR__ . '/..' . '/symfony/contracts/Service/ResetInterface.php',
        'Symfony\\Contracts\\Service\\ServiceLocatorTrait' => __DIR__ . '/..' . '/symfony/contracts/Service/ServiceLocatorTrait.php',
        'Symfony\\Contracts\\Service\\ServiceSubscriberInterface' => __DIR__ . '/..' . '/symfony/contracts/Service/ServiceSubscriberInterface.php',
        'Symfony\\Contracts\\Service\\ServiceSubscriberTrait' => __DIR__ . '/..' . '/symfony/contracts/Service/ServiceSubscriberTrait.php',
        'Symfony\\Contracts\\Tests\\Cache\\CacheTraitTest' => __DIR__ . '/..' . '/symfony/contracts/Tests/Cache/CacheTraitTest.php',
        'Symfony\\Contracts\\Tests\\Cache\\TestPool' => __DIR__ . '/..' . '/symfony/contracts/Tests/Cache/CacheTraitTest.php',
        'Symfony\\Contracts\\Tests\\Service\\ChildTestService' => __DIR__ . '/..' . '/symfony/contracts/Tests/Service/ServiceSubscriberTraitTest.php',
        'Symfony\\Contracts\\Tests\\Service\\ParentTestService' => __DIR__ . '/..' . '/symfony/contracts/Tests/Service/ServiceSubscriberTraitTest.php',
        'Symfony\\Contracts\\Tests\\Service\\ServiceLocatorTest' => __DIR__ . '/..' . '/symfony/contracts/Tests/Service/ServiceLocatorTest.php',
        'Symfony\\Contracts\\Tests\\Service\\ServiceSubscriberTraitTest' => __DIR__ . '/..' . '/symfony/contracts/Tests/Service/ServiceSubscriberTraitTest.php',
        'Symfony\\Contracts\\Tests\\Service\\TestService' => __DIR__ . '/..' . '/symfony/contracts/Tests/Service/ServiceSubscriberTraitTest.php',
        'Symfony\\Contracts\\Tests\\Translation\\TranslatorTest' => __DIR__ . '/..' . '/symfony/contracts/Tests/Translation/TranslatorTest.php',
        'Symfony\\Contracts\\Translation\\TranslatorInterface' => __DIR__ . '/..' . '/symfony/contracts/Translation/TranslatorInterface.php',
        'Symfony\\Contracts\\Translation\\TranslatorTrait' => __DIR__ . '/..' . '/symfony/contracts/Translation/TranslatorTrait.php',
        'Symfony\\Polyfill\\Php71\\Php71' => __DIR__ . '/..' . '/symfony/polyfill-php71/Php71.php',
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
