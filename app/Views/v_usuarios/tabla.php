<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    
    <div class="container mt-4">
        <h1>Lista de Usuarios</h1>

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
                        <form action="/actualizar" method="post">
                            <td>
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
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
