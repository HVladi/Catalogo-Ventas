<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f1f5f9;
        }

        .wrapper {
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #023e8a;
            color: #fff;
            padding-top: 1rem;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 12px;
            font-size: 1rem;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: #0077b6;
            border-left: 5px solid #00b4d8;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
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
                <h2 class="mb-4">Usuarios</h2>
                <p class="lead"><?= $mensaje ?></p>

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

                <!-- Formulario para crear usuarios -->
<form action="<?= base_url('/usuarios/crear') ?>" method="post" enctype="multipart/form-data" class="mb-4">
    <div class="row">
        <div class="col-md-4">
            <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
            <input type="text" name="nombre_usuario" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" name="contrasena" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label for="confirmar_contrasena" class="form-label">Repetir Contraseña</label>
            <input type="password" name="confirmar_contrasena" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label for="rol" class="form-label">Rol</label>
            <select name="rol" class="form-select" required>
                <option value="admin">Admin</option>
                <option value="usuario">Usuario</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="imagen_perfil" class="form-label">Imagen de Perfil</label>
            <input type="file" name="imagen_perfil" class="form-control" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-plus"></i> Crear Usuario</button>
</form>
              <!-- Tabla de usuarios -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de usuario</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Imagen de Perfil</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario['id_usuario'] ?></td>
                <td><?= $usuario['nombre_usuario'] ?></td>
                <td><?= $usuario['email'] ?></td>
                <td><?= $usuario['rol'] ?></td>
                <td>
                    <?php if ($usuario['imagen_perfil']): ?>
                        <img src="<?= base_url('uploads/' . $usuario['imagen_perfil']) ?>" alt="Imagen de perfil" width="50">
                    <?php else: ?>
                        Sin imagen
                    <?php endif; ?>
                </td>
                <td>
                    <!-- Botón de Editar -->
                    <a href="<?= base_url('/usuarios/editar/' . $usuario['id_usuario']) ?>" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <!-- Botón de Borrar -->
                    <a href="<?= base_url('/usuarios/borrar/' . $usuario['id_usuario']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas borrar este usuario?');">
                        <i class="bi bi-trash"></i> Borrar
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>