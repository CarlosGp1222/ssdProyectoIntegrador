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
        $resultado = consultaApi($url);
        
        // $reprentantes = array_shift($resultado);
        // debuguear($resultado);
        // Cerrar cURL
        //curl_close($ch);
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
                
        $descuentos = consultaApi($url);
        
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

            $datos = EnvioPost($url, $data);

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
    public static function editarAlumno(Router $router)
    {
        session_start();
        $mensaje = null;
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }

        $url = "http://localhost:3001/descuento";                
        $descuentos = consultaApi($url);
        
        $id = $_GET["id"];
        
        $url = "http://localhost:3001/alumno/{$id}";                
        $alumnos = consultaApi($url);
        $alumno = array_shift($alumnos);
        //debuguear($alumno);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $url = "http://localhost:3001/alumno/{$_POST['cedula']}"; // Nota: Se ha cambiado la ruta de la API.
            $data = array(
                'nombres' => $_POST['nombres'],
                'apellidos' => $_POST['apellidos'],
                'genero' => $_POST['genero'],
                'cedula' => $_POST['cedula'],
                'cedula_representante' => $_POST['cedulaRepre'],
                'f_nacimiento' => $_POST['fecha_nacimiento'],
                'direccion' => $_POST['direccion'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
                'tipo_matriculacion' => $_POST['tipo_matriculacion'],
            );

            $datos = EnvioPost($url, $data, "PUT");
            //debuguear($datos);
            if ($datos['error']) {
                $mensaje = $datos['message'];
            }
            if ($datos['message'] === 'Actualizado') {
                header('Location: /alumnos?mensaje=Alumno Actualizado correctamente');
            }
            //debuguear($mensaje);
        }

        $router->render('Alumno/alumno-editar', [
            'descuentos' => $descuentos,
            'mensaje' => $mensaje,
            'alumno' => $alumno,
        ]);
    }
}
