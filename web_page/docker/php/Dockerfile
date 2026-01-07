FROM php:8.2-fpm

# Install system dependencies required by pdo_pgsql
RUN apt-get update && apt-get install -y libpq-dev

# Install the PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Set the working directory inside the container
WORKDIR /var/www/html

# Expose the port you intend to use
EXPOSE 9000

CMD ["php-fpm"]