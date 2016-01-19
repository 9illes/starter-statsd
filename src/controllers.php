<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/* BACKEND API */

$backend_api = $app['controllers_factory'];
$backend_api->get('/', function () use ($app) {
    return $app->json(array(
        'service' => 'backend',
        'version' => $app['version']
    ));
});

/* FRONTEND API */

$app->get('/', function () use ($app) {
    return $app['twig']->render('index.html', array('version' => $app['version']));
})
->bind('homepage')
;

$app->get('/sample', function () use ($app) {
    return "";
})
->bind('sample')
;

/* Errors */

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }

    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = array(
        'errors/'.$code.'.html',
        'errors/'.substr($code, 0, 2).'x.html',
        'errors/'.substr($code, 0, 1).'xx.html',
        'errors/default.html',
    );

    return new Response($app['twig']->resolveTemplate($templates)->render(array('code' => $code)), $code);
});

/*
 * Mounts
 */

$app->mount('/backend', $backend_api);
