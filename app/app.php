<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;


/*************************
* REGISTER COMPOENTS
*************************/

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../app/views',
));
/*
$app->register(new SilexAssetic\AsseticExtension(), array(
    'assetic.class_path' => __DIR__.'/vendor/assetic/src',
    'assetic.path_to_web' => __DIR__ . '/../web',
    'assetic.options' => array(
        'debug' => TRUE
    ),
    'assetic.filters' => $app->protect(function($fm) {
        $fm->set('scss', new Assetic\Filter\Sass\ScssFilter(
            '/usr/bin/scss'
        ));
    })
));
 */
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
