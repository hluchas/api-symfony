#!/bin/bash

# Prepare env
./dcp up
sleep 5 # DB server needs some delay to initialize
./dcp php app/console doctrine:schema:drop --full-database
./dcp php bin/console doctrine:schema:update --force

# Run tests
./dcp vendor/bin/codecept run
