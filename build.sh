#!/bin/bash

./dcp build
cp .env.local.docker .env.local
./dcp composer install
./dcp php bin/console doctrine:schema:create --env=dev
