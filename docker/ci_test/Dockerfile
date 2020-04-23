FROM php:7.2-cli-stretch


RUN apt-get update && apt-get upgrade


RUN apt-get install -y \
    openssl \
    unzip \
    zlib1g-dev \
    libmcrypt-dev \
    libxml2-dev \
    libpq-dev \
    git


RUN docker-php-ext-install intl opcache pdo_pgsql zip pcntl sockets exif


# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
