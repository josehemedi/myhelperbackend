FROM composer:2 AS composer_deps
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --no-plugins --no-scripts --prefer-dist --optimize-autoloader

FROM node:22-alpine AS frontend_build
WORKDIR /app
COPY package.json package-lock.json* ./
RUN npm install
COPY . .
RUN npm run build

FROM php:8.4-cli-alpine AS app
WORKDIR /var/www/html

RUN apk add --no-cache unzip \
    && apk add --no-cache --virtual .build-deps $PHPIZE_DEPS postgresql-dev sqlite-dev \
    && docker-php-ext-install pdo_sqlite pdo_pgsql \
    && apk del .build-deps

COPY . .
COPY --from=composer_deps /app/vendor ./vendor
COPY --from=frontend_build /app/public/build ./public/build

RUN addgroup -g 1000 app \
    && adduser -D -G app -u 1000 app \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R app:app /var/www/html

USER app

EXPOSE 8000

CMD ["sh", "-c", "php artisan serve --host=0.0.0.0 --port=${PORT:-8000}"]
