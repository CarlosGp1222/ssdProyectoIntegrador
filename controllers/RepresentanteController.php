<?php

namespace Controllers;

use MVC\Router;

class RepresentanteController
{
    public static function representante(Router $router)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $representante = [
            //     'nombres' => $_POST['nombres'],
            //     'apellidos' => $_POST['apellidos'],
            //     'genero' => $_POST['genero'],
            //     'cedula' => $_POST['cedula'],
            //     'direccion' => $_POST['direccion'],
            //     'telefono' => $_POST['telefono'],
            //     'email' => $_POST['email'],
            // ];
            //debuguear($_SESSION['token']);
            $url = "http://localhost:3001/representante";
            $data = array(
                'nombres' => $_POST['nombres'],
                'apellidos' => $_POST['apellidos'],
                'genero' => $_POST['genero'],
                'cedula' => $_POST['cedula'],
                'direccion' => $_POST['direccion'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
            );

            $token = $_SESSION['token'];

            //debuguear($data);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ));

            $response = curl_exec($ch);

            //debuguear($response);

            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            } else {
                $datos = json_decode($response, true);
                print_r($datos);
            }

            curl_close($ch);
            // debuguear($representante);
        };

        $router->render('alumno/representante', []);
    }
}
