<?php 

require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AlumnoController;
use Controllers\RepresentanteController;

$router = new Router();
$router->get('/alumno', [AlumnoController::class, 'index']);
$router->post('/alumno', [AlumnoController::class, 'index']);
$router->get('/representante', [RepresentanteController::class, 'representante']);
$router->post('/representante', [RepresentanteController::class, 'representante']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
