<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes - Admin</title>
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
                <h2 class="mb-4">Clientes</h2>

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

                <!-- Tabla de clientes -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Usuario</th>
                            <th>Correo</th>
                            <th>Imagen de Perfil</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><?= $cliente['id_usuario'] ?></td>
                                <td><?= $cliente['nombre_usuario'] ?></td>
                                <td><?= $cliente['email'] ?></td>
                                <td>
                                    <?php if ($cliente['imagen_perfil']): ?>
                                        <img src="<?= base_url('uploads/' . $cliente['imagen_perfil']) ?>" alt="Imagen de perfil" width="50">
                                    <?php else: ?>
                                        Sin imagen
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Botón de Editar -->
                                    <a href="<?= base_url('/clientes/editar/' . $cliente['id_usuario']) ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <!-- Botón de Eliminar -->
                                    <a href="<?= base_url('/clientes/eliminar/' . $cliente['id_usuario']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
                                        <i class="bi bi-trash"></i> Eliminar
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