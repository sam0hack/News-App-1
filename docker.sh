#!/usr/bin/env bash

docker-compose run --rm composer update
docker-compose run --rm artisan migrate
docker-compose run --rm artisan db:seed

echo "Done...."
