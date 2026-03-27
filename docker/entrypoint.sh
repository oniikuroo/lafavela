#!/bin/sh
set -eu

cd /var/www/html

mkdir -p database storage/logs storage/framework/cache/data storage/framework/sessions storage/framework/views
touch database/database.sqlite

chown -R www-data:www-data storage bootstrap/cache database

# Generate an APP_KEY at runtime if Render env var is missing.
if [ -z "${APP_KEY:-}" ]; then
  export APP_KEY="$(php artisan key:generate --show)"
fi

php artisan migrate --force
php artisan db:seed --force

exec "$@"
