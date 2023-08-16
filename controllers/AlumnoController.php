<?php
namespace Controllers;
use MVC\Router;


class AlumnoController
{
    public static function formAlumno(Router $router)
    {
        $alumno = "pepito";

        $router->render('Alumno/alumno', [
            'alumno' => $alumno,
        ]);
    }
}



