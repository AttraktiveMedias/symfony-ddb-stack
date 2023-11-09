#!/bin/sh

set -ex

apk add --no-cache --virtual .build-deps ${PHPIZE_DEPS}
yes | pecl install xdebug && docker-php-ext-enable xdebug
apk del -f .build-deps