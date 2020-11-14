FROM php:7.4-fpm

RUN apt-get update && apt-get install -y

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        curl \
#        php7-pdo \
#        php7-pdo_mysql \
#        php7-mysqli \
#        php7-mcrypt \
#        php7-mbstring \
#        php7-xml \
#        php7-openssl \
#        php7-json \
#        php7-phar \
#        php7-zip \
#        php7-gd \
#        php7-dom \
#        php7-session \
    && docker-php-ext-install \
        zip \
        pdo \
        pdo_mysql \
        intl

RUN docker-php-ext-enable pdo_mysql


RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
COPY . /var/www/
WORKDIR /var/www/