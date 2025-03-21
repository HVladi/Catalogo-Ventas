<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $allowedFields = ['id_usuario', 'categoria', 'nombre_producto', 'precio', 'marca', 'existencia', 'imagen',];
}