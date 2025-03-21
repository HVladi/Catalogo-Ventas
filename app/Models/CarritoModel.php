<?php

namespace App\Models;

use CodeIgniter\Model;

class CarritoModel extends Model
{
    protected $table      = 'carrito';
    protected $primaryKey = 'id_carrito';

    protected $allowedFields = [
        'id_usuario',
        'id_producto',
        'cantidad',
        'created_at'
    ];

    public function agregarProducto($idUsuario, $idProducto, $cantidad)
    {
        // Verificar si el producto ya está en el carrito
        $item = $this->where('id_usuario', $idUsuario)
                     ->where('id_producto', $idProducto)
                     ->first();

        if ($item) {
            // Actualizar la cantidad si ya está en el carrito
            $this->update($item['id_carrito'], [
                'cantidad' => $item['cantidad'] + $cantidad
            ]);
        } else {
            // Insertar nuevo producto en el carrito
            $this->insert([
                'id_usuario'  => $idUsuario,
                'id_producto' => $idProducto,
                'cantidad'    => $cantidad
            ]);
        }
    }
}
