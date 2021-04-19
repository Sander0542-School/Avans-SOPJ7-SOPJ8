FROM php:8-apache

# NodeJS
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get update && apt-get install -y nodejs

# PHP Extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# VHost
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Source
COPY . /var/www
COPY .env.example .env
RUN chown -R www-data:www-data /var/www

WORKDIR /var/www

# Depedencies
RUN composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist
RUN npm ci --production && npm run production && rm -r node_modules

CMD ["apache2-foreground"]
