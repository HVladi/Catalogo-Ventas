<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CategoriaModel;

class Categorias extends Controller
{
    public function index()
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Cargar el modelo de categorías
        $categoriaModel = new CategoriaModel();

        // Obtener todas las categorías
        $categorias = $categoriaModel->findAll();

        // Mostrar la vista con las categorías y un formulario para agregar nuevas
        return view('categorias/index', [
            'categorias' => $categorias,
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
            'nombre_categoria' => 'required|max_length[100]|is_unique[categorias.nombre_categoria]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Si la validación falla, regresar con errores
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Obtener los datos del formulario
        $nombre_categoria = $this->request->getPost('nombre_categoria');

        // Cargar el modelo de categorías
        $categoriaModel = new CategoriaModel();

        // Insertar la nueva categoría
        $categoriaModel->insert([
            'nombre_categoria' => $nombre_categoria,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->to(base_url('/categorias'))->with('success', 'Categoría creada exitosamente.');
    }

    public function editar($id)
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Cargar el modelo de categorías
        $categoriaModel = new CategoriaModel();

        // Obtener la categoría por ID
        $categoria = $categoriaModel->find($id);

        if (!$categoria) {
            return redirect()->to(base_url('/categorias'))->with('error', 'Categoría no encontrada.');
        }

        // Mostrar la vista de edición con los datos de la categoría
        return view('categorias/editar', ['categoria' => $categoria]);
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
            'nombre_categoria' => "required|max_length[100]|is_unique[categorias.nombre_categoria,id_categoria,{$id}]",
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Si la validación falla, regresar con errores
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Obtener los datos del formulario
        $nombre_categoria = $this->request->getPost('nombre_categoria');

        // Cargar el modelo de categorías
        $categoriaModel = new CategoriaModel();

        // Actualizar la categoría
        $categoriaModel->update($id, [
            'nombre_categoria' => $nombre_categoria,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->to(base_url('/categorias'))->with('success', 'Categoría actualizada exitosamente.');
    }

    public function eliminar($id)
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Cargar el modelo de categorías
        $categoriaModel = new CategoriaModel();

        // Eliminar la categoría
        $categoriaModel->delete($id);

        // Redirigir con un mensaje de éxito
        return redirect()->to(base_url('/categorias'))->with('success', 'Categoría eliminada exitosamente.');
    }
}