#!/bin/bash
docker-compose up -d
docker-compose exec app composer test
docker-compose exec app composer stan
docker-compose down