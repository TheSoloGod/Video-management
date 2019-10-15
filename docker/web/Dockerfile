FROM php:7.2.23-apache

RUN apt-get update
RUN a2enmod rewrite headers
#RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN docker-php-ext-install \
    mbstring \
    pdo \
    pdo_mysql
RUN apt-get install -y \
    git \
    curl \
    sudo
WORKDIR /
COPY ./entry-point.sh /
COPY ./000-default.conf /etc/apache2/sites-available/
RUN chmod 777 ./entry-point.sh



