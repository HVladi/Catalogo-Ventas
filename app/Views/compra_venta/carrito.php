<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras - Tacos el Vladiz</title>
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

        .btn-eliminar {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
        }

        .btn-eliminar:hover {
            background-color: #c82333;
        }

        .btn-comprar {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
        }

        .btn-comprar:hover {
            background-color: #218838;
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
                <h2 class="mb-4">Carrito de Compras</h2>

                <!-- Mostrar productos en el carrito -->
<!-- Mostrar productos en el carrito -->
<div class="row">
    <?php if (!empty($carrito)): ?>
        <?php foreach ($carrito as $item): ?>
            <div class="col-md-4 col-sm-12 mb-4">
                <div class="card">
                    <img src="<?= base_url('uploads/' . $item['imagen']) ?>" class="card-img-top" alt="<?= $item['nombre_producto'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= $item['nombre_producto'] ?></h5>
                        <p class="card-text"><strong>Precio:</strong> $<?= number_format($item['precio'], 2) ?></p>
                        <p class="card-text"><strong>Cantidad:</strong> <?= $item['cantidad'] ?></p>
                        <button class="btn btn-eliminar" onclick="eliminarDelCarrito(<?= $item['id_producto'] ?>)">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-12">
            <div class="alert alert-info">No hay productos en el carrito.</div>
        </div>
    <?php endif; ?>
</div>

<!-- Total y botón de comprar -->
<?php if (!empty($carrito)): ?>
    <div class="text-end mt-4">
        <h4>Total: $<?= number_format($total, 2) ?></h4>
        <button class="btn btn-comprar" onclick="realizarCompra()">
            <i class="bi bi-cart-check"></i> Realizar Compra
        </button>
    </div>
<?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Scripts para manejar el carrito -->
    <script>
        function eliminarDelCarrito(idProducto) {
    fetch('<?= base_url('carrito/eliminar') ?>', {
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
            alert('✅ Producto eliminado y stock restaurado');
            location.reload(); // Recargar la página para actualizar el carrito
        } else {
            alert('❌ Error al eliminar el producto del carrito');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


function realizarCompra() {
    fetch('<?= base_url('carrito/comprar') ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('✅ Compra realizada con éxito');
            location.reload(); // Recargar la página para vaciar el carrito
        } else {
            alert('❌ Error al realizar la compra');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
    </script>
</body>
</html>