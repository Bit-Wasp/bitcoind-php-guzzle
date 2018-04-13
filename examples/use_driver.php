<?php

require __DIR__ . "/../vendor/autoload.php";
use BitWasp\Bitcoind\Guzzle\GuzzleDriver;
use GuzzleHttp\Client;
use Nbobtc\Command\Command;

$url = 'http://bitcoinrpcuser:bitcoinrpcpassword@localhost:18332';
$httpDriver = new GuzzleDriver(new Client());
$client = (new \Nbobtc\Http\Client($url))
    ->withDriver($httpDriver);
$result = $client->sendCommand(new Command('getblockchaininfo'));
var_dump($result);
