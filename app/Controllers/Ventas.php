<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\VentaModel;

class Ventas extends Controller
{
    public function index()
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Cargar el modelo de ventas
        $ventaModel = new VentaModel();

        // Obtener las ventas con detalles de productos y usuarios
        $ventas = $ventaModel->obtenerVentasConDetalles();

        // Mostrar la vista con las ventas
        return view('ventas/index', [
            'ventas' => $ventas,
        ]);
    }
}