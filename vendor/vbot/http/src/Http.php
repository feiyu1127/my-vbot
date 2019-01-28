<?php

namespace Vbot\Http;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Hanson\Vbot\Extension\AbstractMessageHandler;

class Http extends AbstractMessageHandler
{
    public $author = 'JaQuan';

    public $version = '1.0';

    public $name = 'http';

    public $zhName = 'guzzle 服务';

    /**
     * @var null|\GuzzleHttp\Client
     */
    public static $client = null;

    public function handler(Collection $message)
    {
    }

    /**
     * 注册拓展时的操作.
     */
    public function register()
    {
        static::$client = new Client();
    }

    /**
     * @param $method
     * @param string $uri
     * @param array $options
     * @param bool $origin
     *
     * @return string|\Psr\Http\Message\ResponseInterface;
     */
    public static function request($method, $uri = '', array $options = [], $origin = false)
    {
        $options = array_merge(['timeout' => 10, 'verify' => false], $options);

        $response = static::$client->request($method, $uri, $options);

        return $origin ? $response : $response->getBody()->getContents();
    }
}