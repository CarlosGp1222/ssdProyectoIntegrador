<?php 

require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AlumnoController;
use Controllers\RepresentanteController;
use Controllers\CursoController;
use Controllers\LoginController;
use Controllers\MatriculaController;
use Controllers\facturaController;

$router = new Router();
$router->get('/alumno', [AlumnoController::class, 'formAlumno']);
$router->post('/alumno', [AlumnoController::class, 'formAlumno']);
$router->get('/alumnos', [AlumnoController::class, 'index']);
$router->get('/alumnos-editar', [AlumnoController::class, 'editarAlumno']);
$router->post('/alumnos-editar', [AlumnoController::class, 'editarAlumno']);
$router->get('/representante', [RepresentanteController::class, 'representante']);
$router->post('/representante', [RepresentanteController::class, 'representante']);
$router->get('/representantes', [RepresentanteController::class, 'index']);
$router->get('/representantes-editar', [RepresentanteController::class, 'editarRepresentante']);
$router->post('/representantes-editar', [RepresentanteController::class, 'editarRepresentante']);
$router->get('/cursos', [CursoController::class, 'formCurso']);
$router->post('/cursos', [CursoController::class, 'formCurso']);
$router->get('/cursosV', [CursoController::class, 'index']);
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/matriculaListar', [MatriculaController::class, 'matriculaListar']);
$router->post('/matricula', [MatriculaController::class, 'matricula']);
$router->get('/matriculaEditar', [MatriculaController::class, 'matriculaEditar']);
$router->post('/matriculaEditar', [MatriculaController::class, 'matriculaEditar']);
$router->get('/matricula', [MatriculaController::class, 'matricula']);
$router->get('/facturas', [facturaController::class, 'index']);
$router->post('/facturas', [facturaController::class, 'index']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
