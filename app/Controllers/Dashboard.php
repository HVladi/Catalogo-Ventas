<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class Dashboard extends Controller
{
    public function index()
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Obtener los datos del usuario logueado
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->find($session->get('id_usuario'));

        // Cargar la vista del dashboard con los datos del usuario
        return view('dashboard', ['usuario' => $usuario]);
    }
}