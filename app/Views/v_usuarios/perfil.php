<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - Gestión de Usuarios</title>
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
        .profile-container {
            background-color: rgba(255, 255, 255, 0.8);
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
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: rgb(40, 46, 237);
            color: white;
        }
        .alert-danger {
            background-color: #f44336;
            color: white;
        }
        .profile-info {
            margin-top: 20px;
            text-align: center;
        }
        .profile-info p {
            font-size: 16px;
            margin: 5px 0;
        }
        .actions {
            text-align: center;
            margin-top: 20px;
        }
        .actions a {
            color: #f44336;
            text-decoration: none;
            font-size: 14px;
        }
        .actions a:hover {
            text-decoration: underline;
        }

        .logo-container {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .logo-container img {
            height: 120px; 
        }
    </style>
</head>
<body>

    <div class="logo-container">
        <a href="http://localhost:8080">
            <img src="/images/logo-utalca.png" alt="Logo Universidad de Talca">
        </a>
    </div>

    <div class="profile-container">
        <h1>Perfil de <?= $usuario['nombre']; ?></h1>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
        <form action="/actualizar_perfil" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas actualizar tu cuenta?');">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $usuario['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" value="<?= $usuario['correo']; ?>" required>
            </div>
            <div class="form-group">
                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="contraseña" required>
            </div>
            <input type="submit" value="Actualizar Perfil">
        </form>
        <div class="profile-info">
            <p><strong>Correo:</strong> <?= $usuario['correo']; ?></p>
            <p><strong>Nombre:</strong> <?= $usuario['nombre']; ?></p>
        </div>
        <div class="actions">
            <form action="/eliminar_cuenta" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar tu cuenta?');">
                <button type="submit">Eliminar Cuenta</button>
            </form>
        </div>
    </div>

</body>
</html>
