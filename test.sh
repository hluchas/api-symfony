#!/bin/bash

./dcp vendor/bin/php-cs-fixer fix src
./dcp vendor/bin/phpstan analyse
./dcp vendor/bin/simple-phpunit