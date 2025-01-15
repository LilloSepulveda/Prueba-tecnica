<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'c_usuarios::inicio');


$routes->get('/registro', 'c_usuarios::registro');

$routes->post('/guardar_usuario', 'c_usuarios::guardar_usuario');

$routes->post('/validar_ingreso', 'c_usuarios::validar_ingreso');

$routes->get('/perfil', 'c_usuarios::perfil');
$routes->post('/perfil', 'c_usuarios::perfil');

$routes->get('/cerrar_sesion', 'c_usuarios::cerrar_sesion');


$routes->post('/actualizar_perfil', 'c_usuarios::actualizar_perfil');

$routes->post('/eliminar_cuenta', 'c_usuarios::eliminar_cuenta');

$routes->get('/tabla', 'c_usuarios::tabla');

$routes->post('/actualizar', 'c_usuarios::actualizar');