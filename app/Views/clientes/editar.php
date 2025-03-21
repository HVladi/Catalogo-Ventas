<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar (copiado del index) -->
        

        <!-- Contenido principal -->
        <div class="main-content">
            <div class="container-fluid">
                <h2 class="mb-4">Editar Cliente</h2>

                <!-- Mostrar mensajes de éxito o error -->
                <?php if (session('success')): ?>
                    <div class="alert alert-success"><?= session('success') ?></div>
                <?php endif; ?>
                <?php if (session('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Formulario de edición -->
                <!-- Formulario de edición -->
                <form action="<?= base_url('/clientes/actualizar/' . $cliente['id_usuario']) ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" name="nombre_usuario" class="form-control" value="<?= $cliente['nombre_usuario'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" value="<?= $cliente['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña (dejar en blanco para no cambiar)</label>
                        <input type="password" name="contrasena" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="imagen_perfil" class="form-label">Imagen de Perfil (dejar en blanco para no cambiar)</label>
                        <input type="file" name="imagen_perfil" class="form-control">
                        <?php if ($cliente['imagen_perfil']): ?>
                            <img src="<?= base_url('uploads/' . $cliente['imagen_perfil']) ?>" alt="Imagen de perfil" width="100" class="mt-2">
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>