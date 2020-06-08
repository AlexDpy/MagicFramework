FROM php:7.4-alpine as base

WORKDIR /app

FROM base as builder

COPY --from=composer:1 /usr/bin/composer /usr/bin/composer
COPY . /app


FROM builder as prod-dependencies

RUN rm -rf tests \
    && composer install --no-dev -o --classmap-authoritative


FROM prod-dependencies as prod

COPY --from=builder /app /app


FROM builder as test

RUN composer install --dev
