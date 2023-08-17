<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];

        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Datos del formulario de inicio de sesión
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Endpoint de tu API para autenticación
            $apiUrl = 'http://localhost:3001/login';

            // Inicializar cURL
            $ch = curl_init($apiUrl);

            // Configurar cURL para enviar datos mediante POST
            $data = json_encode(['username' => $username, 'password' => $password]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            ]);

            // Ejecutar cURL y obtener la respuesta
            $response = curl_exec($ch);

            // Verificar errores
            if (curl_errno($ch)) {
                $errores[] = 'Error en la conexión con la API.';
            } else {
                $decodedResponse = json_decode($response, true);
                if (isset($decodedResponse['token'])) {
                    $_SESSION['token'] = $decodedResponse['token'];
                    //debuguear($_SESSION['token']);
                    header('Location: /alumno');
                    exit;
                } else {
                    $errores[] = 'Error en las credenciales.';
                }
            }

            // Cerrar conexión cURL
            curl_close($ch);
           
        }

        $router->render('login/login', [
            'errores' => $errores
        ]);
    }
}
