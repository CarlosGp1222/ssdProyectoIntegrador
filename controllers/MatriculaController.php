<?php

namespace Controllers;

use MVC\Router;

class MatriculaController
{
    public static function matricula(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $matricula = [
            //     'id' => $_POST['nombres'],
            //     '' => $_POST['apellidos'],
            //     'genero' => $_POST['genero'],
            //     'cedula' => $_POST['cedula'],
            //     'direccion' => $_POST['direccion'],
            //     'telefono' => $_POST['telefono'],
            //     'email' => $_POST['email'],
            // ];

            $url = "http://localhost:3001/matricula";
            $data = array(
                'id_curso' => $_POST['id_curso'],
                'nombre' => $_POST['nombre'],
            );

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            } else {
                $datos = json_decode($response, true);
                print_r($datos);
            }

            curl_close($ch);
            // debuguear($matricula);
        };

        $router->render('matriculacion/matricula', []);
    }
}
