#!/usr/bin/env sh
set -eu

cd /var/www
composer install

php-fpm
