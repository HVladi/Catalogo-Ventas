<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar (copiado del index) -->
        <div class="sidebar">
            <h4 class="text-center mb-4"><i class="bi bi-cart4"></i> Catálogo Admin</h4>
            <a href="<?= base_url('/dashboard') ?>" class="nav-link"><i class="bi bi-house-door"></i> Inicio</a>
            <a href="<?= base_url('/usuarios') ?>" class="nav-link"><i class="bi bi-person-plus"></i> Usuarios</a>
            <a href="<?= base_url('/productos') ?>" class="nav-link"><i class="bi bi-box-seam"></i> Productos</a>
            <a href="<?= base_url('/clientes') ?>" class="nav-link"><i class="bi bi-people"></i> Clientes</a>
            <a href="<?= base_url('/categorias') ?>" class="nav-link"><i class="bi bi-tags"></i> Categorías</a>
            <a href="<?= base_url('/ventas') ?>" class="nav-link"><i class="bi bi-cash-stack"></i> Ventas</a>
            <a href="<?= base_url('/configuracion') ?>" class="nav-link"><i class="bi bi-gear"></i> Configuración</a>
            <a href="<?= base_url('/logout') ?>" class="nav-link"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
        </div>

        <!-- Contenido principal -->
        <div class="main-content">
            <div class="container-fluid">
                <h2 class="mb-4">Editar Usuario</h2>

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
                <form action="<?= base_url('/usuarios/actualizar/' . $usuario['id_usuario']) ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
                        <input type="text" name="nombre_usuario" class="form-control" value="<?= $usuario['nombre_usuario'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" name="email" class="form-control" value="<?= $usuario['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña (dejar en blanco para no cambiar)</label>
                        <input type="password" name="contrasena" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="confirmar_contrasena" class="form-label">Repetir Contraseña</label>
                        <input type="password" name="confirmar_contrasena" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="rol" class="form-label">Rol</label>
                        <select name="rol" class="form-select" required>
                            <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="usuario" <?= $usuario['rol'] === 'usuario' ? 'selected' : '' ?>>Usuario</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="imagen_perfil" class="form-label">Imagen de Perfil</label>
                        <input type="file" name="imagen_perfil" class="form-control">
                        <?php if ($usuario['imagen_perfil']): ?>
                            <img src="<?= base_url('uploads/' . $usuario['imagen_perfil']) ?>" alt="Imagen de perfil" width="100" class="mt-2">
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