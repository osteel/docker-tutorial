FROM php:7.4-fpm-alpine as backend

# Import extension installer
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/

# Install extensions
RUN install-php-extensions bcmath pdo_mysql redis

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install extra packages
RUN apk --no-cache add bash mysql-client mariadb-connector-c-dev


FROM backend as worker

# Start worker
CMD ["php", "/var/www/backend/artisan", "queue:work"]
