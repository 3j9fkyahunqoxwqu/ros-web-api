<?php

namespace SlatmanROSWebAPI;

use Httpful\Request;


class ROSClient
{
    const VERSION               = "0.0.1";
    const USER_AGENT_SUFFIX     = "ros-web-api-php-client/";

    const ENDPOINT_BASE         = "api/";

    const ENDPOINT_REALMS       = "realms";
    const ENDPOINT_USERS        = "users";
    const ENDPOINT_STATS        = "stats";
    const ENDPOINT_INFO         = "info";
    const ENDPOINT_FUNCTIONS    = "fx";
    const ENDPOINT_LOGS         = "logs/config";
    const ENDPOINT_LOGS_LINES   = "logs/lines/level"; // e.g. all, warn, info; logs are sent via websocket

    const DEFAULT_OFFSET        = 0;
    const DEFAULT_LIMIT         = 10;

    const DEFAULT_PORT          = 9080;
    const DEFAULT_HOST          = 'http://localhost';

    /**
     * @var array $config
     */
    private $config;
    
    public function __construct(array $config = []) {
        $this->config = array_merge(
            [
                'endpoint_base'     => self::ENDPOINT_BASE,
                'port'              => self::DEFAULT_PORT,
                'host'              => self::DEFAULT_HOST,
            ],
            $config
        );

        $url = $this->createRequestURL(self::ENDPOINT_REALMS);

	    $response = Request::get($url)->send();

	    var_dump($response);
    }

    private function createRequestURL($path) {
        $host = $this->config['host'];
        $port = $this->config['port'];
        $url = $host.':'.$port.'/'.self::ENDPOINT_BASE.$path;

        return $url;
    }

    public function users() {
        $url = $this->createRequestURL(self::ENDPOINT_USERS);
    }

    public function info() {
        $url = $this->createRequestURL(self::ENDPOINT_INFO);
    }

    public function realms() {
        $url = $this->createRequestURL(self::ENDPOINT_REALMS);
    }

    public function stats() {
        $url = $this->createRequestURL(self::ENDPOINT_STATS);
    }

    public function functions() {
        $url = $this->createRequestURL(self::ENDPOINT_FUNCTIONS);
    }

    // TODO: add logs and log lines
}
