# Usar la imagen base de PHP con Apache
FROM php:8.1-apache

# Instalar extensiones necesarias y Composer
RUN apt-get update && apt-get install -y \
    zip unzip curl git libpq-dev libonig-dev libxml2-dev && \
    docker-php-ext-install mysqli pdo pdo_mysql && \
    a2enmod rewrite

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configurar el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto al contenedor
COPY . /var/www/html

# Configurar permisos y habilitar .htaccess
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    echo '<Directory /var/www/html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>' >> /etc/apache2/apache2.conf

# Instalar dependencias de Composer en modo optimizado
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto 80
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
