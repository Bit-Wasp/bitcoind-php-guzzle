<?php

namespace BitWasp\Tests\Bitcoind\Guzzle;

use BitWasp\Bitcoind\Guzzle\GuzzleDriver;
use Nbobtc\Http\Client;
use Nbobtc\Command\Command;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testClient()
    {
        $driver = new GuzzleDriver(new \GuzzleHttp\Client());
        $client = new Client('https://username:password@localhost:18332');
        $client->withDriver($driver);
        $this->assertNull($client->getResponse());
        $request = $client->getRequest();
        $this->assertInstanceOf('Psr\Http\Message\RequestInterface', $request);
        $uri = $request->getUri();
        $this->assertInstanceOf('Psr\Http\Message\UriInterface', $uri);
        $this->assertEquals('https', $uri->getScheme());
        $this->assertEquals('username:password', $uri->getUserInfo());
        $this->assertEquals('localhost', $uri->getHost());
        $this->assertEquals(18332, $uri->getPort());
    }

    public function testWithKeepAlive()
    {
        $driver = new GuzzleDriver(new \GuzzleHttp\Client());
        $client = new Client('https://username:password@localhost:18332');
        $client->withDriver($driver);
        $client->getRequest()->withHeader('Connection', 'Keep-Alive');
    }

    public function testSendCommand()
    {
        $response = \Mockery::mock(\Psr\Http\Message\ResponseInterface::class);
        $driver   = \Mockery::mock(\BitWasp\Bitcoind\Guzzle\GuzzleDriver::class);
        $driver
            ->shouldReceive('execute')
            ->andReturn($response);
        $client = new Client('https://username:password@localhost:18332');
        $client->withDriver($driver);
        $command  = new Command('gettransaction', array('transactionId'));
        $client->sendCommand($command);
    }

    public function testAgainstHttpBin()
    {
        $driver = new GuzzleDriver(new \GuzzleHttp\Client());
        $client = new Client('https://httpbin.org/post');
        $client->withDriver($driver);

        $command  = new Command('gettransaction', array('transactionId'));
        $response = $client->sendCommand($command);
        $decoded = json_decode($response->getBody()->getContents(), true);
        $this->assertEquals([
            'method' => $command->getMethod(),
            'params' => $command->getParameters(),
            'id' => $command->getId(),
        ], json_decode($decoded['data'], true));
    }
}
