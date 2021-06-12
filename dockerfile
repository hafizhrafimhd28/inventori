FROM php:7.4-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN pecl install redis && docker-php-ext-enable redis
RUN apt-get update && apt-get install --yes libfreetype6-dev
RUN apt-get update -y && apt-get install -y sendmail

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev 
RUN docker-php-ext-install gd

WORKDIR /var/www/html/