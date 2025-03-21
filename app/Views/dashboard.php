<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
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

        /* Tarjetas */
        .card {
            border: none;
            border-radius: 12px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .card-title {
            font-weight: bold;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 15px 0;
            text-align: center;
            margin-top: 2rem;
        }

        .user-profile {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .user-profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .user-profile h2 {
            margin: 0;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4 class="text-center mb-4"><i class="bi bi-cart4"></i> Catálogo Admin</h4>
            <div class="user-profile">
                    <?php if ($usuario['imagen_perfil']): ?>
                        <img src="<?= base_url('uploads/' . $usuario['imagen_perfil']) ?>" alt="Foto de perfil">
                    <?php else: ?>
                        <img src="<?= base_url('uploads/default-profile.png') ?>" alt="Foto de perfil predeterminada">
                    <?php endif; ?>
                    <h2><?= $usuario['nombre_usuario'] ?> </h2>
                </div>
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
                <!-- Mostrar foto de perfil y nombre del usuario -->
                <div class="user-profile">
                    <?php if ($usuario['imagen_perfil']): ?>
                        <img src="<?= base_url('uploads/' . $usuario['imagen_perfil']) ?>" alt="Foto de perfil">
                    <?php else: ?>
                        <img src="<?= base_url('uploads/default-profile.png') ?>" alt="Foto de perfil predeterminada">
                    <?php endif; ?>
                    <h2>Bienvenido, <?= $usuario['nombre_usuario'] ?> (<?= $usuario['rol'] ?>)</h2>
                </div>

                <p class="lead">Administra tu catálogo de ventas de manera eficiente y profesional.</p>

                <!-- Tarjetas de opciones -->
                <div class="row mt-4">
                    <!-- Registro de Usuarios -->
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="card bg-light shadow-sm text-center p-4">
                            <i class="bi bi-person-plus text-primary"></i>
                            <h5 class="card-title">Usuarios</h5>
                            <p class="card-text">Gestiona cuentas de usuarios y administradores.</p>
                            <a href="<?= base_url('/usuarios') ?>" class="btn btn-primary"><i class="bi bi-eye"></i> Ver Usuarios</a>
                        </div>
                    </div>

                    <!-- Registrar Productos -->
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="card bg-light shadow-sm text-center p-4">
                            <i class="bi bi-box-seam text-success"></i>
                            <h5 class="card-title">Productos</h5>
                            <p class="card-text">Añade nuevos productos al catálogo.</p>
                            <a href="<?= base_url('/productos') ?>" class="btn btn-success"><i class="bi bi-eye"></i> Ver Productos</a>
                        </div>
                    </div>

                    <!-- Gestión de Clientes -->
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="card bg-light shadow-sm text-center p-4">
                            <i class="bi bi-people text-warning"></i>
                            <h5 class="card-title">Clientes</h5>
                            <p class="card-text">Administra la información de tus clientes.</p>
                            <a href="<?= base_url('/clientes') ?>" class="btn btn-warning"><i class="bi bi-eye"></i> Ver Clientes</a>
                        </div>
                    </div>

                    <!-- Categorías -->
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="card bg-light shadow-sm text-center p-4">
                            <i class="bi bi-tags text-danger"></i>
                            <h5 class="card-title">Categorías</h5>
                            <p class="card-text">Organiza tus productos por categorías.</p>
                            <a href="<?= base_url('/categorias') ?>" class="btn btn-danger"><i class="bi bi-eye"></i> Ver Categorías</a>
                        </div>
                    </div>

                    <!-- Ventas -->
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="card bg-light shadow-sm text-center p-4">
                            <i class="bi bi-cash-stack text-info"></i>
                            <h5 class="card-title">Ventas</h5>
                            <p class="card-text">Visualiza y gestiona las ventas.</p>
                            <a href="<?= base_url('/ventas') ?>" class="btn btn-info"><i class="bi bi-eye"></i> Ver Ventas</a>
                        </div>
                    </div>

                    <!-- Configuración -->
                    <div class="col-md-4 col-sm-12 mb-4">
                        <div class="card bg-light shadow-sm text-center p-4">
                            <i class="bi bi-gear text-secondary"></i>
                            <h5 class="card-title">Configuración</h5>
                            <p class="card-text">Ajusta las opciones del sistema.</p>
                            <a href="<?= base_url('/configuracion') ?>" class="btn btn-secondary"><i class="bi bi-eye"></i> Ver Configuración</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="container">
                    <p>&copy; 2025 Catálogo de Ventas. Todos los derechos reservados.</p>
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>