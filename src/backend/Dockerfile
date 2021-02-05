FROM php:8.0-fpm-alpine

# Install extensions
RUN docker-php-ext-install pdo_mysql bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Install extra packages
RUN apk --no-cache add bash mysql-client mariadb-connector-c-dev
