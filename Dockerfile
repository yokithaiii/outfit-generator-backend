FROM php:8.2-fpm

# System deps
RUN apt-get update && apt-get install -y \
    git unzip curl libpq-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy code
COPY . .

# Install dependencies
RUN composer install --optimize-autoloader --no-dev
