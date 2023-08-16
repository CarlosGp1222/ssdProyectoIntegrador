<?php
namespace Controllers;
use MVC\Router;


class AlumnoController
{
    public static function formAlumno(Router $router)
    {
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $alumno = [
                'nombres' => $_POST['nombres'],
                'apellidos' => $_POST['apellidos'],
                'genero' => $_POST['genero'],
                'cedula' => $_POST['cedula'],
                'cedulaRepre' => $_POST['cedulaRepre'],
                'fecha_nacimiento' => $_POST['fecha_nacimiento'],
                'direccion' => $_POST['direccion'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
                'tipo_matriculacion' => $_POST['tipo_matriculacion'],
            ];
            debuguear($alumno);
        };

        $router->render('Alumno/alumno', [
          
        ]);
    }
}



