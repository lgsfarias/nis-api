FROM php:8.0-fpm

RUN apt-get update && apt-get install -y libzip-dev unzip && \
    docker-php-ext-install zip pdo pdo_mysql && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
