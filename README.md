**Prueba técnica**

**Recursos necesarios para su funcionamiento**
- CodeIgniter 4
- XAMPP v3.3.0
- DBeaver 23.3.2

**Pasos para ejecutar el programa**
1. Descargar los recursos necesarios.
2. Mover el proyecto a la carpeta `htdocs` de XAMPP.
3. Abrir XAMPP e iniciar Apache y MySQL.
4. Crear una nueva base de datos MySQL en DBeaver y ejecutar el script que se encuentra al final de este archivo.
5. Abrir una terminal y navegar hacia la carpeta del proyecto.
6. Ejecutar el comando `php spark serve` para iniciar el servidor.
7. En el navegador, ir a la URL local `http://localhost:8080/`.

**Información adicional**
- Las URLs utilizadas en este proyecto son:  
  - `http://localhost:8080/`
  - `http://localhost:8080/registro`
  - `http://localhost:8080/perfil`
  - `http://localhost:8080/tabla`
- Se creó un usuario normal y un administrador mediante el script. Las credenciales son:  
  - **Administrador**:  
    - Correo: `admin@utal.cl`  
    - Contraseña: `admin123`  
  - **Usuario normal**:  
    - Correo: `usuario@utal.cl`  
    - Contraseña: `user123`

**Script para base de datos**

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
