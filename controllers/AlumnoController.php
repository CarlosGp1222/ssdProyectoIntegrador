<?php

namespace Controllers;
use MVC\Router;

class AlumnoController
{
    public static function formAlumno(Router $router)
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $url = "http://localhost:3001/alumno"; // Nota: Se ha cambiado la ruta de la API.
            $data = array(
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
            );

            //debuguear($data);

            $token = $_SESSION['token']; // Asumiendo que el token ya está almacenado en la sesión.

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
                //print_r($datos);
            }

            curl_close($ch);
        }

        $router->render('Alumno/alumno', []);
    }
}
