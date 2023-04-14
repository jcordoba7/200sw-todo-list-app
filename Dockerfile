# Declaración de la imagen base del contenedor 
FROM php:8.0-apache

# Instalación de la librería de PHP mysqli para conexión a bases de datos MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Definición del root al interior del contenedor sobre el cual será copiado el código fuente de la aplicación
WORKDIR /var/www/html

# Copiado del contenido de la carpeta /app hacia el root del contenedor definido en la línea anterior
COPY app .

# Defición de variables de entorno para la aplicación (en este caso los datos de conexión hacia la base de datos MySQL)
ENV DB_HOST="200sw.demo-oci.tk" DB_USER="dbuser" DB_PSSWD="Welcome123!" DB_NAME="todo"

# Definición del puerto mediante el cual el contenedor recibirá las peticiones
EXPOSE 80
