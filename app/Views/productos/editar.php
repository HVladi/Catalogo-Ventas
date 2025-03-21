<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar (copiado del index) -->

        <!-- Contenido principal -->
        <div class="main-content">
            <div class="container-fluid">
                <h2 class="mb-4">Editar Producto</h2>

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
                <form action="<?= base_url('/productos/actualizar/' . $producto['id_producto']) ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoría</label>
                        <select name="categoria" class="form-select" required>
                            <?php foreach ($categorias as $categoria): ?>
                                <option value="<?= $categoria['nombre_categoria'] ?>" <?= $categoria['nombre_categoria'] === $producto['categoria'] ? 'selected' : '' ?>>
                                    <?= $categoria['nombre_categoria'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_producto" class="form-label">Nombre del Producto</label>
                        <input type="text" name="nombre_producto" class="form-control" value="<?= $producto['nombre_producto'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" step="0.01" name="precio" class="form-control" value="<?= $producto['precio'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" name="marca" class="form-control" value="<?= $producto['marca'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="existencia" class="form-label">Existencia</label>
                        <input type="number" name="existencia" class="form-control" value="<?= $producto['existencia'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen (dejar en blanco para no cambiar)</label>
                        <input type="file" name="imagen" class="form-control">
                        <small class="text-muted">Formato: JPG, PNG, GIF. Tamaño máximo: 1MB.</small>
                        <?php if ($producto['imagen']): ?>
                            <img src="<?= base_url('uploads/' . $producto['imagen']) ?>" alt="Imagen del producto" width="100" class="mt-2">
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