<?php

namespace Controllers;

use MVC\Router;

class RepresentanteController
{
    public static function index(Router $router)
    {
        session_start();
        $mensaje = null;
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }

        $url = "http://localhost:3001/representante";
        $token = $_SESSION['token']; // Asumiendo que ya tienes el token almacenado en la sesión.
        // debuguear($token);
        // Inicializar cURL
        $ch = curl_init($url);
        $mensaje = $_GET['mensaje'] ?? null;
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
        $router->render('alumno/representante-vista', [
            'representantes' => $resultado,
            'mensaje' => $mensaje
        ]);
    }
    public static function representante(Router $router)
    {
        session_start();

        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }

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
                //print_r($datos);
                if (isset($response) && $response === 'Token inválido' || $response === 'Error al desencriptar el token' || $response === 'Token no proporcionado') {
                    // Aquí puedes manejar el error, por ejemplo, redirigiendo al usuario al login
                    header('Location: /login');
                    exit;
                }
            }

            curl_close($ch);
            // debuguear($representante);

            if ($datos['message'] === 'Saved') {
                header('Location: /representantes');
            }
        };

        $router->render('alumno/representante', []);
    }

    public static function editarRepresentante(Router $router)
    {
        session_start();

        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }
        
        $id = $_GET['id'];
        $url = "http://localhost:3001/representante/{$id}";
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $url = "http://localhost:3001/representante/{$_POST['cedula']}";
            $data = array(
                'nombres' => $_POST['nombres'],
                'apellidos' => $_POST['apellidos'],
                'genero' => $_POST['genero'],
                //'cedula' => $_POST['cedula'],
                'direccion' => $_POST['direccion'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
            );

            $token = $_SESSION['token'];

            //debuguear($data);
            $ch = curl_init($url);

            // Configurar opciones de cURL
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    // Devolver respuesta como string
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");    // Establecer método como PUT
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Datos a enviar en formato JSON
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(        // Establecer cabeceras
                'Content-Type: application/json',
                'Content-Length: ' . strlen(json_encode($data)),
                'Authorization: Bearer ' . $_SESSION['token']   // Cabecera de autorización con el token
            ));

            // Ejecutar petición y obtener respuesta
            $response = curl_exec($ch);

            //debuguear($response);

            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            } else {
                $datos = json_decode($response, true);
                //print_r($datos);
                if (isset($response) && $response === 'Token inválido' || $response === 'Error al desencriptar el token' || $response === 'Token no proporcionado') {
                    // Aquí puedes manejar el error, por ejemplo, redirigiendo al usuario al login
                    header('Location: /login');
                    exit;
                }
            }

            curl_close($ch);
            // debuguear($representante);

            if ($datos['message'] === 'Actualizado') {
                header('Location: /representantes?mensaje=Representante actualizado correctamente');
            }
        }

        // Procesar la respuesta
        $resultado = $obj->tipos;
        $reprentante = array_shift($resultado);
        curl_close($ch);
        $router->render('alumno/representante-editar', [
            'representante' => $reprentante
        ]);
    }

    //editar representante


}
