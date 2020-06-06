FROM php:5.6-apache
MAINTAINER osmel osmel.calderon@gmail.com

# Comun
RUN apt-get clean && apt-get update && \
  apt-get install -y \
   apt-utils \
    openssl \
    git \
    curl


# PHP
## intl
RUN apt-get update && \
  apt-get install -y libicu-dev && \
  docker-php-ext-configure intl && \
  docker-php-ext-install intl

## imagenes
RUN apt-get update \
  && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libgd-dev && \
  docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
  docker-php-ext-install \
    gd \
    exif

## Base de datos
RUN \
  docker-php-ext-configure mysql --with-mysql=mysqlnd && \
  docker-php-ext-configure mysqli --with-mysqli=mysqlnd && \
  docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd && \
  docker-php-ext-install \
    mysql \
    mysqli \
    pdo_mysql

## mcrypt
RUN apt-get update && \
  apt-get install -y \
    libmcrypt-dev && \
  docker-php-ext-install mcrypt

## strings
RUN docker-php-ext-install \
  gettext \
  mbstring \
  iconv

## math coincidencias
RUN apt-get update && \
  apt-get install -y \
    libgmp-dev && \
  ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h && \
  docker-php-ext-install \
    gmp \
    bcmath


## compression
RUN apt-get update && \
  apt-get install -y \
    libbz2-dev \
    zlib1g-dev && \
  docker-php-ext-install \
    zip \
    bz2        

## ftp
RUN apt-get update && \
  apt-get install -y \
    libssl-dev && \
  docker-php-ext-install \
    ftp

## curl
RUN apt-get update && \
  apt-get install -y \
    libcurl4-openssl-dev && \
  docker-php-ext-install \
    curl

## otros
#RUN docker-php-ext-install \
#  calendar \
#  phar \
#  soap \
#  sockets \
#  sysvmsg \
#  sysvsem \
#  sysvshm


## Install composer and put binary into $PATH
RUN curl -sS https://getcomposer.org/installer | php && \
  mv composer.phar /usr/local/bin/ && \
  ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

## npm
#RUN apt-get update && \
#  apt-get install -y \
#    npm


## Install Grunt globally
# RUN npm install -g grunt-cli



# Configuraciones
ENV LOCALTIME America/Mexico_City

ENV HTTPD_CONF_DIR /etc/apache2/conf-enabled/
ENV HTTPD__DocumentRoot /var/www/html

ENV PHP_INI_DIR /usr/local/etc/php

# RUN sed -i "s/DocumentRoot.*/DocumentRoot \${HTTPD__DocumentRoot}/"  /etc/apache2/apache2.conf


#Copiar mi php.ini
# COPY ./php.ini /usr/local/etc/php/

#   copiar mis ficheros de virtualhost
COPY ./prueba.dev.com.conf  /etc/apache2/sites-available/ 
RUN ln -s /etc/apache2/sites-available/prueba.dev.com.conf /etc/apache2/sites-enabled; \
    a2ensite prueba.dev.com.conf; \
    a2enmod rewrite;\
    service apache2 restart; \
    apt-get install --no-install-recommends --no-install-suggests -y nano


EXPOSE 80
EXPOSE 443

# COPY docker-entrypoint.sh /entrypoint.sh

WORKDIR /var/www/html

# ENTRYPOINT ["/entrypoint.sh"]


# Limpiando
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/cache/*
