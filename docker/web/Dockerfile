FROM php:7.2.23-apache

WORKDIR /
COPY ./entry-point.sh /
COPY ./000-default.conf /etc/apache2/sites-available/

RUN chmod 777 ./entry-point.sh
WORKDIR /var/www/video-managent/
