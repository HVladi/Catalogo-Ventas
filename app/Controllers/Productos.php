<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductoModel;

class Productos extends Controller
{
    public function index()
{
    $session = session();

    // Verificar si el usuario está logueado
    if (!$session->get('isLoggedIn')) {
        return redirect()->to(base_url('/login'));
    }

    // Cargar los modelos
    $productoModel = new ProductoModel();
    $categoriaModel = new \App\Models\CategoriaModel();

    // Obtener todos los productos y categorías
    $productos = $productoModel->findAll();
    $categorias = $categoriaModel->findAll();

    // Mostrar la vista con los productos y categorías
    return view('productos/index', [
        'productos' => $productos,
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
        'categoria' => 'required|max_length[100]',
        'nombre_producto' => 'required|max_length[100]',
        'precio' => 'required|decimal',
        'marca' => 'required|max_length[100]',
        'existencia' => 'required|integer',
        'imagen' => 'uploaded[imagen]|max_size[imagen,1024]|is_image[imagen]',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        // Si la validación falla, regresar con errores
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Obtener los datos del formulario
    $id_usuario = $session->get('id_usuario'); // ID del usuario logueado
    $categoria = $this->request->getPost('categoria');
    $nombre_producto = $this->request->getPost('nombre_producto');
    $precio = $this->request->getPost('precio');
    $marca = $this->request->getPost('marca');
    $existencia = $this->request->getPost('existencia');
    $imagen = $this->request->getFile('imagen');

    // Mover la imagen a la carpeta de uploads
    $nombreImagen = $imagen->getRandomName();
    $imagen->move(ROOTPATH . 'public/uploads', $nombreImagen);

    // Cargar el modelo de productos
    $productoModel = new ProductoModel();

    // Insertar el nuevo producto
    $productoModel->insert([
        'id_usuario' => $id_usuario,
        'categoria' => $categoria,
        'nombre_producto' => $nombre_producto,
        'precio' => $precio,
        'marca' => $marca,
        'existencia' => $existencia,
        'imagen' => $nombreImagen,
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->to(base_url('/productos'))->with('success', 'Producto creado exitosamente.');
}

public function editar($id)
{
    $session = session();

    // Verificar si el usuario está logueado
    if (!$session->get('isLoggedIn')) {
        return redirect()->to(base_url('/login'));
    }

    // Cargar los modelos
    $productoModel = new ProductoModel();
    $categoriaModel = new \App\Models\CategoriaModel();

    // Obtener el producto por ID
    $producto = $productoModel->find($id);

    if (!$producto) {
        return redirect()->to(base_url('/productos'))->with('error', 'Producto no encontrado.');
    }

    // Obtener todas las categorías
    $categorias = $categoriaModel->findAll();

    // Mostrar la vista de edición con los datos del producto y las categorías
    return view('productos/editar', [
        'producto' => $producto,
        'categorias' => $categorias,
    ]);
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
        'categoria' => 'required|max_length[100]',
        'nombre_producto' => 'required|max_length[100]',
        'precio' => 'required|decimal',
        'marca' => 'required|max_length[100]',
        'imagen' => 'max_size[imagen,1024]|is_image[imagen]', // La imagen es opcional
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        // Si la validación falla, regresar con errores
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Obtener los datos del formulario
    $categoria = $this->request->getPost('categoria');
    $nombre_producto = $this->request->getPost('nombre_producto');
    $precio = $this->request->getPost('precio');
    $marca = $this->request->getPost('marca');
    $imagen = $this->request->getFile('imagen');

    // Cargar el modelo de productos
    $productoModel = new ProductoModel();

    // Preparar los datos para actualizar
    $data = [
        'categoria' => $categoria,
        'nombre_producto' => $nombre_producto,
        'precio' => $precio,
        'marca' => $marca,
    ];

    // Si se subió una nueva imagen, actualizarla
    if ($imagen->isValid() && !$imagen->hasMoved()) {
        // Eliminar la imagen anterior si existe
        $producto = $productoModel->find($id);
        if ($producto['imagen'] && file_exists(ROOTPATH . 'public/uploads/' . $producto['imagen'])) {
            unlink(ROOTPATH . 'public/uploads/' . $producto['imagen']);
        }

        // Mover la nueva imagen a la carpeta de uploads
        $nombreImagen = $imagen->getRandomName();
        $imagen->move(ROOTPATH . 'public/uploads', $nombreImagen);
        $data['imagen'] = $nombreImagen;
    }

    // Actualizar el producto
    $productoModel->update($id, $data);

    // Redirigir con un mensaje de éxito
    return redirect()->to(base_url('/productos'))->with('success', 'Producto actualizado exitosamente.');
}

public function eliminar($id)
{
    $session = session();

    // Verificar si el usuario está logueado
    if (!$session->get('isLoggedIn')) {
        return redirect()->to(base_url('/login'));
    }

    // Cargar el modelo de productos
    $productoModel = new ProductoModel();

    // Obtener el producto para eliminar la imagen asociada
    $producto = $productoModel->find($id);
    if ($producto['imagen'] && file_exists(ROOTPATH . 'public/uploads/' . $producto['imagen'])) {
        unlink(ROOTPATH . 'public/uploads/' . $producto['imagen']);
    }

    // Eliminar el producto
    $productoModel->delete($id);

    // Redirigir con un mensaje de éxito
    return redirect()->to(base_url('/productos'))->with('success', 'Producto eliminado exitosamente.');
}
}