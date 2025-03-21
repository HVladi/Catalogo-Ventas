<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar (copiado del index) -->
        
        <!-- Contenido principal -->
        <div class="main-content">
            <div class="container-fluid">
                <h2 class="mb-4">Editar Categoría</h2>

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
                <form action="<?= base_url('/categorias/actualizar/' . $categoria['id_categoria']) ?>" method="post">
                    <div class="mb-3">
                        <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
                        <input type="text" name="nombre_categoria" class="form-control" value="<?= $categoria['nombre_categoria'] ?>" required>
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