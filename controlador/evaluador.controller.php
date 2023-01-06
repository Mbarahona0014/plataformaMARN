<?php

require_once '../modelo/evaluador.class.php';
require_once '../helpers/helper.class.php';
require_once '../modelo/evaluador_encabezado.class.php';
//deleteheaderEvaluators
$em = new Evaluator();
$hem = new headerEvaluator();
$hlp = new Helper();

if (isset($_POST) || isset($_GET)) {
    $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;

    $id_post = isset($_POST['id_evaluador']) ? (int)$hlp->clear($_POST['id_evaluador']) : false;
    $id_get = isset($_GET['id']) ? (int)$hlp->clear($_GET['id']) : false;

    $nombres = isset($_POST['nombres']) ? $hlp->clear($_POST['nombres']) : false;
    $apellidos = isset($_POST['apellidos']) ? $hlp->clear($_POST['apellidos']) : false; 
    $telefono = isset($_POST['telefono']) ? $hlp->clear($_POST['telefono']) : false;
    $correo = isset($_POST['correo']) ? $hlp->clear($_POST['correo']) : false;
    $institucion = isset($_POST['institucion']) ? $hlp->clear($_POST['institucion']) : false;
    $cargo = isset($_POST['cargo']) ? $hlp->clear($_POST['cargo']) : false;

    if($accion){
        switch($accion){
            case 'list':
                $evaluators = $em->getEvaluators();
                if($evaluators){
                    print_r(json_encode($evaluators, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                }else{
                    print_r(json_encode([
                        "sEcho" => 1,
                        "iTotalRecords" => 0,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => []
                    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                }
                break;
            case 'create':
                if(!$nombres || !$apellidos || !$correo || !$telefono || !$institucion || !$cargo){
                    print_r(json_encode([
                        "success" => false,
                        "mensaje" => "¡Debe ingresar todos los datos!"
                      ]));
                }else{
                    $evaluator= $em->createEvaluator($nombres,$apellidos,$telefono,$correo,$institucion,$cargo);
                    if($evaluator[0]["resultado"] == 1){
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Evaluador agregado correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }else{
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡El evaluador ya existe!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'get':
                if ($id_get){
                    $evaluator= $em->getEvaluatorById($id_get);
                    if($evaluator){
                        print_r(json_encode([
                            "success" => true,
                            "evaluador" => $evaluator
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }else{
                        print_r(json_encode([
                            "success" => false,
                            "evaluador" => []
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'update':
                if(!$nombres || !$apellidos || !$correo || !$telefono || !$institucion || !$cargo || !$id_post){
                    print_r(json_encode([
                        "success" => false,
                        "mensaje" => "¡Debe ingresar todos los datos!"
                    ]));
                }else{
                    $evaluator = $em->updateEvaluator($nombres,$apellidos,$telefono,$correo,$institucion,$cargo,$id_post);
                    if($evaluator[0]["resultado"] == 1){
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Evaluador actualizado correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }else {
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡El evaluador ya existe!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'delete':
                if($id_get){
                    $hem->deleteheaderEvaluators($id_get);
                    $evaluator = $em->deleteEvaluator($id_get);
                    if($evaluator){
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Evaluador eliminado correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }else{
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡Hubo un problema al eiliminar el evaluador!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            default:
            print_r(json_encode([
                "success" => false,
                "mensaje" => "¡Accion no encontrada!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
            break;
        }
    }
}