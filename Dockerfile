FROM ghcr.io/sander0542/laravel:8-php8

# Source
COPY . /var/www
RUN chown -R www-data:www-data /var/www

# Depedencies
RUN composer install --no-dev --no-ansi --no-interaction --no-scripts --prefer-dist
RUN npm ci --production && npm run production && rm -r node_modules

CMD ["apache2-foreground"]
