<?php
namespace Controllers;
use MVC\Router;

class RepresentanteController
{
    public static function representante(Router $router)
    {
        $representante = "pepito";
        $router->render('alumno/representante', [
            'representante' => $representante,
        ]);
    }
}