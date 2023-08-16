<?php
namespace Controllers;
use MVC\Router;

class CursoController
{
    public static function formCurso(Router $router)
    {
        $router->render('Alumno/cursos', [
            
        ]);
    }
}