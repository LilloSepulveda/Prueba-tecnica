Prueba-tecnica

Recursos necesarios para su funcionanmiento

-Codeigniter 4

-Xampp v3.3.0

-Dbeaver 23.3.2

Pasos para poder ejecutar el programa

-Descargar los recursos necesarios

-mover el proyecto a la carpeta htdocs de xampp

-abrir xampp y iniciar apache y mysql

-crear una nueva base de datos mysql en dbeaver y ejecutar el script que se encuentra en la parte final de este readme

-abrir una terminal y moverse hacia el proyecto

-ejecutar la instruccion php spark serve para iniciar el servidor 

-en el navegador ir a la url local http://localhost:8080/

Información adicional

-Las urls utilizadas en este proyecto son http://localhost:8080/, http://localhost:8080//registro, http://localhost:8080/perfil, http://localhost:8080/tabla

-se realizo una creacion de usuarios mediante el script, se creo un usuario normal y administrador, las credenciales de esos perfiles son administrador: admin@utal.cl contraseña: admin123 usuario: usuario@utal.cl contraseña: user123


Script para base de datos.

CREATE DATABASE IF NOT EXISTS gestion_usuarios
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_general_ci;

USE gestion_usuarios;

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    rol INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id_usuario),
    CONSTRAINT correo_unique UNIQUE (correo)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;

INSERT INTO usuarios (nombre, correo, contraseña, rol)
SELECT 'Administrador', 'admin@utal.cl', 'admin123', 1
WHERE NOT EXISTS (
    SELECT 1 FROM usuarios WHERE correo = 'admin@utal.cl'
);

INSERT INTO usuarios (nombre, correo, contraseña, rol)
SELECT 'Usuario Normal', 'usuario@utal.cl', 'user123', 0
WHERE NOT EXISTS (
    SELECT 1 FROM usuarios WHERE correo = 'usuario@utal.cl'
);
