<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3f110d828492e3e137d32a470302408d
{
    public static $classMap = array (
        'App\\Controllers\\ArticlesController' => __DIR__ . '/../..' . '/app/controllers/ArticlesController.php',
        'App\\Controllers\\HomeController' => __DIR__ . '/../..' . '/app/controllers/HomeController.php',
        'App\\Core\\App' => __DIR__ . '/../..' . '/core/App.php',
        'App\\Core\\Request' => __DIR__ . '/../..' . '/core/Request.php',
        'App\\Core\\Router' => __DIR__ . '/../..' . '/core/Router.php',
        'App\\Models\\Article' => __DIR__ . '/../..' . '/app/models/Article.php',
        'ComposerAutoloaderInit3f110d828492e3e137d32a470302408d' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit3f110d828492e3e137d32a470302408d' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Connection' => __DIR__ . '/../..' . '/core/database/Connection.php',
        'QueryBuilder' => __DIR__ . '/../..' . '/core/database/QueryBuilder.php',
        'simple_html_dom' => __DIR__ . '/../..' . '/simple_html_dom.php',
        'simple_html_dom_node' => __DIR__ . '/../..' . '/simple_html_dom.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit3f110d828492e3e137d32a470302408d::$classMap;

        }, null, ClassLoader::class);
    }
}