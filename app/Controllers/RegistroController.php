<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\Controller;

class RegistroController extends Controller
{
    public function index()
    {
        return view('registro');
    }

    public function registrar()
    {
        $session = session();
        $usuarioModel = new UsuarioModel();

        // Validar los datos del formulario
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre_usuario' => 'required|min_length[3]|max_length[50]|is_unique[usuarios.nombre_usuario]',
            'email' => 'required|valid_email|max_length[100]|is_unique[usuarios.email]',
            'contrasena' => 'required|min_length[8]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Obtener los datos del formulario
        $nombreUsuario = $this->request->getPost('nombre_usuario');
        $email = $this->request->getPost('email');
        $contrasena = $this->request->getPost('contrasena');

        // Crear un nuevo usuario
        $usuarioModel->insert([
            'nombre_usuario' => $nombreUsuario,
            'email' => $email,
            'contrasena' => password_hash($contrasena, PASSWORD_DEFAULT), // Asegúrate de usar password_hash()
            'rol' => 'usuario',
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->to(base_url('/login'))->with('success', 'Registro exitoso. Inicia sesión para continuar.');
    }
}