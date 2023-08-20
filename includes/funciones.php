<?php

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}

// Función que revisa que el usuario este autenticado
function isAuth(): void
{
    if (!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function consultaApi($url)
{
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
    curl_close($ch);
    if (isset($data) && $data === 'Token inválido' || $data === 'Error al desencriptar el token' || $data === 'Token no proporcionado') {
        // Aquí puedes manejar el error, por ejemplo, redirigiendo al usuario al login
        header('Location: /login');
        exit;
    }

    return $obj->tipos;
}

function EnvioPost($url, $data, $POST = "POST"){
    $token = $_SESSION['token'];

    //debuguear($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if ($POST == "POST") {
        curl_setopt($ch, CURLOPT_POST, true);
    }else{
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");  
    }    
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
    return $datos;
}
