#!/bin/bash

./dcp build
./dcp composer install
./dcp php bin/console doctrine:schema:create --env=dev


