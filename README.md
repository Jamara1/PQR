## Sobre Gestor PQR

Es un sistema que permite crear, editar, eliminar y cambiar el estado en el que se encuentra la PQR (Peticiones, quejas y reclamos) por los tipos de usuario Administrador y usuario.

## Administradores

- Inicia con un administrador por defecto con credenciales:
    - usuario: admin y contraseña: 123456789
- Vista de inicio.
- Este tipo de usuario solo puede ser creado por otro administrador en el formulario de creación de usuarios.
- Crear, editar, listar y visualizar usuarios (La creación solo de administradores, el de usuario normal con el formulario del menu de inicio de sesión).
- Tiene permisos de creación, editar, listar y visualizar de los PQRs.
- Descargar un informe en Excel de los PQRs. 
- Cambiar la contraseña del usuario que tiene iniciado sesión.

## Usuarios

- Solamente puede registrarse en el formulario inicial de registro.
- Vista de inicio.
- Tiene permisos de creación de PQR y de la previzualicación que fuerón hechos por el propio usuario.
- Cambiar la contraseña del usuario que tiene iniciado sesión.

## Version de framework
- Laravel 9

## Requerimientos
- Xampp
- Php 8^
- Composer

## Ejecución
- Copiar los elementos de este enlace en la carpeta raiz del proyecto PQR/ para mejor experiencia de usuario y de la base de datos:
    - [Recursos](https://drive.google.com/drive/folders/1mRwthMAEycN-q-8EJFLqyu08jWu0oFdg?usp=sharing)
- Ejecutar el comando:
    - composer i
- Instalará los componentes necesarios de composer
- Si da error composer i ejecutar el siguiente comando:
    - composer i --ignore-platform-reqs
- Ejecutar el comando:
    - npm i
- Instalará los componentes necesarios de node
- Crear base de datos establecida en el .env en el gestor mysql phpMyAdmin
- Correr las migraciones con el comando:
    - php artisan migrate
-  Ejecutar los seeders
    - php artisan migrate:fresh --seed
- Comando para ejecutar el servidor laravel:
    - php artisan serve
- Comando para ejecutar el servidor npm:
    - npm run watch
- Necesario ejecutar los dos servidores para mejor experiencia

## Web
- El archivo de las rutas web se encuentran en la carpeta routes/web.php

## Api
- El archivo de las rutas de api se encuentran en la carpeta routes/api.php cada ruta añadido en este archivo es agregado el prefijo api/*
