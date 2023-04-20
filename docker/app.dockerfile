FROM php:8.1-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    libmagickwand-dev \
    ghostscript \
    libpq-dev \
    libzip-dev \
    redis-tools \
    postgresql-client

RUN pecl install zip \
    && pecl install imagick \
    && pecl install redis

RUN docker-php-ext-enable zip \
    && docker-php-ext-enable imagick \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql pdo_mysql \
    && docker-php-ext-install gd \
    && docker-php-ext-enable redis \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install sockets

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
