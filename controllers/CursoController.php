<?php
namespace Controllers;
use MVC\Router;

class CursoController
{
    public static function formCurso(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $curso = [
                'nombreCurso' => $_POST['nombreCurso'],
            ];
            debuguear($curso);
        };
        $router->render('Alumno/cursos', [
            
        ]);
    }
}