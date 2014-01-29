<?php

if (!strlen(getenv("ENV"))) {
    defined('ENV') || define('ENV', 'development');
} else {
    defined('ENV') || define('ENV', getenv("ENV"));
}

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

if (ENV != 'production') {
    $app['debug'] = true;
}


/*************************
* REGISTER COMPOENTS
*************************/

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../app/views',
));

if (ENV != 'production') {
    $app->register(new SilexAssetic\AsseticExtension(), array(
        'assetic.class_path' => __DIR__.'/vendor/assetic/src',
        'assetic.path_to_web' => __DIR__ . '/../web',
        'assetic.options' => array(
            'formulae_cache_dir' => __DIR__ . '/assetic/cache',
            'debug' => TRUE
        ),
        'assetic.filters' => $app->protect(function($fm) {
            $fm->set('scss', new Assetic\Filter\Sass\ScssFilter(
                '/usr/bin/sass'
            ));
        }),
        'assetic.assets' => $app->protect(function($am, $fm) {
            $am->set('styles', new Assetic\Asset\AssetCache(
                new Assetic\Asset\GlobAsset(
                    __DIR__ . '/assets/css/*.scss',
                    array($fm->get('scss'))
                ),
                new Assetic\Cache\FilesystemCache(__DIR__ . '/assetic/cache')
            ));
            $am->get('styles')->setTargetPath('/css/styles.css');
        })
    ));
}

/*******************
* SETUP ROUTING
*******************/
$pages = array(
    '/'             => 'home',
);
foreach ($pages as $route => $view) {
    $app->get($route, function () use ($app, $view) {
        return $app['twig']->render($view . '.twig');
    })->bind($view);
}

return $app;
