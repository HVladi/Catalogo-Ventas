<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function auth()
    {
        $session = session();
        $usuarioModel = new UsuarioModel();

        // Obtener el correo y la contraseña del formulario
        $email = $this->request->getVar('email');
        $contrasena = $this->request->getVar('contrasena');

        // Buscar usuario en la base de datos por correo electrónico
        $usuario = $usuarioModel->where('email', $email)->first();

        if ($usuario) {
            // Verificar si el usuario tiene un rol válido ('admin' o 'usuario')
            if (!in_array($usuario['rol'], ['admin', 'usuario'])) {
                // Usuario no tiene un rol válido, no puede iniciar sesión
                $session->setFlashdata('error', 'Rol de usuario no válido');
                return redirect()->to(base_url('/login'));
            }

            // Verificar contraseña con password_verify()
            if (password_verify($contrasena, $usuario['contrasena'])) {
                // Crear datos de sesión
                $sesionData = [
                    'id_usuario'     => $usuario['id_usuario'],
                    'nombre_usuario' => $usuario['nombre_usuario'],
                    'email'          => $usuario['email'],
                    'rol'            => $usuario['rol'],
                    'isLoggedIn'     => true,
                ];
                $session->set($sesionData);

                // Redirigir según el rol
                if ($usuario['rol'] === 'admin') {
                    return redirect()->to(base_url('/dashboard')); // Redirigir al dashboard de admin
                } else {
                    return redirect()->to(base_url('/compra_venta')); // Redirigir a la página de compra/venta para usuarios
                }
            } else {
                // Contraseña incorrecta
                $session->setFlashdata('error', 'Contraseña incorrecta');
                return redirect()->to(base_url('/login'));
            }
        } else {
            // Usuario no encontrado
            $session->setFlashdata('error', 'Correo electrónico no registrado');
            return redirect()->to(base_url('/login'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/login'));
    }
}