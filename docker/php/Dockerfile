FROM php:7.4.3-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    wget \
    nano \
    vim \
    git \
    zip \
    unzip \
    zlib1g-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libfreetype6-dev \
    libxml2-dev \
    libzip-dev \
    libonig-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libpq-dev \
    libmagickwand-dev \
    ghostscript \
    && pecl install imagick redis xdebug-3.1.5 \
    && docker-php-ext-enable imagick redis xdebug \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure zip \
    && docker-php-ext-configure pgsql \
    && docker-php-ext-install -j$(nproc) gd soap iconv pdo pdo_mysql pdo_pgsql pgsql zip mbstring exif pcntl \
    && docker-php-source delete

COPY ./ImageMagick/policy.xml /etc/ImageMagick-6/policy.xml
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ADD ./php.ini /usr/local/etc/php/php.ini
ADD ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
ADD ./error_reporting.ini /usr/local/etc/php/conf.d/error_reporting.ini

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

USER www

EXPOSE 9000
CMD ["php-fpm"]
