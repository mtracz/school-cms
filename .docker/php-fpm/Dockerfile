ARG COMPOSER_TAG_VERSION=2.0
ARG PHP_VERSION=7.2-fpm-alpine

FROM composer:${COMPOSER_TAG_VERSION} as composer
FROM php:${PHP_VERSION}

WORKDIR "/application"

RUN apk --no-cache add \
    bash \
    git \
    curl \
    libzip-dev \
    zlib-dev \
    icu-dev \
    && docker-php-ext-install \
    pdo_mysql \
    zip \
    intl

COPY ./php.ini /usr/local/etc/php/conf.d/php.ini

### COMPOSER ###
COPY --from=composer /usr/bin/composer /usr/local/bin/composer
###

### XDEBUG ###
COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

ARG INSTALL_XDEBUG=false
ARG XDEBUG_CLIENT_HOST=172.17.0.1
ARG XDEBUG_CLIENT_PORT=9003
ARG XDEBUG_START_WITH_REQUEST=yes
ARG XDEBUG_MODE=debug

RUN if [ ${INSTALL_XDEBUG} = true ]; then \
    apk --no-cache add $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.client_host=${XDEBUG_CLIENT_HOST}" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port=${XDEBUG_CLIENT_PORT}" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode=${XDEBUG_MODE}" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request=${XDEBUG_START_WITH_REQUEST}" >> /usr/local/etc/php/conf.d/xdebug.ini \
;fi
###
