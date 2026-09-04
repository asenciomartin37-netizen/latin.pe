# Usa una imagen oficial de PHP con Apache incluido
FROM php:8.2-apache

# Instala las extensiones PDO y PDO MySQL requeridas para tu base de datos
RUN docker-php-ext-install pdo pdo_mysql

# Copia todos los archivos de tu repositorio dentro de la carpeta pública del servidor
COPY . /var/www/html/

# Expone el puerto 80 para el tráfico web externo
EXPOSE 80
