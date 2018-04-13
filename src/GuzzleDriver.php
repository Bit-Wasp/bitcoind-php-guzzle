<?php

namespace BitWasp\Bitcoind\Guzzle;

use GuzzleHttp\Client;
use Nbobtc\Http\Driver\DriverInterface;
use Psr\Http\Message\RequestInterface;

class GuzzleDriver implements DriverInterface
{
    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param RequestInterface $request
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function execute(RequestInterface $request)
    {
        $request = $request->withMethod('POST');
        return $this->client->send($request);
    }
}
