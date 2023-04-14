# Docker Containers (Ejercicio Práctico)
Este ejercicio consiste en el despliegue **contenerizado** de la aplicación *ToDo-List* sobre un entorno local con Docker. 

## 1. Instalación de Docker en Windows
 https://docs.docker.com/desktop/install/windows-install/

## 2. Creación del Workspace de trabajo
- Descomprimir el archivo recién descargado **200sw-todo-list-app-main.zip** en la ubicación deseada.
- Ingresar al directorio descomprimido.

## 3. Revisión del contenido en el workspace
- Una vez en el directorio descomprimido, ingresar a la carpeta **/app**.
    - En esta carpeta se encuentran los archivos relacionados al código de la aplicación ToDo-List (un archivo *.php* y un archivo *.css*).
    - Dentro del archivo *index.php* podremos ver el html de la interfaz gráfica, y adicional, el script en php que nos permite conectarnos con una base de datos MySQL remota para así poder guardar las actividades registras en la aplicación.

## 4. Revisión del archivo Dockerfile
- Regresar al root de la carpeta descomprimida o workspace.
- Revisar el archivo *Dockerfile*.
    - Allí encontraremos las especificaciones para la creación de la imagen referencia para nuestro contenedor.
        ```
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
        ```

## 5. Creación de la imagen para el contenedor
- Con ayuda Docker, creamos nuestra primera versión de la imagen de la aplicación *ToDo-List*. La imagen se llamará **_todo-list-image_** y la versión es **_v1_**:
     ```docker build -t todo-list-image:v1 .

docker run --rm -dp 80:80 todo-app-test:v1

docker login phx.ocir.io

docker tag todo-app-test:v1 phx.ocir.io/idch4uyl2yza/ce-jcc/todo-app:v2

docker push phx.ocir.io/idch4uyl2yza/ce-jcc/todo-app:v2
