<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/logout', 'Login::logout');
$routes->get('/dashboard', 'Dashboard::index');

$routes->get('/usuarios', 'Usuarios::index');
$routes->post('/usuarios/crear', 'Usuarios::crear');

$routes->get('/usuarios/editar/(:num)', 'Usuarios::editar/$1'); // Ruta para editar
$routes->post('/usuarios/actualizar/(:num)', 'Usuarios::actualizar/$1'); // Ruta para actualizar
$routes->get('/usuarios/borrar/(:num)', 'Usuarios::borrar/$1'); // Ruta para borrar

$routes->get('/productos', 'Productos::index');
$routes->post('/productos/crear', 'Productos::crear');

$routes->get('/productos/editar/(:num)', 'Productos::editar/$1'); // Ruta para editar
$routes->post('/productos/actualizar/(:num)', 'Productos::actualizar/$1'); // Ruta para actualizar
$routes->get('/productos/eliminar/(:num)', 'Productos::eliminar/$1'); // Ruta para eliminar

$routes->get('/clientes', 'Clientes::index');
$routes->get('/clientes/editar/(:num)', 'Clientes::editar/$1'); // Ruta para editar
$routes->post('/clientes/actualizar/(:num)', 'Clientes::actualizar/$1'); // Ruta para actualizar
$routes->get('/clientes/eliminar/(:num)', 'Clientes::eliminar/$1'); // Ruta para eliminar

$routes->get('/categorias', 'Categorias::index');
$routes->post('/categorias/crear', 'Categorias::crear');
$routes->get('/categorias/editar/(:num)', 'Categorias::editar/$1'); // Ruta para editar
$routes->post('/categorias/actualizar/(:num)', 'Categorias::actualizar/$1'); // Ruta para actualizar
$routes->get('/categorias/eliminar/(:num)', 'Categorias::eliminar/$1'); // Ruta para eliminar

$routes->get('/ventas', 'Ventas::index');

$routes->get('/configuracion', 'Configuracion::index');
$routes->post('/configuracion/guardar', 'Configuracion::guardar');

$routes->get('/compra_venta', 'CompraVenta::index');
$routes->get('/categoria/(:num)', 'CompraVenta::categoria/$1');

$routes->post('carrito/agregar', 'CarritoController::agregar');
$routes->get('carrito', 'CarritoController::index');
$routes->post('carrito/eliminar', 'CarritoController::eliminar');

$routes->post('/carrito/agregar', 'CompraVenta::agregarAlCarrito');

$routes->post('carrito/comprar', 'CarritoController::comprar');


$routes->get('/producto/(:num)', 'CompraVenta::detalleProducto/$1');

$routes->get('configuracion_usuario', 'ConfiguracionUsuarioController::index');
$routes->post('configuracion_usuario/actualizar', 'ConfiguracionUsuarioController::actualizar');

$routes->get('registro', 'RegistroController::index');
$routes->post('registro/registrar', 'RegistroController::registrar');
