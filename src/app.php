<?php
date_default_timezone_set('Europe/Paris');

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Application();
$app->register(new UrlGeneratorServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
  'dbs.options' => array(
      'db1' => array(
          'driver'   => 'pdo_sqlite',
          'path'     => __DIR__.'/../var/db/app.db',
      ),
      'db2' => array(
          'driver'   => 'pdo_sqlite',
          'path'     => __DIR__.'/../var/db/app.db',
      ),
  ),
));

$app->register(new TwigServiceProvider());
$app['twig'] = $app->share($app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...

    return $twig;
}));

/* DB init */

$schema = "CREATE TABLE IF NOT EXISTS sample (id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT);";
$statement = $app['db']->prepare($schema);
$statement->execute();

return $app;
