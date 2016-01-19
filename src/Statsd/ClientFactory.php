<?php
namespace Statsd;

use \Domnikl\Statsd\Connection\UdpSocket;
use \Domnikl\Statsd\Connection\TcpSocket;
use \Domnikl\Statsd\Client as StatsdClient;

class ClientFactory
{
    protected $host = 'localhost';
    protected $port = 8125;
    protected $socket = 'udp';
    protected $namespace = null;

    protected $statsd = null;

    public function __construct()
    {
    }

    public function configure(array $options = array())
    {
        if (!empty($options['host'])) {
            $this->host = $options['host'];
        }

        if (!empty($options['port'])) {
            $this->port = (int) $options['port'];
        }

        if (!empty($options['socket']) && in_array(strtolower($options['socket']), array('udp', 'tcp'))) {
            $this->socket = $options['socket'];
        }

        if (!empty($options['namespace'])) {
            $this->namespace = $options['namespace'];
        }

        if ('udp' === $this->socket) {
            $connection = new UdpSocket($this->host, $this->port);
        } else {
            $connection = new TcpSocket($this->host, $this->port);
        }

        $this->statsd = new StatsdClient($connection, $this->namespace);

        return $this;
    }

    public function getClient()
    {
        return $this->statsd;
    }
}
