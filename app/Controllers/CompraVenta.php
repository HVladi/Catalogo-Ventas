<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ProductoModel;
use App\Models\CategoriaModel;

class CompraVenta extends Controller
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
    
        // Cargar los modelos
        $productoModel = new ProductoModel();
        $categoriaModel = new CategoriaModel();
        $usuarioModel = new \App\Models\UsuarioModel(); // Asegúrate de importar el modelo de usuarios
    
        // Obtener todos los productos y categorías
        $productos = $productoModel->findAll();
        $categorias = $categoriaModel->findAll();
    
        // Obtener estadísticas para el dashboard
        $totalProductos = $productoModel->countAll();
        $totalCategorias = $categoriaModel->countAll();
    
        // Obtener los datos del usuario
        $usuario = $usuarioModel->find($idUsuario);
    
        // Mostrar la vista de compra y venta con los productos, categorías y datos del usuario
        return view('compra_venta/index', [
            'productos' => $productos,
            'categorias' => $categorias,
            'totalProductos' => $totalProductos,
            'totalCategorias' => $totalCategorias,
            'usuario' => $usuario // Pasar los datos del usuario a la vista
        ]);
    }

    public function categoria($idCategoria)
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Cargar los modelos
        $productoModel = new ProductoModel();
        $categoriaModel = new CategoriaModel();

        // Obtener los productos de la categoría seleccionada
        $productos = $productoModel->where('categoria', $idCategoria)->findAll();
        $categorias = $categoriaModel->findAll();

        // Obtener estadísticas para el dashboard
        $totalProductos = $productoModel->countAll();
        $totalCategorias = $categoriaModel->countAll();

        // Mostrar la vista de compra y venta con los productos filtrados
        return view('compra_venta/index', [
            'productos' => $productos,
            'categorias' => $categorias,
            'totalProductos' => $totalProductos,
            'totalCategorias' => $totalCategorias,
        ]);
    }

    public function agregarAlCarrito()
{
    $session = session();
    $idUsuario = $session->get('id_usuario'); // ID del usuario logueado
    $request = service('request');

    // Obtener datos del POST
    $data = json_decode($request->getBody(), true);
    $idProducto = $data['id_producto'] ?? null;
    $cantidad = 1;

    if ($idProducto) {
        $productoModel = new ProductoModel();
        $carritoModel = new \App\Models\CarritoModel();

        // Obtener información del producto
        $producto = $productoModel->find($idProducto);

        if ($producto && $producto['existencia'] >= $cantidad) {
            // Agregar al carrito
            $carritoModel->agregarProducto($idUsuario, $idProducto, $cantidad);

            // Actualizar existencia del producto
            $nuevaExistencia = $producto['existencia'] - $cantidad;
            $productoModel->update($idProducto, ['existencia' => $nuevaExistencia]);

            return $this->response->setJSON(['success' => true, 'message' => 'Producto agregado al carrito']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Producto agotado']);
        }
    }

    return $this->response->setJSON(['success' => false, 'message' => 'Error al agregar al carrito']);
}

}