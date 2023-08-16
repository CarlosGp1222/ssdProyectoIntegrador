<?php
namespace Controllers;
use MVC\Router;

class RepresentanteController
{
    public static function representante(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $representante = [
                'nombres' => $_POST['nombres'],
                'apellidos' => $_POST['apellidos'],
                'genero' => $_POST['genero'],
                'cedula' => $_POST['cedula'],
                'direccion' => $_POST['direccion'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
            ];
            debuguear($representante);
        };

        $router->render('alumno/representante', [
            
        ]);
    }
}