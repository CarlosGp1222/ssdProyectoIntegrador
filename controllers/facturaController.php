<?php

namespace Controllers;

use MVC\Router;

class facturaController
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
        $resultado = consultaApi($url);
        $url2 = "http://localhost:3001/facturas";
        $resultado2 = consultaApi($url2);
        $facturaN = end($resultado2)->n_documento ?? 0;
        //debuguear($resultado2);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //debuguear($_POST);
            $url3 = "http://localhost:3001/facturas"; // Nota: Se ha cambiado la ruta de la API.
            //debuguear($_SESSION['token']);
            $data = array(
                'id_cliente' => $_POST['id_cliente'],
                'n_documento' => $_POST['ndocumentos'] +1,
                //debuguear($_POST['ndocumentos']),
                'concepto' => $_POST['concepto'],
                'descripcion' => $_POST['descripcion'],
                'cantidad' => $_POST['cantidad'],
                'precio' => $_POST['precio'],
                'f_documento' => $_POST['fecha'],
            );
            $facturaN = (end($resultado2)->n_documento ?? 0)+1;
            $datos = EnvioPost($url3, $data);
            //debuguear($datos);
            //debuguear($resultado2);
            //$resultado2 ->n_documento = $_POST['ndocumentos'] +1;
            
            if (!$datos['error']) {
                $mensaje = $datos['message'];
            }
            if ($datos['message'] === 'total') {
                header('Location: /facturas');
            }
            //debuguear($mensaje);
        }

        $router->render('matriculacion/facturas', [
            'mensaje' => $mensaje,
            'facturas' => $resultado,
            'facturas2' => $facturaN,
            
        ]);
    }


}
