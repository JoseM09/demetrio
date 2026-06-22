FROM php:8.2-fpm

# Install nginx and PDO MySQL extension
RUN apt-get update && apt-get install -y nginx \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo pdo_mysql

# Copy nginx site configuration
COPY nginx.conf /etc/nginx/sites-available/default

# Copy application code
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/public/uploads

EXPOSE 80

# Start both nginx and php-fpm
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
