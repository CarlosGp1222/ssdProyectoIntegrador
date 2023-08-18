<?php

namespace Controllers;

use MVC\Router;

class MatriculaController
{
    public static function matricula(Router $router)
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
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

        $router->render('Matriculacion/matricula', []);
    }



    public static function matriculaListar (Router $router)
    {
        session_start();
        $id = $_GET['id'];
        $url = "http://localhost:3001/matriculaListar/{$id}";
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
        
        // Si hay un error en la petición
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
            curl_close($ch);
            exit;
        }

        // Decodificar respuesta JSON
        $obj = json_decode($data);
        
        // Procesar la respuesta
        $resultado = $obj->tipos;
        $matricula = array_shift($resultado);
        curl_close($ch);
        $router->render('Matriculacion/matriculaListar', [
            'matricula' => $matricula,
        ]);
    }
    //mostrar vista editar
    
}



