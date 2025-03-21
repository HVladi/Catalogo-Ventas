<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Usuario - Tacos el Vladiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f1f3f6;
            font-family: 'Arial', sans-serif;
        }

        .wrapper {
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background: linear-gradient(to bottom, #023e8a, #0077b6);
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
            transition: background-color 0.3s, padding-left 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: #00b4d8;
            padding-left: 20px;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
            width: 100%;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4 class="text-center mb-4"><i class="bi bi-cart4"></i> Catálogo de Ventas</h4>
            <div class="d-flex align-items-center">
                    <!-- Mostrar la foto de perfil y el nombre del usuario -->
                    <?php if ($usuario['imagen_perfil']): ?>
                        <img src="<?= base_url($usuario['imagen_perfil']) ?>" alt="Foto de perfil" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                    <?php endif; ?>
                    <h5 class="mb-0"> <?= $usuario['nombre_usuario'] ?></h5>
                </div>
            <a href="<?= base_url('/compra_venta') ?>" class="nav-link"><i class="bi bi-house-door"></i> Inicio</a>
            <a href="<?= base_url('/carrito') ?>" class="nav-link"><i class="bi bi-cart"></i> Carrito</a>
            <a href="<?= base_url('/configuracion_usuario') ?>" class="nav-link"><i class="bi bi-gear"></i> Configuración</a>
            <a href="<?= base_url('/logout') ?>" class="nav-link"><i class="bi bi-box-arrow-right"></i> Cerrar Sesión</a>
        </div>

        <!-- Contenido principal -->
        <div class="main-content">
            <div class="container-fluid">
                <h2 class="mb-4">Configuración de Usuario</h2>

                <!-- Mostrar mensajes de éxito o error -->
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Formulario de configuración -->
                <form action="<?= base_url('/configuracion_usuario/actualizar') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="<?= $usuario['nombre_usuario'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $usuario['email'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Nueva Contraseña</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena">
                        <small class="text-muted">Deja este campo vacío si no deseas cambiar la contraseña.</small>
                    </div>
                    <div class="mb-3">
                        <label for="imagen_perfil" class="form-label">Imagen de Perfil</label>
                        <input type="file" class="form-control" id="imagen_perfil" name="imagen_perfil">
                        <?php if ($usuario['imagen_perfil']): ?>
                            <img src="<?= base_url($usuario['imagen_perfil']) ?>" alt="Imagen de perfil" class="img-thumbnail mt-2" style="max-width: 150px;">
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>