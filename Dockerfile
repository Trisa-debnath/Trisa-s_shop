FROM php:8.2-cli

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip

# PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Run Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT
