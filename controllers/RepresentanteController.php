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
        //Consulta representante
        $url = "http://localhost:3001/representante";
        $resultado = consultaApi($url);    

        $mensaje = $_GET['mensaje'] ?? null;
        
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
        $mensaje = null;
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

            $datos = EnvioPost($url, $data);
            // debuguear($representante);
            if ($datos['error']) {
                $mensaje = $datos['message'];
            }
            if ($datos['message'] === 'Saved') {
                header('Location: /representantes?mensaje=Representante agregado Correctamente');
            }
        };

        $router->render('alumno/representante', [
            'mensaje'=>$mensaje
        ]);
    }

    public static function editarRepresentante(Router $router)
    {
        session_start();

        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }
        
        $id = $_GET['id'] ?? null;
        $url = "http://localhost:3001/representante/{$id}";
        $resultado = consultaApi($url);
        $reprentante = array_shift($resultado);
        
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
            $datos = EnvioPost($url, $data, "PUT");

            if ($datos['message'] === 'Actualizado') {
                header('Location: /representantes?mensaje=Representante actualizado correctamente');
            }
        }

        $router->render('alumno/representante-editar', [
            'representante' => $reprentante
        ]);
    }

    //editar representante


}
