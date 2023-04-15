FROM php:8.0-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
WORKDIR /var/www/html
COPY app .
ENV DB_HOST="200sw.demo-oci.tk" DB_USER="dbuser" DB_PSSWD="Welcome123!" DB_NAME="todo"
EXPOSE 80