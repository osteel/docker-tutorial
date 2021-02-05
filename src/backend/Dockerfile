FROM php:8.0-fpm-alpine as backend

# Import extension installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

# Install extensions
RUN install-php-extensions bcmath pdo_mysql redis

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Install extra packages
RUN apk --no-cache add bash mysql-client mariadb-connector-c-dev


FROM backend as worker

# Start worker
CMD ["php", "/var/www/backend/artisan", "queue:work"]
