<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Tacos el Vladiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ff7f50, #ff4500, #8b0000);
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #ff4500;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn-primary {
            width: 100%;
            background-color: #ff4500;
            border: none;
        }
        .btn-primary:hover {
            background-color: #8b0000;
        }
        .input-group-text {
            background-color: #f1f1f1;
        }
        .alert {
            margin-bottom: 15px;
        }
        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
        .footer-text a {
            color: #ff4500;
            text-decoration: none;
        }
        .footer-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-container p-4 shadow-lg rounded-4">
            <h2>🌮 Iniciar Sesión - Tacos el Vladiz</h2>

            <!-- Mensaje de error si existe -->
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger text-center">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- Formulario de inicio de sesión -->
            <form action="<?= base_url('login/auth') ?>" method="post">
                <div class="mb-4">
                    <label for="email" class="form-label">📧 Correo Electrónico</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="contrasena" class="form-label">🔐 Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="Contraseña" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password" data-target="contrasena">
                            <i class="bi bi-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <!-- Script para mostrar/ocultar contraseña -->
                <script>
                    document.querySelectorAll('.toggle-password').forEach(button => {
                        button.addEventListener('click', function() {
                            let input = document.getElementById(this.dataset.target);
                            let icon = this.querySelector('i');
                            if (input.type === "password") {
                                input.type = "text"; 
                                icon.classList.replace('bi-eye-slash', 'bi-eye');
                            } else {
                                input.type = "password"; 
                                icon.classList.replace('bi-eye', 'bi-eye-slash');
                            }
                        });
                    });
                </script>

                <button type="submit" class="btn btn-primary w-100 mt-3">Ingresar</button>
            </form>

            <div class="footer-text">
                ¿No tienes una cuenta? <a href="<?= base_url('registro') ?>">Regístrate aquí</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>