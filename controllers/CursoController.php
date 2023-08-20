<?php
namespace Controllers;
use MVC\Router;

class CursoController
{

    public static function index(Router $router){
        session_start();
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }
        
        $url = "http://localhost:3001/cursos";
        
        $resultado = consultaApi($url);

        $router->render('alumno/cursos-vista', [
            'cursos' => $resultado,
        ]);
    }

    public static function formCurso(Router $router)
    {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $url = "http://localhost:3001/curso";
            $data = array(
                'nombre' => $_POST['nombreCurso'],
            );

            $datos = EnvioPost($url, $data);
            // debuguear($representante);

            if ($datos['message'] === 'Curso creado') {
                header('Location: /cursosV');
            }

        };

        $router->render('Alumno/cursos', [
            
        ]);
    }
}