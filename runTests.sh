#!/bin/bash

vendor/phpunit/phpunit/phpunit --debug

php artisan db:seed

