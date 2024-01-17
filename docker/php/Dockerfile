FROM php:8.3-fpm

RUN apt update 
RUN apt install git zip unzip libxml2-dev -y

RUN docker-php-ext-install pdo_mysql 

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1
