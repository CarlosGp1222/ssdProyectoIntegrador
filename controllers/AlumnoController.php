<?php

namespace Controllers;
use MVC\Router;

class AlumnoController
{
    public static function index(Router $router)
    {
        session_start();
        $mensaje = "";
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }
        
        $mensaje = $_GET['mensaje'] ?? null;
        $url = "http://localhost:3001/alumnos";
        $token = $_SESSION['token']; // Asumiendo que ya tienes el token almacenado en la sesión.
        
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
            'mensaje' => $mensaje,
        ]);
    }
    public static function formAlumno(Router $router)
    {
        session_start();
        $mensaje = null;
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }


        $url = "http://localhost:3001/descuento";
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
        $descuentos = $obj->tipos;
        
        //debuguear($descuentos);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $url = "http://localhost:3001/alumno"; // Nota: Se ha cambiado la ruta de la API.
            $data = array(
                'nombres' => $_POST['nombres'],
                'apellidos' => $_POST['apellidos'],
                'genero' => $_POST['genero'],
                'cedula' => $_POST['cedula'],
                'cedulaRepre' => $_POST['cedulaRepre'],
                'f_nacimiento' => $_POST['fecha_nacimiento'],
                'direccion' => $_POST['direccion'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
                'tipo_matriculacion' => $_POST['tipo_matriculacion'],
            );

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . $token
            ));

            $response = curl_exec($ch);
            
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
            //debuguear($datos);
            
            if ($datos['error']) {
                $mensaje = $datos['message'];
            }
            if ($datos['message'] === 'Saved') {
                header('Location: /alumnos?mensaje=Alumno agregado correctamente');
            }
            //debuguear($mensaje);
        }

        $router->render('Alumno/alumno', [
            'descuentos' => $descuentos,
            'mensaje' => $mensaje,
        ]);
    }
}
