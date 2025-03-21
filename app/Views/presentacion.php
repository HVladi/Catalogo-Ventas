<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Ventas - Utensilios de Cocina</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .navbar {
            background-color: #28a745 !important;
        }

        .navbar-brand,
        .nav-link {
            color: #fff !important;
        }

        .hero-section {
            background: url('https://via.placeholder.com/1500x500/ffebcd/333?text=Utensilios+de+Cocina') no-repeat center center/cover;
            color: #fff;
            padding: 100px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: bold;
        }

        .product-section {
            padding: 50px 0;
        }

        .product-card {
            margin-bottom: 20px;
        }

        .product-card img {
            height: 200px;
            object-fit: cover;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .btn-primary {
            background-color: #28a745;
            border: none;
        }

        .btn-primary:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Catálogo de Utensilios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#productos">Nuestros Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#comprar">Comprar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#login">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#registro">Registrarse</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1>Bienvenidos al Catálogo de Utensilios de Cocina</h1>
            <p class="lead">Encuentra los mejores utensilios para hacer de tu cocina un lugar más práctico y eficiente.</p>
            <a href="#productos" class="btn btn-primary btn-lg">Ver Productos</a>
        </div>
    </section>

    <!-- Nuestros Productos -->
    <section id="productos" class="product-section">
        <div class="container">
            <h2 class="text-center mb-5">Nuestros Productos</h2>
            <div class="row">
                <!-- Producto 1 -->
                <div class="col-md-4">
                    <div class="card product-card">
                        <img src="https://via.placeholder.com/300x200/ff7f50/333?text=Sarten+Antiadherente" class="card-img-top"
                            alt="Sartén Antiadherente">
                        <div class="card-body">
                            <h5 class="card-title">Sartén Antiadherente</h5>
                            <p class="card-text">Ideal para cocinar sin que los alimentos se peguen.</p>
                            <a href="<?= base_url('/login') ?>" class="btn btn-primary">Comprar</a>
                        </div>
                    </div>
                </div>
                <!-- Producto 2 -->
                <div class="col-md-4">
                    <div class="card product-card">
                        <img src="https://via.placeholder.com/300x200/ffa07a/333?text=Batería+de+Cocina" class="card-img-top"
                            alt="Batería de Cocina">
                        <div class="card-body">
                            <h5 class="card-title">Batería de Cocina</h5>
                            <p class="card-text">Conjunto completo para cocinar cualquier platillo.</p>
                            <a href="<?= base_url('/login') ?>" class="btn btn-primary">Comprar</a>
                        </div>
                    </div>
                </div>
                <!-- Producto 3 -->
                <div class="col-md-4">
                    <div class="card product-card">
                        <img src="https://via.placeholder.com/300x200/20b2aa/333?text=Cuchillos+de+Cocina" class="card-img-top"
                            alt="Cuchillos de Cocina">
                        <div class="card-body">
                            <h5 class="card-title">Cuchillos Profesionales</h5>
                            <p class="card-text">Juego de cuchillos de alta precisión para cortes perfectos.</p>
                            <a href="<?= base_url('/login') ?>" class="btn btn-primary">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 Catálogo de Utensilios. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
