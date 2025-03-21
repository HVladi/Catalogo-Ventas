<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class ConfiguracionUsuarioController extends Controller
{
    public function index()
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Obtener el ID del usuario
        $idUsuario = $session->get('id_usuario');

        // Cargar el modelo de usuarios
        $usuarioModel = new UsuarioModel();

        // Obtener los datos del usuario
        $usuario = $usuarioModel->find($idUsuario);

        // Mostrar la vista de configuración con los datos del usuario
        return view('configuracion_usuario/index', [
            'usuario' => $usuario
        ]);
    }

    public function actualizar()
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Obtener el ID del usuario
        $idUsuario = $session->get('id_usuario');

        // Cargar el modelo de usuarios
        $usuarioModel = new UsuarioModel();

        // Validar los datos del formulario
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre_usuario' => 'required|min_length[3]|max_length[50]',
            'email' => 'required|valid_email|max_length[100]',
            'contrasena' => 'permit_empty|min_length[8]',
            'imagen_perfil' => 'uploaded[imagen_perfil]|max_size[imagen_perfil,1024]|is_image[imagen_perfil]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Obtener los datos del formulario
        $nombreUsuario = $this->request->getPost('nombre_usuario');
        $email = $this->request->getPost('email');
        $contrasena = $this->request->getPost('contrasena');
        $imagenPerfil = $this->request->getFile('imagen_perfil');

        // Preparar los datos para actualizar
        $data = [
            'nombre_usuario' => $nombreUsuario,
            'email' => $email
        ];

        // Actualizar la contraseña si se proporciona
        if (!empty($contrasena)) {
            $data['contrasena'] = password_hash($contrasena, PASSWORD_DEFAULT);
        }

        // Subir la imagen de perfil si se proporciona
        if ($imagenPerfil->isValid() && !$imagenPerfil->hasMoved()) {
            $newName = $imagenPerfil->getRandomName();
            $imagenPerfil->move(ROOTPATH . 'public/uploads/perfiles', $newName);
            $data['imagen_perfil'] = 'uploads/perfiles/' . $newName;
        }

        // Actualizar los datos del usuario
        $usuarioModel->update($idUsuario, $data);

        // Redirigir con un mensaje de éxito
        return redirect()->to(base_url('/configuracion_usuario'))->with('success', 'Datos actualizados correctamente');
    }
}