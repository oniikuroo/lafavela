FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

COPY . .
RUN composer dump-autoload --no-dev --optimize

FROM node:20-alpine AS frontend

WORKDIR /app

COPY package.json package-lock.json ./
RUN npm ci

COPY . .
RUN npm run build

FROM php:8.2-apache

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y --no-install-recommends libsqlite3-dev unzip \
    && docker-php-ext-install pdo_sqlite \
    && a2enmod rewrite headers \
    && sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf /etc/apache2/apache2.conf \
    && rm -rf /var/lib/apt/lists/*

COPY --from=vendor /app /var/www/html
COPY --from=frontend /app/public/build /var/www/html/public/build
COPY docker/entrypoint.sh /usr/local/bin/app-entrypoint

RUN chmod +x /usr/local/bin/app-entrypoint \
    && mkdir -p /var/www/html/database /var/www/html/storage/logs /var/www/html/storage/framework/cache/data /var/www/html/storage/framework/sessions /var/www/html/storage/framework/views \
    && touch /var/www/html/database/database.sqlite \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/database

ENTRYPOINT ["app-entrypoint"]
CMD ["apache2-foreground"]
