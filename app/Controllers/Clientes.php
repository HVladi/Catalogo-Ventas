<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuarioModel;

class Clientes extends Controller
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

        // Obtener solo los usuarios con rol "usuario" (clientes)
        $clientes = $usuarioModel->where('rol', 'usuario')->findAll();

        // Mostrar la vista con los clientes
        return view('clientes/index', [
            'clientes' => $clientes,
        ]);
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

        // Obtener el cliente por ID
        $cliente = $usuarioModel->find($id);

        if (!$cliente || $cliente['rol'] !== 'usuario') {
            return redirect()->to(base_url('/clientes'))->with('error', 'Cliente no encontrado.');
        }

        // Mostrar la vista de edición con los datos del cliente
        return view('clientes/editar', ['cliente' => $cliente]);
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
    $imagen_perfil = $this->request->getFile('imagen_perfil');

    // Cargar el modelo de usuarios
    $usuarioModel = new UsuarioModel();

    // Preparar los datos para actualizar
    $data = [
        'nombre_usuario' => $nombre_usuario,
        'email' => $email,
    ];

    // Actualizar la contraseña solo si se proporcionó una nueva
    if (!empty($contrasena)) {
        $data['contrasena'] = password_hash($contrasena, PASSWORD_DEFAULT);
    }

    // Si se subió una nueva imagen, actualizarla
    if ($imagen_perfil->isValid() && !$imagen_perfil->hasMoved()) {
        // Eliminar la imagen anterior si existe
        $cliente = $usuarioModel->find($id);
        if ($cliente['imagen_perfil'] && file_exists(ROOTPATH . 'public/uploads/' . $cliente['imagen_perfil'])) {
            unlink(ROOTPATH . 'public/uploads/' . $cliente['imagen_perfil']);
        }

        // Mover la nueva imagen a la carpeta de uploads
        $nombreImagen = $imagen_perfil->getRandomName();
        $imagen_perfil->move(ROOTPATH . 'public/uploads', $nombreImagen);
        $data['imagen_perfil'] = $nombreImagen;
    }

    // Actualizar el cliente
    $usuarioModel->update($id, $data);

    // Redirigir con un mensaje de éxito
    return redirect()->to(base_url('/clientes'))->with('success', 'Cliente actualizado exitosamente.');
}

    public function eliminar($id)
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Cargar el modelo de usuarios
        $usuarioModel = new UsuarioModel();

        // Verificar que el usuario a eliminar sea un cliente (rol "usuario")
        $cliente = $usuarioModel->find($id);
        if (!$cliente || $cliente['rol'] !== 'usuario') {
            return redirect()->to(base_url('/clientes'))->with('error', 'Cliente no encontrado.');
        }

        // Eliminar el cliente
        $usuarioModel->delete($id);

        // Redirigir con un mensaje de éxito
        return redirect()->to(base_url('/clientes'))->with('success', 'Cliente eliminado exitosamente.');
    }
}