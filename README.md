## Docker Containers (Ejercicio Práctico)
Este ejercicio consiste en el despliegue **contenerizado** de la aplicación *ToDo-List* sobre un entorno local con Docker. 

### 1. Instalación de Docker en Windows
#### https://docs.docker.com/desktop/install/windows-install/

### 2. Creación del Workspace de trabajo
#### - Descomprimir el archivo **200sw-todo-list-app-main.zip** en la ubicación deseada.
#### - Ingresar al directorio descomprimido.

### 3. Revisión del contenido en el workspace
#### - Una vez en el directorio descomprimido, ingresar a la carpeta **app**.
##### - En esta carpeta se encuentran los archivos relacionados al código de la aplicación ToDo-List (un archivo *.php* y un archivo *.css*).
##### - Dentro del archivo *index.php* podremos ver el html de la interfaz gráfica, y adicional, el script en php que nos permite conectarnos con una base de datos MySql remota para así poder guardar las actividades registras en la aplicación.

### 4. Revisión del archivo Dockerfile
#### - Regresar al root de la carpeta descomprimida o workspace.
#### - Revisar el archivo *Dockerfile*.
##### - Allí encontraremos las especificaciones para la creación de la imagen referencia para nuestro contenedor.
```
FROM php:8.0-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
WORKDIR /var/www/html
COPY app .
ENV DB_HOST="200sw.demo-oci.tk" DB_USER="dbuser" DB_PSSWD="Welcome123!" DB_NAME="todo"
EXPOSE 80
```

docker build -t todo-app-test:v1 .

docker run --rm -dp 80:80 todo-app-test:v1

docker login phx.ocir.io

docker tag todo-app-test:v1 phx.ocir.io/idch4uyl2yza/ce-jcc/todo-app:v2

docker push phx.ocir.io/idch4uyl2yza/ce-jcc/todo-app:v2
