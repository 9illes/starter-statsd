<?php
namespace Silex\Provider;

use Silex\Application;
use Silex\ControllerProviderInterface;

class StatsdControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $app->match('/', 'Silex\Controller\StatsdController::indexAction')
            ->bind('index');

        $app->match('/sample', 'Silex\Controller\StatsdController::sampleAction')
            ->bind('sample');

        return $controllers;
    }
}
