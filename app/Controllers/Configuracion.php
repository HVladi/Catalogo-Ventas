<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ConfiguracionModel;

class Configuracion extends Controller
{
    public function index()
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Cargar el modelo de configuración
        $configuracionModel = new ConfiguracionModel();

        // Obtener la configuración actual
        $configuracion = $configuracionModel->obtenerConfiguracion();

        // Mostrar la vista con los datos de configuración
        return view('configuracion/index', [
            'configuracion' => $configuracion,
        ]);
    }

    public function guardar()
    {
        $session = session();

        // Verificar si el usuario está logueado
        if (!$session->get('isLoggedIn')) {
            return redirect()->to(base_url('/login'));
        }

        // Validar los datos del formulario
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre_empresa' => 'required|max_length[100]',
            'telefono' => 'required|max_length[20]',
            'correo' => 'required|valid_email|max_length[100]',
            'direccion' => 'required|max_length[255]',
            'logo' => 'uploaded[logo]|max_size[logo,1024]|is_image[logo]', // Validar la imagen
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Si la validación falla, regresar con errores
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Obtener los datos del formulario
        $nombre_empresa = $this->request->getPost('nombre_empresa');
        $telefono = $this->request->getPost('telefono');
        $correo = $this->request->getPost('correo');
        $direccion = $this->request->getPost('direccion');
        $logo = $this->request->getFile('logo');

        // Mover la imagen a la carpeta de uploads
        $nombreLogo = $logo->getRandomName();
        $logo->move(ROOTPATH . 'public/uploads', $nombreLogo);

        // Cargar el modelo de configuración
        $configuracionModel = new ConfiguracionModel();

        // Insertar o actualizar la configuración
        $configuracionModel->save([
            'id_configuracion' => 1, // Suponemos que solo hay una fila de configuración
            'nombre_empresa' => $nombre_empresa,
            'telefono' => $telefono,
            'correo' => $correo,
            'direccion' => $direccion,
            'logo' => $nombreLogo,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->to(base_url('/configuracion'))->with('success', 'Configuración guardada exitosamente.');
    }
}