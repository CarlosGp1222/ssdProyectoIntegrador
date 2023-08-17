<?php

namespace Controllers;

use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {

        session_start();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            // URL de tu API de Node.js
            $api_url = "http://localhost:3000/login";

            // Inicializa cURL
            $ch = curl_init($api_url);

            // Establece los parámetros de cURL
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array("username" => $username, "password" => $password)));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

            // Ejecuta la solicitud
            $response = curl_exec($ch);

            // Decodifica la respuesta (que será tu token encriptado)
            $data = json_decode($response);

            // Guarda el token para su uso posterior (puedes usar una sesión o lo que prefieras)
            $_SESSION["token"] = $data->token;

            // Cierra la sesión cURL
            curl_close($ch);
        }



        $router->render('login/login', []);
    }
}
