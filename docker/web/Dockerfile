FROM php:7.2.23-apache

WORKDIR /

RUN apt-get update

RUN curl -sS https://getcomposer.org/installer | php && \
  mv composer.phar /usr/local/bin/composer

RUN apt-get update && apt-get install -y \
  git \
  wget \
  libpng-dev \
  zlib1g-dev \
  openssl \
  zip \
  unzip \
  nano

RUN docker-php-ext-install gd && \
  docker-php-ext-install opcache && \
  docker-php-ext-install zip && \
  docker-php-ext-install pdo_mysql

RUN apt-get install -y gnupg2 && \
  curl -sL https://deb.nodesource.com/setup_6.x | bash - && \
  apt-get install -y nodejs && \

  a2enmod rewrite

RUN apt-get install -y libxrender1 \
    libfontconfig1 \
    libx11-dev \
    libjpeg62 \
    libxtst6
#RUN pecl install xdebug-2.5.0 && \
#    docker-php-ext-enable xdebug
RUN a2enmod proxy ssl proxy_http proxy_ajp

WORKDIR /
COPY ./entry-point.sh /
COPY ./000-default.conf /etc/apache2/sites-available/
COPY php.ini-development $PHP_INI_DIR/php.ini
RUN chmod 777 ./entry-point.sh

WORKDIR /var/www/html/video-management
#RUN php artisan queue:work redis
# composer require guzzlehttp/guzzle:~6.0
# composer require predis/predis
# composer require phpoffice/phpspreadsheet
# composer require maatwebsite/excel
# composer require barryvdh/laravel-debugbar --dev

# CMD ["apache2-foreground"]

#RUN apt-get install npm && \
#RUN npm install bootstrap-fileinput
