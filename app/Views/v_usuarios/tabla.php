<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
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

    <div class="container mt-4">
        <h1>Lista de Usuarios</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td>
                            <form action="/actualizar" method="post">
                                <input type="hidden" name="correo_original" value="<?= esc($usuario['correo']) ?>">
                                <input type="text" name="nombre" value="<?= esc($usuario['nombre']) ?>" class="form-control">
                        </td>
                        <td>
                                <input type="email" name="correo" value="<?= esc($usuario['correo']) ?>" class="form-control">
                        </td>
                        <td>
                                <input type="password" name="contraseña" value="<?= esc($usuario['contraseña']) ?>" class="form-control">
                        </td>
                        <td>
                                <select name="rol" class="form-control">
                                    <option value="0" <?= $usuario['rol'] == 0 ? 'selected' : '' ?>>Usuario</option>
                                    <option value="1" <?= $usuario['rol'] == 1 ? 'selected' : '' ?>>Administrador</option>
                                </select>
                        </td>
                        <td>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>

                            <form action="/eliminar_tabla" method="post" style="display:inline;">
                                <input type="hidden" name="correo" value="<?= esc($usuario['correo']) ?>">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
