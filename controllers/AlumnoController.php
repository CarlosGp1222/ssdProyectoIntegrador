<?php

namespace Controllers;
use MVC\Router;

class AlumnoController
{
    public static function index(Router $router)
    {
        session_start();

        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }

        $url = "http://localhost:3001/alumnos";
        $token = $_SESSION['token']; // Asumiendo que ya tienes el token almacenado en la sesión.
        // debuguear($token);
        // Inicializar cURL
        $ch = curl_init($url);

        // Configurar opciones de cURL
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $token
        ));

        // Ejecutar petición y obtener resultado
        $data = curl_exec($ch);
        //debuguear($data);
        // Si hay un error en la petición
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            curl_close($ch);
            exit;
        }

        // Decodificar respuesta JSON
        $obj = json_decode($data);
        

        if (isset($data) && $data === 'Token inválido' || $data === 'Error al desencriptar el token' || $data === 'Token no proporcionado') {
            // Aquí puedes manejar el error, por ejemplo, redirigiendo al usuario al login
            header('Location: /login');
            exit;
        }

        
        // Procesar la respuesta
        $resultado = $obj->tipos;
        
        // $reprentantes = array_shift($resultado);
        // debuguear($resultado);
        // Cerrar cURL
        curl_close($ch);
        $router->render('alumno/alumno-vista', [
            'alumnos' => $resultado,
        ]);
    }
    public static function formAlumno(Router $router)
    {
        session_start();

        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }

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
                if (isset($datos) && $datos === 'Token inválido' || $datos === 'Error al desencriptar el token' || $datos === 'Token no proporcionado') {
                    // Aquí puedes manejar el error, por ejemplo, redirigiendo al usuario al login
                    header('Location: /login');
                    exit;
                }
            }

            curl_close($ch);
        }

        $router->render('Alumno/alumno', []);
    }
}
