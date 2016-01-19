<?php
namespace Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Domnikl\Statsd\Connection\UdpSocket;
use Domnikl\Statsd\Connection\TcpSocket;
use Statsd\ClientFactory;

class StatsdServiceProvider implements ServiceProviderInterface
{

    public function register(Application $app)
    {
        $app['statsd'] = $app->share(
            function () use ($app) {

                // Set Default host and port
                $options = array();
                if (isset($app['statsd.host'])) {
                    $options['host'] = $app['statsd.host'];
                }
                if (isset($app['statsd.socket'])) {
                    $options['socket'] = $app['statsd.socket'];
                }
                if (isset($app['statsd.port'])) {
                    $options['port'] = $app['statsd.port'];
                }
                if (isset($app['statsd.namespace'])) {
                    $options['namespace'] = $app['statsd.namespace'];
                }

                // Create
                $statsd = new ClientFactory();
                $statsd->configure($options);

                return $statsd;
            }
        );
    }

    public function boot(Application $app)
    {
    }
}
