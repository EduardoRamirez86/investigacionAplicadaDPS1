# Usar una imagen base de PHP con Apache
FROM php:8.2-apache

# Copiar los archivos de la aplicación al contenedor
COPY . /var/www/html/

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]