<?php 

require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AlumnoController;
use Controllers\RepresentanteController;
use Controllers\CursoController;

$router = new Router();
$router->get('/alumno', [AlumnoController::class, 'formAlumno']);
$router->post('/alumno', [AlumnoController::class, 'formAlumno']);
$router->get('/representante', [RepresentanteController::class, 'representante']);
$router->post('/representante', [RepresentanteController::class, 'representante']);
$router->get('/cursos', [CursoController::class, 'formCurso']);
$router->post('/cursos', [CursoController::class, 'formCurso']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
