#!/bin/bash

./dcp build
cp .env.local.docker .env.local

./dcp composer install

# Create schemas
./dcp php bin/console doctrine:schema:create --env=dev
./dcp php bin/console doctrine:schema:create --env=test

# Load sample data
./dcp php bin/console doctrine:fixtures:load --no-interaction



