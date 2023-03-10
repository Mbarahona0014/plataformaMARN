<?php

require_once '../modelo/evaluador_encabezado.class.php';
require_once '../helpers/helper.class.php';

$hm = new headerEvaluator();
$hlp = new Helper();

if (isset($_POST) || isset($_GET)) {
    $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;

    $id_post = isset($_POST['id']) ? (int)$hlp->clear($_POST['id']) : false;
    $id_get = isset($_GET['id']) ? (int)$hlp->clear($_GET['id']) : false;
    $id_en_get = isset($_GET['idEn']) ? (int)$hlp->clear($_GET['idEn']) : false;

    $id_encabezado = isset($_POST['id_encabezado']) ? $hlp->clear($_POST['id_encabezado']) : false;
    $id_evaluador = isset($_POST['evaluador']) ? $hlp->clear($_POST['evaluador']) : false;

    if($accion){
        switch($accion){
            case 'list':
                $headersEvaluators = $hm->getHeadersEvaluators($id_encabezado);
                if($headersEvaluators){
                    print_r(json_encode($headersEvaluators, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                }else{
                    print_r(json_encode([
                        "sEcho" => 1,
                        "iTotalRecords" => 0,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => []
                    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                }
                break;
            case 'listNom':
                $headersEvaluators = $hm->getHeadersEvaluatorsNom($id_en_get);
                if($headersEvaluators){
                    print_r(json_encode($headersEvaluators, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                }else{
                    print_r(json_encode([
                        "sEcho" => 1,
                        "iTotalRecords" => 0,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => []
                    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                }
                break;
            case 'updateListNom':
                $headersEvaluators = $hm->getHeadersEvaluatorsNom($id_encabezado);
                if($headersEvaluators){
                    print_r(json_encode($headersEvaluators, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
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
                if(!$id_encabezado){
                    print_r(json_encode([
                        "success" => false,
                        "mensaje" => "¡No ha seleccionado evaluacion!"
                      ]));
                }else if (!$id_evaluador){
                    print_r(json_encode([
                        "success" => false,
                        "mensaje" => "¡No ha seleccionado evaluador!"
                      ]));
                }else{
                    $headerEvaluators = $hm->createHeaderEvaluator($id_encabezado,$id_evaluador);
                    if($headerEvaluators[0]["resultado"] == 1){
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Evaluador agregada correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }else{
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡Ocurrio un error!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'get':
                if ($id_get){
                    $headerEvaluators= $hm->getheaderEvaluatorById($id_get);
                    if($headerEvaluators){
                        print_r(json_encode([
                            "success" => true,
                            "encabezado" => $headerEvaluators
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }else{
                        print_r(json_encode([
                            "success" => false,
                            "encabezado" => []
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'update':
                if(!$id_encabezado || !$id_evaluador || !$id_post){
                    print_r(json_encode([
                        "success" => false,
                        "mensaje" => "¡Debe ingresar todos los datos!"
                    ]));
                }else{
                    $headerEvaluators = $hm->updateheaderEvaluator($id_encabezado,$id_evaluador,$id_post);
                    if($headerEvaluators[0]["resultado"] == 1){
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
                    $headerEvaluators = $hm->deleteheaderEvaluator($id_get);
                    if($headerEvaluators){
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Evaluador eliminado correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }else{
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡Hubo un problhma al eiliminar el evaluador!",
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