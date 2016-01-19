<?php
use Silex\Provider\StatsdServiceProvider;

// configure your app for the production environment

$app['twig.path'] = array(__DIR__.'/../templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');
$app['version'] = '1.0.0';

$app->register(new StatsdServiceProvider(), array(
    'statsd.namespace' => 'silex',
));
