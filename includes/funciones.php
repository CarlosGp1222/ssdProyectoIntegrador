<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Función que revisa que el usuario este autenticado
function isAuth() : void {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function consultaApi($url){
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
    return $obj;
}