# Docker Containers (Ejercicio Práctico)
Este ejercicio consiste en el despliegue **contenerizado** de la aplicación _ToDo-List_ sobre un entorno local con Docker. 

## 1. Instalación de Docker en Windows
 https://docs.docker.com/desktop/install/windows-install/

## 2. Creación del Workspace de trabajo
- Descomprimir el archivo recién descargado **200sw-todo-list-app-main.zip** en la ubicación deseada.
- Ingresar al directorio descomprimido.
- La estructura de la carpeta o workspace es la siguiente
    
    ```tree
    .
    ├──/200sw-todo-list-app-main
    |    |
    |    ├──/app
    |    |    |
    |    |    ├──index.php
    |    |    └──style.css
    |    ├──Dockerfile
    |    └──README.md
    ```

## 3. Revisión del contenido en el workspace
- Una vez en el directorio descomprimido, ingresar a la carpeta **/app**.
    - En esta carpeta se encuentran los archivos relacionados al código de la aplicación **ToDo-List** (un archivo _.php_ y un archivo _.css_).
    - Dentro del archivo *index.php* podremos ver el html de la interfaz gráfica, y adicional, el script en _php_ que nos permite conectarnos con una base de datos _MySQL_ remota, para así poder guardar las actividades registras en la aplicación.

## 4. Revisión del archivo Dockerfile
- Regresar al root de la carpeta descomprimida o workspace.
- Revisar el archivo *Dockerfile*.
    - Allí encontraremos las especificaciones para la creación de la imagen referencia para nuestro contenedor.
        
        ```dockerfile
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
- Abrir el programa **PowerShell** de Windows.
- Con el comando **cd** situarse en la ubicación del root de nuestro workspace (misma ubicación del Dockerfile)
- Con ayuda de Docker, creamos nuestra primera versión de la imagen de la aplicación *ToDo-List*. La imagen se llamará **todo-list-image** y la versión es **v1**:
     
     ```
     # Construir una imagen a partir del Dockerfile
     docker build -t todo-list-image:v1 .
     ```

- Si deseamos confirmar la creación de la imagen, podemos utilizar el siguiente comando para ver el listado de images creadas.

     ```
     # Listar todas las imagenes
     docker images
     ```

## 6. Creación de un contenedor a partir de la imagen
- Finalmente, creamos un contenedor a partir de la imagen generada anteriormente, el cual será accedido a través del puerto 80
    ```
     # Crear un contenedor basado en la imagen todo-list-image:v1
     docker run --rm -d -p 80:80 todo-list-image:v1
     ```

>### Flags: 
>`-p 80:80` todo el tráfico recibido por el puerto 80 de la máquina local, será redirigido al puerto 80 del contenedor creado.   

>`-d` Docker ejecutará el container en background.

>`--rm` En caso de detener el contenedor, éste será eliminado automáticamente.

- Para comprobar que el contenedor se está ejecutando de manera correcta, ingresamos a algún navegador e ingresamos la siguiente URL.
    - [http://localhost](http://localhost)

