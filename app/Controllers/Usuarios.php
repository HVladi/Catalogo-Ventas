<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class Usuarios extends Controller
{
    public function index()
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Cargar el modelo de usuarios
        $usuarioModel = new UsuarioModel();

        // Obtener todos los usuarios
        $usuarios = $usuarioModel->findAll();

        // Mostrar la vista con los usuarios y un formulario para agregar nuevos
        return view('usuarios/index', [
            'mensaje' => 'Hola',
            'usuarios' => $usuarios,
        ]);
    }

    public function crear()
{
    $session = session();

    // Verificar si el usuario está logueado
    if (!$session->get('isLoggedIn')) {
        return redirect()->to(base_url('/login'));
    }

    // Validar los datos del formulario
    $validation = \Config\Services::validation();
    $validation->setRules([
        'nombre_usuario' => 'required|min_length[3]|max_length[50]|is_unique[usuarios.nombre_usuario]',
        'email' => 'required|valid_email|max_length[100]|is_unique[usuarios.email]',
        'contrasena' => 'required|min_length[8]',
        'confirmar_contrasena' => 'required|matches[contrasena]',
        'rol' => 'required|in_list[admin,usuario]',
        'imagen_perfil' => 'uploaded[imagen_perfil]|max_size[imagen_perfil,1024]|is_image[imagen_perfil]',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        // Si la validación falla, regresar con errores
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Obtener los datos del formulario
    $nombre_usuario = $this->request->getPost('nombre_usuario');
    $email = $this->request->getPost('email');
    $contrasena = $this->request->getPost('contrasena');
    $rol = $this->request->getPost('rol');
    $imagen_perfil = $this->request->getFile('imagen_perfil');

    // Mover la imagen a la carpeta de uploads
    $nombreImagen = $imagen_perfil->getRandomName();
    $imagen_perfil->move(ROOTPATH . 'public/uploads', $nombreImagen);

    // Cargar el modelo de usuarios
    $usuarioModel = new UsuarioModel();

    // Insertar el nuevo usuario
    $usuarioModel->insert([
        'nombre_usuario' => $nombre_usuario,
        'email' => $email,
        'contrasena' => $contrasena,
        'rol' => $rol,
        'imagen_perfil' => $nombreImagen,
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->to(base_url('/usuarios'))->with('success', 'Usuario creado exitosamente.');
}

    public function editar($id)
{
    $session = session();

    // Verificar si el usuario está logueado
    if (!$session->get('isLoggedIn')) {
        return redirect()->to(base_url('/login'));
    }

    // Cargar el modelo de usuarios
    $usuarioModel = new UsuarioModel();

    // Obtener el usuario por ID
    $usuario = $usuarioModel->find($id);

    if (!$usuario) {
        return redirect()->to(base_url('/usuarios'))->with('error', 'Usuario no encontrado.');
    }

    // Mostrar la vista de edición con los datos del usuario
    return view('usuarios/editar', ['usuario' => $usuario]);
}

public function actualizar($id)
{
    $session = session();

    // Verificar si el usuario está logueado
    if (!$session->get('isLoggedIn')) {
        return redirect()->to(base_url('/login'));
    }

    // Validar los datos del formulario
    $validation = \Config\Services::validation();
    $validation->setRules([
        'nombre_usuario' => "required|min_length[3]|max_length[50]|is_unique[usuarios.nombre_usuario,id_usuario,{$id}]",
        'email' => "required|valid_email|max_length[100]|is_unique[usuarios.email,id_usuario,{$id}]",
        'contrasena' => 'permit_empty|min_length[8]', // La contraseña es opcional
        'confirmar_contrasena' => 'permit_empty|matches[contrasena]', // Validar que coincida con la contraseña
        'rol' => 'required|in_list[admin,usuario]',
        'imagen_perfil' => 'max_size[imagen_perfil,1024]|is_image[imagen_perfil]', // La imagen es opcional
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        // Si la validación falla, regresar con errores
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Obtener los datos del formulario
    $nombre_usuario = $this->request->getPost('nombre_usuario');
    $email = $this->request->getPost('email');
    $contrasena = $this->request->getPost('contrasena');
    $rol = $this->request->getPost('rol');
    $imagen_perfil = $this->request->getFile('imagen_perfil');

    // Cargar el modelo de usuarios
    $usuarioModel = new UsuarioModel();

    // Preparar los datos para actualizar
    $data = [
        'nombre_usuario' => $nombre_usuario,
        'email' => $email,
        'rol' => $rol,
    ];

    // Actualizar la contraseña solo si se proporcionó una nueva
    if (!empty($contrasena)) {
        $data['contrasena'] = password_hash($contrasena, PASSWORD_DEFAULT);
    }

    // Si se subió una nueva imagen, actualizarla
    if ($imagen_perfil->isValid() && !$imagen_perfil->hasMoved()) {
        // Eliminar la imagen anterior si existe
        $usuario = $usuarioModel->find($id);
        if ($usuario['imagen_perfil'] && file_exists(ROOTPATH . 'public/uploads/' . $usuario['imagen_perfil'])) {
            unlink(ROOTPATH . 'public/uploads/' . $usuario['imagen_perfil']);
        }

        // Mover la nueva imagen a la carpeta de uploads
        $nombreImagen = $imagen_perfil->getRandomName();
        $imagen_perfil->move(ROOTPATH . 'public/uploads', $nombreImagen);
        $data['imagen_perfil'] = $nombreImagen;
    }

    // Actualizar el usuario
    $usuarioModel->update($id, $data);

    // Redirigir con un mensaje de éxito
    return redirect()->to(base_url('/usuarios'))->with('success', 'Usuario actualizado exitosamente.');
}

public function borrar($id)
{
    $session = session();

    // Verificar si el usuario está logueado
    if (!$session->get('isLoggedIn')) {
        return redirect()->to(base_url('/login'));
    }

    // Cargar el modelo de usuarios
    $usuarioModel = new UsuarioModel();

    // Eliminar el usuario
    $usuarioModel->delete($id);

    // Redirigir con un mensaje de éxito
    return redirect()->to(base_url('/usuarios'))->with('success', 'Usuario eliminado exitosamente.');
}
}