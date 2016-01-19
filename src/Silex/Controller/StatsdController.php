<?php
namespace Silex\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StatsdController
{
    public function indexAction(Application $app, Request $request)
    {
        return new Response(__METHOD__);
    }

    public function sampleAction(Application $app, Request $request)
    {
        return new Response(__METHOD__);
    }
}
