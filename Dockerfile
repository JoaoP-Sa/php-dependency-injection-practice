FROM php:8.2-apache

RUN a2enmod rewrite 

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN apt-get update && apt-get install -y  \
    && apt-get install -y libzip-dev \
    && apt-get install -y zlib1g-dev \
    && apt-get install -y sendmail \
    && apt-get install -y libonig-dev \
    && apt-get install -y libfreetype6-dev \
    && apt-get install -y libjpeg-dev \
    && apt-get install -y libpng-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli \
    && docker-php-ext-configure gd --with-freetype=/usr/include/freetype2 --with-jpeg=/usr/include \
    && docker-php-ext-install gd

# Limpeza do cache do apt para manter a imagem mais leve
RUN apt-get clean && rm -rf /var/lib/apt/lists/*