<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfiguracionModel extends Model
{
    protected $table = 'configuracion';
    protected $primaryKey = 'id_configuracion';
    protected $allowedFields = ['nombre_empresa', 'telefono', 'correo', 'direccion', 'logo'];

    // Obtener la configuración actual
    public function obtenerConfiguracion()
    {
        return $this->first(); // Suponemos que solo hay una fila de configuración
    }
}