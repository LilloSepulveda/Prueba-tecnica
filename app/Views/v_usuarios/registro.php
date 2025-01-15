<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Gestión de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('/images/fondo_login.jpeg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
        /* Estilos para el logo */
        .logo-container {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .logo-container img {
            height: 120px; /* Tamaño del logo */
        }
    </style>
</head>
<body>

    <!-- Contenedor para el logo -->
    <div class="logo-container">
        <a href="http://localhost:8080">
            <img src="/images/logo-utalca.png" alt="Logo Universidad de Talca">
        </a>
    </div>

    <div class="form-container">
        <h1>Registro</h1>
        
        <form action="/guardar_usuario" method="POST">

        <?php if (isset($error)): ?>
            <div class="error"><?= esc($error); ?></div>
        <?php endif; ?>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required>
            </div>
            <input type="submit" value="Registrarse">
        <p style="text-align: center; margin-top: 10px;">
            ¿Ya tienes cuenta? <a href="/">Inicia sesión aquí</a>
        </p>
    </div>

</body>
</html>
