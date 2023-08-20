<?php 

require_once __DIR__ . '/../includes/app.php';


use MVC\Router;
use Controllers\AlumnoController;
use Controllers\RepresentanteController;
use Controllers\CursoController;
use Controllers\LoginController;
use Controllers\MatriculaController;

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
$router->Get('/matriculaListar', [MatriculaController::class, 'matriculaListar']);
$router->Post('/matricula', [MatriculaController::class, 'matricula']);



// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();
