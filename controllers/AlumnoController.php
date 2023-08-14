<?php
namespace Controllers;
use MVC\Router;


class AlumnoController
{
    public static function index(Router $router)
    {
        $alumno = "pepito";

        $router->render('alumno/index', [
            'alumno' => $alumno,
        ]);
    }
}



