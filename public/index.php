<?php 

require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AlumnoController;
$router = new Router();
$router->get('/', [AlumnoController::class, 'index']);
$router->post('/', [AlumnoController::class, 'index']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
