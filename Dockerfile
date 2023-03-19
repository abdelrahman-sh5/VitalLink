FROM php:7.2.5-apache
WORKDIR /the/workdir/path

# Mod Rewrite
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg-turbo-dev \
    libpng-dev

# Composer
# COPY --from=composer:latest  dest

# PHP Extension 
RUN docker-php-ext-install gettext intl pdo_mysql gd