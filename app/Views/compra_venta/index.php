<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra y Venta - Tacos el Vladiz</title>
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

        /* Sidebar */
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

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            width: 100%;
        }

        /* Dashboard - Top Bar */
        .top-bar {
            background: linear-gradient(to right, #00b4d8, #0077b6);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar h5 {
            margin: 0;
            font-size: 1.25rem;
        }

        .top-bar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .top-bar a:hover {
            text-decoration: underline;
        }

        /* Cards */
        .card {
            border: 1px solid #ddd;
            border-radius: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
        }

        .card img {
            border-radius: 12px 12px 0 0;
            max-height: 200px;
            object-fit: cover;
            transition: transform 0.3s;
        }

        .card img:hover {
            transform: scale(1.1);
        }

        .card-body {
            padding: 1.5rem;
            text-align: center;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .card-text {
            color: #555;
        }

        .btn-comprar {
            background-color: #ff9900;
            color: #fff;
            border: none;
            width: 100%;
            padding: 10px;
            font-size: 1rem;
        }

        .btn-comprar:hover {
            background-color: #e67e22;
        }

        /* Category Filter */
        .category-filter {
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .category-filter a {
            margin-right: 10px;
            text-decoration: none;
            color: #023e8a;
            font-weight: bold;
            padding: 5px 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .category-filter a:hover {
            background-color: #00b4d8;
            color: white;
        }
        .agotado {
            position: relative;
        }

        .agotado::after {
            content: "X";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 4rem;
            color: red;
            font-weight: bold;
            opacity: 0.8;
            pointer-events: none; /* Evita que la "X" interfiera con los clics */
        }

        .agotado img {
            opacity: 0.5; /* Hace que la imagen se vea más tenue */
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
            <!-- Top Bar -->
            <div class="top-bar">
                <h5>Bienvenido a Catlogo de Ventas</h5>
                <a href="<?= base_url('/carrito')?>"><i class="bi bi-cart"></i> Carrito</a>
                <a href="<?= base_url('/configuracion') ?>"><i class="bi bi-gear"></i> Configuración</a>
            </div>

            <div class="container-fluid">
                <!-- Filtros de categorías dinámicos -->
                <div class="category-filter">
                    <a href="<?= base_url('/compra_venta') ?>">Todos</a>
                    <?php foreach ($categorias as $categoria): ?>
                        <a href="<?= base_url('/categoria/' . $categoria['id_categoria']) ?>">
                            <?= $categoria['nombre_categoria'] ?>
                        </a>
                    <?php endforeach; ?>
                </div>

                <h2 class="mb-4">Productos Disponibles</h2>

                <!-- Mostrar productos -->
                <div class="row">
                    <?php if (!empty($productos)) : ?>
                        <?php foreach ($productos as $producto): ?>
                        <div class="col-md-4 col-sm-12 mb-4">
                            <div class="card">
                                <div class="position-relative <?= $producto['existencia'] <= 0 ? 'agotado' : '' ?>">
                                    <img src="<?= base_url('uploads/' . $producto['imagen']) ?>" class="card-img-top"
                                        alt="<?= $producto['nombre_producto'] ?>">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $producto['nombre_producto'] ?></h5>
                                    <p class="card-text"><?= $producto['descripcion'] ?? 'Sin descripción' ?></p>
                                    <p class="card-text"><strong>Precio:</strong> $<?= number_format($producto['precio'], 2) ?></p>
                                    <p class="card-text"><strong>Existencia:</strong> <?= $producto['existencia'] ?></p>
                                    <?php if ($producto['existencia'] > 0): ?>
                                        <button class="btn btn-comprar" onclick="agregarAlCarrito(<?= $producto['id_producto'] ?>)">
                                            <i class="bi bi-cart-plus"></i> Agregar al carrito
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-comprar" disabled>
                                            <i class="bi bi-cart-plus"></i> Agotado
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="text-center">No hay productos disponibles en esta categoría.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script para agregar productos al carrito -->
    <script>
    function agregarAlCarrito(idProducto) {
        fetch('<?= base_url('carrito/agregar') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id_producto: idProducto
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('✅ Producto agregado al carrito con éxito');
            } else {
                alert('❌ ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

</body>

</html>
