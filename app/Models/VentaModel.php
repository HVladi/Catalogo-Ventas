<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    protected $allowedFields = ['id_producto', 'id_usuario', 'cantidad', 'fecha_compra'];

    // Obtener las ventas con información de productos y usuarios
    public function obtenerVentasConDetalles()
    {
        return $this->db->table('ventas v')
            ->select('v.id_venta, p.nombre_producto, p.categoria, p.precio, p.marca, p.imagen, u.nombre_usuario, v.cantidad, v.fecha_compra')
            ->join('productos p', 'p.id_producto = v.id_producto')
            ->join('usuarios u', 'u.id_usuario = v.id_usuario')
            ->get()
            ->getResultArray();
    }
}