<?php

namespace Controllers;

use MVC\Router;

class CursoController
{

    public static function index(Router $router)
    {

        session_start();
        $mensaje = null;
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }

        $url = "http://localhost:3001/cursos";

        $resultado = consultaApi($url);

        $router->render('alumno/cursos-vista', [
            'cursos' => $resultado,
            'mensaje' => $mensaje,
        ]);
    }

    public static function formCurso(Router $router)
    {

        session_start();
        $mensaje = null;
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
            'mensaje' => $mensaje,
        ]);
    }

    public static function editarCurso1(Router $router)
    {
        session_start();
        $mensaje = null;
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $url = "http://localhost:3001/curso/{$_POST['id_curso']}";
            //debuguear($_POST);
            $data = array(
                'nombre' => $_POST['nombreCurso'],
            );

            $datos = EnvioPost($url, $data, "PUT");
            //debuguear($datos);

            if ($datos['error']) {
                $mensaje = $datos['message'];
            } elseif ($datos['message'] === 'Curso actualizado') {
                header('Location: /cursosV?mensaje=Curso Actualizado correctamente');
            }
        };
    }


    public static function editarCurso(Router $router)
    {
        session_start();
        $mensaje = null;
        if (!isset($_SESSION['token']) || empty($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }

        $id = $_GET["id"];
        $url = "http://localhost:3001/curso/{$id}";
        $resultado = consultaApi($url);
        $curso = array_shift($resultado);



        $router->render('alumno/cursos-editar', [
            'mensaje' => $mensaje,
            'curso' => $curso,
        ]);
    }
}
