<?php

namespace Controllers;

use MVC\Router;

class RepresentanteController
{
    public static function index(Router $router)
    {
        $url = "http://localhost:3001/representante";
        $token = $_SESSION['token']; // Asumiendo que ya tienes el token almacenado en la sesión.
        debuguear($token);
        // Inicializar cURL
        $ch = curl_init($url);

        // Configurar opciones de cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $token
        ));

        // Ejecutar petición y obtener resultado
        $data = curl_exec($ch);
        
        // Si hay un error en la petición
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            curl_close($ch);
            exit;
        }

        // Decodificar respuesta JSON
        $obj = json_decode($data);

        // Procesar la respuesta
        $resultado = $obj->data;
        
        // $reprentantes = array_shift($resultado);

        // Cerrar cURL
        curl_close($ch);
        $router->render('alumno/representante-vista', []);
    }
    public static function representante(Router $router)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
                // print_r($datos);
            }

            curl_close($ch);
            // debuguear($representante);
        };

        $router->render('alumno/representante', []);
    }

    public static function editarRepresentante(Router $router)
    {
    }
}
