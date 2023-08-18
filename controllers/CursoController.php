<?php
namespace Controllers;
use MVC\Router;

class CursoController
{

    public static function index(Router $router){
        session_start();
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }
        
        $url = "http://localhost:3001/cursos";
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
        $router->render('alumno/cursos-vista', [
            'cursos' => $resultado,
        ]);
    }

    public static function formCurso(Router $router)
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $url = "http://localhost:3001/curso";
            $data = array(
                'nombre' => $_POST['nombreCurso'],
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

            debuguear($response);

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
            // debuguear($representante);
        };

        $router->render('Alumno/cursos', [
            
        ]);
    }
}