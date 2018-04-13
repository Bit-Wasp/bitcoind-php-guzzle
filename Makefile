deps:
		if [ ! -d build ]; then mkdir build; fi
		if [ ! -d vendor ]; then composer install; fi

phpunit-ci: deps
		vendor/bin/phpunit --coverage-clover=build/coverage.clover

phpcbf: deps
		vendor/bin/phpcbf -n --standard=PSR1,PSR2 src test/unit

phpcs: deps
		vendor/bin/phpcs -n --standard=PSR1,PSR2 src test/unit

ocular:
		wget https://scrutinizer-ci.com/ocular.phar

ifdef OCULAR_TOKEN
scrutinizer: ocular
		@php ocular.phar code-coverage:upload --format=php-clover build/coverage.clover --access-token=$(OCULAR_TOKEN);
else
scrutinizer: ocular
		php ocular.phar code-coverage:upload --format=php-clover build/coverage.clover;
endif
