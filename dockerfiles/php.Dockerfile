FROM php:8.3-fpm-alpine

WORKDIR /var/www/chystagriadka

# Установим необходимые зависимости
RUN apk add --no-cache icu-dev g++ make autoconf

# Установим и сконфигурируем расширение intl
RUN docker-php-ext-configure intl \
    && docker-php-ext-install intl pdo pdo_mysql \
    && docker-php-ext-enable intl