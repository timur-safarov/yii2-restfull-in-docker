# Use an official PHP runtime
FROM php:8.1-apache


RUN apt-get update && apt-get install -y \
    git \
    zip \
    curl \
    sudo \
    unzip \
    libzip-dev \
    libicu-dev \
    libbz2-dev \
    libpng-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    g++

# Enable Apache modules
RUN a2enmod rewrite
# Install any extensions you need
RUN docker-php-ext-install mysqli pdo pdo_mysql
# Set the working directory to /var/www/html
WORKDIR /var/www/html
# Copy the source code in /www into the container at /var/www/html
COPY ../www .
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
