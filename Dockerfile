FROM php:7.1-fpm

# Install dependecies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/denr

# Remove default server definition
RUN rm -rf /var/www/html

# Copy existing application directory contents
COPY . /var/www/denr

# Copy existing application directory permissions
COPY --chown=www-data:www-data . /var/www/denr

# Change current user to www
USER www-data

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

# Set permissions
RUN chown -R www-data:www-data /var/www/denr/storage /var/www/denr/bootstrap/cache
