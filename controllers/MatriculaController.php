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
            $i = 0;
            //debuguear($_POST);
            $data = array(
                'id_alumno' => $_POST['alumno'],
                'id_curso' => $_POST['curso'],
                'n_matricula' => $i=$i+1,
                'estado' => $_POST['estado']
            );
            

            $datos = EnvioPost($urlMatricula, $data);

            //debuguear($datos);

            if ($datos['error']) {
                $mensaje = $datos['message'];
            } else if ($datos['message'] === 'Matricula creada') {
                header('Location: /matriculaListar?mensaje=Matriculado correctamente');
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


    public static function matriculaEditar(Router $router)
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
                $i = 0;
                //debuguear($_POST);
                $data = array(
                    'id_alumno' => $_POST['alumno'],
                    'id_curso' => $_POST['curso'],
                    'n_matricula' => $i=$i+1,
                    'estado' => $_POST['estado']
                );
                
    
                $datos = EnvioPost($urlMatricula, $dat, "PUT");
    
                //debuguear($datos);
    
                if ($datos['error']) {
                    $mensaje = $datos['message'];
                } else if ($datos['message'] === 'Matricula creada') {
                    header('Location: /matriculaEditar?mensaje=Matriculado correctamente');
                    exit();
                }
                    
                
            }
    
            $router->render('Matriculacion/matriculaEditar', [
                'alumnos' => $alumnos,
                'cursos' => $cursos,
                'mensaje' => $mensaje
    
            ]);
      
    }

}