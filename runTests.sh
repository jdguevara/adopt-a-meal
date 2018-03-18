#!/usr/bin/env bash

#php artisan dusk

vendor/phpunit/phpunit/phpunit --debug

php artisan db:seed

