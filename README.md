## Guzzle driver for bitcoind-php

[![Build Status](https://travis-ci.org/Bit-Wasp/bitcoind-php-guzzle.svg?branch=master)](https://travis-ci.org/Bit-Wasp/bitcoind-php-guzzle)
[![Code Coverage](https://scrutinizer-ci.com/g/Bit-Wasp/bitcoind-php-guzzle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Bit-Wasp/bitcoind-php-guzzle/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Bit-Wasp/bitcoind-php-guzzle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Bit-Wasp/bitcoind-php-guzzle/?branch=master)

This package provides a guzzle driver for the [nbobtc/bitcoind-php](https://github.com/nbobtc/bitcoind-php) RPC interface.

It's a small package, but allows you to make use of the Guzzle client instead of maintaining the same configuration in terms of curl options.

# Installation

This package has a dependency on nbobtc/bitcoind-php, so installing the driver will also install the package.
Presently it will work alongside 2.0|2.1, but this can be expanded as required (just open an issue). 

    composer require bit-wasp/bitcoind-php-guzzle

# Usage
[Please see this example: ](./examples/use_driver.php)
