FROM php:7.2.23-apache

RUN apt-get update
RUN a2enmod rewrite headers
#RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

RUN apt-get install -y \
zlib1g-dev \
        zip \
    git \
    curl \
    sudo

RUN docker-php-ext-install \
zip \

    mbstring \
    pdo \
    pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /
COPY ./entry-point.sh /
COPY ./000-default.conf /etc/apache2/sites-available/
RUN chmod 777 ./entry-point.sh

#WORKDIR /var/www
#RUN chmod -R 777 video-management

WORKDIR /var/www/video-management
RUN composer require guzzlehttp/guzzle:~6.0
RUN composer require predis/predis



