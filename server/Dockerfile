FROM php:7.4-alpine as base

WORKDIR /app


COPY --from=composer:1 /usr/bin/composer /usr/bin/composer
COPY . /app


RUN composer install --dev
