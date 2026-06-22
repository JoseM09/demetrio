FROM php:8.2-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite for URL routing
RUN a2enmod rewrite

# Configure Apache to allow .htaccess overrides
RUN sed -i 's|AllowOverride None|AllowOverride All|g' /etc/apache2/apache2.conf

# Set the document root to the public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' \
        /etc/apache2/sites-available/000-default.conf \
    && sed -i 's|<Directory /var/www/html>|<Directory /var/www/html/public>|g' \
        /etc/apache2/apache2.conf

# Copy application code
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/public/uploads

EXPOSE 80
