<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CarritoModel;
use App\Models\ProductoModel;
use App\Models\VentaModel;

class CarritoController extends Controller
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
    $carritoModel = new CarritoModel();
    $productoModel = new ProductoModel();
    $usuarioModel = new \App\Models\UsuarioModel(); // Asegúrate de importar el modelo de usuarios

    // Obtener los productos en el carrito del usuario
    $carrito = $carritoModel->where('id_usuario', $idUsuario)->findAll();

    // Obtener detalles de los productos
    $productosEnCarrito = [];
    $total = 0;
    foreach ($carrito as $item) {
        $producto = $productoModel->find($item['id_producto']);
        if ($producto) {
            $producto['cantidad'] = $item['cantidad'];
            $producto['id_carrito'] = $item['id_carrito'];
            $productosEnCarrito[] = $producto;
            $total += $producto['precio'] * $item['cantidad'];
        }
    }

    // Obtener los datos del usuario
    $usuario = $usuarioModel->find($idUsuario);

    // Mostrar la vista del carrito con los productos y datos del usuario
    return view('compra_venta/carrito', [
        'carrito' => $productosEnCarrito,
        'total' => $total,
        'usuario' => $usuario // Pasar los datos del usuario a la vista
    ]);
}

    public function eliminar()
{
    $session = session();

    // Verificar si el usuario está logueado
    if (!$session->get('isLoggedIn')) {
        return redirect()->to(base_url('/login'));
    }

    // Obtener el ID del carrito desde la solicitud
    $idCarrito = $this->request->getJSON()->id_producto;

    // Cargar los modelos
    $carritoModel = new CarritoModel();
    $productoModel = new ProductoModel();

    // Obtener detalles del producto del carrito antes de eliminar
    $item = $carritoModel->where('id_usuario', $session->get('id_usuario'))
                         ->where('id_producto', $idCarrito)
                         ->first();

    if ($item) {
        // Obtener el producto para actualizar la existencia
        $producto = $productoModel->find($item['id_producto']);

        if ($producto) {
            // Restaurar la cantidad eliminada al stock
            $nuevaExistencia = $producto['existencia'] + $item['cantidad'];

            // Actualizar la existencia del producto
            $productoModel->update($item['id_producto'], [
                'existencia' => $nuevaExistencia
            ]);

            // Eliminar el producto del carrito
            $carritoModel->delete($item['id_carrito']);

            // Devolver éxito
            return $this->response->setJSON(['success' => true, 'message' => 'Producto eliminado y stock restaurado']);
        }
    }

    // En caso de error
    return $this->response->setJSON(['success' => false, 'message' => 'No se pudo eliminar el producto']);
}


    public function agregar()
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Obtener el ID del usuario y el ID del producto desde la solicitud
        $idUsuario = $session->get('id_usuario');
        $idProducto = $this->request->getJSON()->id_producto;

        // Cargar los modelos
        $carritoModel = new CarritoModel();
        $productoModel = new ProductoModel();

        // Verificar si el producto existe y tiene existencia disponible
        $producto = $productoModel->find($idProducto);
        if (!$producto || $producto['existencia'] <= 0) {
            return $this->response->setJSON(['success' => false, 'message' => 'Producto no disponible']);
        }

        // Verificar si el producto ya está en el carrito
        $existe = $carritoModel->where('id_usuario', $idUsuario)
                               ->where('id_producto', $idProducto)
                               ->first();

        if ($existe) {
            // Si el producto ya está en el carrito, aumentar la cantidad
            $carritoModel->update($existe['id_carrito'], [
                'cantidad' => $existe['cantidad'] + 1
            ]);
        } else {
            // Si el producto no está en el carrito, agregarlo
            $carritoModel->insert([
                'id_usuario' => $idUsuario,
                'id_producto' => $idProducto,
                'cantidad' => 1
            ]);
        }

        // Disminuir la existencia del producto en la tabla `productos`
        $productoModel->update($idProducto, [
            'existencia' => $producto['existencia'] - 1
        ]);

        // Devolver una respuesta JSON
        return $this->response->setJSON(['success' => true, 'message' => 'Producto agregado al carrito']);
    }

    public function comprar()
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Obtener el ID del usuario
        $idUsuario = $session->get('id_usuario');

        // Cargar los modelos
        $carritoModel = new CarritoModel();
        $ventaModel = new VentaModel();

        // Obtener los productos en el carrito del usuario
        $carrito = $carritoModel->where('id_usuario', $idUsuario)->findAll();

        // Registrar cada producto en la tabla `ventas`
        foreach ($carrito as $item) {
            $ventaModel->insert([
                'id_producto' => $item['id_producto'],
                'id_usuario' => $idUsuario,
                'cantidad' => $item['cantidad']
            ]);
        }

        // Vaciar el carrito después de la compra
        $carritoModel->where('id_usuario', $idUsuario)->delete();

        // Devolver una respuesta JSON
        return $this->response->setJSON(['success' => true, 'message' => 'Compra realizada con éxito']);
    }
}