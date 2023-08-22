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
            // debuguear($_POST);
            $data = array(
                'id_alumno' => $_POST['alumno'],
                'id_curso' => $_POST['curso'],
                'n_matricula' => $i=$i+1,
                'estado' => $_POST['estado']
            );
            

            $datos = EnvioPost($urlMatricula, $data);
            // debuguear($datos);
            

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
        $mensaje = null;
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }
        
        $mensaje = $_GET['mensaje'] ?? null;
        $url = "http://localhost:3001/matricula";
        $matriculas = consultaApi($url);
        // debuguear($matriculas);
        //debuguear($_SESSION['token']);
        // $reprentantes = array_shift($resultado);
        //debuguear($id_matricula);
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
    
            $id = $_GET['id'];
            
            $url = "http://localhost:3001/matricula/{$id}";
            $matriculas =  consultaApi($url);
            $matricula = array_shift($matriculas);
            // debuguear($matricula);
            
            
            //debuguear($matricula);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $urlMatricula = "http://localhost:3001/matricula/{$_POST['id_matricula']}";
                $i = 0;
                //debuguear($urlMatricula);
                $data = array(                    
                    'id_curso' => $_POST['curso'],
                    'estado' => $_POST['estado']
                );

                //debuguear($data);
    
                $datos = EnvioPost($urlMatricula, $data, "PUT");
    
                //debuguear($datos);
    
                if ($datos['error']) {
                    $mensaje = $datos['message'];
                } else if ($datos['message'] === 'Matricula actualizada') {
                    header('Location: /matriculaListar?mensaje=Matricula actualizada correctamente');
                    exit();
                }
                    
                
            }
    
            $router->render('Matriculacion/matriculaEditar', [
                'alumnos' => $alumnos,
                'cursos' => $cursos,
                'mensaje' => $mensaje,
                'matricula' => $matricula
            ]);
      
    }

}