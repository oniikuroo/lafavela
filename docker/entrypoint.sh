#!/bin/sh
set -eu

cd /var/www/html

mkdir -p database storage/logs storage/framework/cache/data storage/framework/sessions storage/framework/views
touch database/database.sqlite

chown -R www-data:www-data storage bootstrap/cache database

php artisan migrate --force

exec "$@"
