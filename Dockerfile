FROM php:8.2-apache

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Instalar herramientas necesarias para extensiones de PHP
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    zip \
    libicu-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copiar el contenido del proyecto al contenedor
COPY . /var/www/html

# Configurar Composer
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader --verbose
RUN composer dump-autoload --optimize
RUN composer clear-cache

# Configurar Apache
RUN echo "<Directory /var/www/html>\n\
    AllowOverride All\n\
    </Directory>" >> /etc/apache2/apache2.conf

# Configuración de PHP para depuración
RUN echo "display_errors=On\n\
    error_reporting=E_ALL\n\
    log_errors=On\n\
    error_log=/var/log/php_errors.log" >> /usr/local/etc/php/php.ini

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html
