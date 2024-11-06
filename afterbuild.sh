#!/bin/bash

cd /var/www/html

cp .env.example .env

composer install

php artisan key:generate

# php artisan migrate

apache2-foreground
