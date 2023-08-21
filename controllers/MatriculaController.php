<?php

namespace Controllers;

use MVC\Router;

class MatriculaController
{
    public static function matricula(Router $router)
    {
        $mensaje = null;
        session_start();
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }
        $urlAlumnos = "http://localhost:3001/alumnos";
        $alumnos = consultaApi($urlAlumnos);

        $urlCursos = "http://localhost:3001/cursos";
        $cursos = consultaApi($urlCursos);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $urlMatricula = "http://localhost:3001/matricula";
            
            $data = array(
                'id_alumno' => $_POST['alumno'],
                'id_curso' => $_POST['curso'],
                'estado' => $_POST['estado'],
            );
            

            $datos = EnvioPost($urlMatricula, $data);

            if ($datos['error']) {
                $mensaje = $datos['message'];
            } else if ($datos['message'] === 'Matricula creada') {
                header('Location: /matricula?mensaje=Matriculado correctamente');
                exit();
            }
                
            
        }

        $router->render('Matriculacion/matricula', [
            'alumnos' => $alumnos,
            'cursos' => $cursos,
            'mensaje' => $mensaje

        ]);
    }

    public static function matriculaListar(Router $router)
    {
        session_start();
        $mensaje = "";
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }
        
        $mensaje = $_GET['mensaje'] ?? null;
        $url = "http://localhost:3001/matricula";
        $matriculas = consultaApi($url);
        
        // $reprentantes = array_shift($resultado);
        // debuguear($matriculas);
        // Cerrar cURL
        //curl_close($ch);
        $router->render('Matriculacion/matriculaListar', [
            'matriculas' => $matriculas,
            'mensaje' => $mensaje,
        ]);
    }

}