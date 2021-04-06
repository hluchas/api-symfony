#!/bin/bash
set -e
./dcp vendor/bin/php-cs-fixer fix src
./dcp vendor/bin/phpstan analyse

# This should be done in application logic
./dcp bin/console doctrine:schema:drop --force --env=test
./dcp bin/console doctrine:schema:create --env=test

./dcp vendor/bin/simple-phpunit