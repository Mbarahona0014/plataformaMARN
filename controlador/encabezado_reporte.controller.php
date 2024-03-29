<?php

require_once '../modelo/encabezado_reporte.class.php';
require_once '../helpers/helper.class.php';

$hm = new rHeader();
$hlp = new Helper();

if (isset($_POST) || isset($_GET)) {
    $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;

    $id_post = isset($_POST['id_encabezado']) ? (int)$hlp->clear($_POST['id_encabezado']) : false;
    $id_get = isset($_GET['id']) ? (int)$hlp->clear($_GET['id']) : false;
    $id_ev = isset($_GET['id_ev']) ? (int)$hlp->clear($_GET['id_ev']) : false;
    $status = isset($_GET['estado']) ? (int)$hlp->clear($_GET['estado']) : false;

    $fecha = isset($_POST['fecha']) ? $hlp->clear($_POST['fecha']) : false;
    $idArea = isset($_POST['area']) ? $hlp->clear($_POST['area']) : false;
    $idAC  = isset($_POST['conservacion']) ? $hlp->clear($_POST['conservacion']) : false;

    if ($accion) {
        switch ($accion) {
            case 'list':
                $headers = $hm->getHeaders();
                if ($headers) {
                    print_r(json_encode($headers, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                } else {
                    print_r(json_encode([
                        "sEcho" => 1,
                        "iTotalRecords" => 0,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => []
                    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                }
                break;
            case 'listByArea':
                $headers = $hm->getHeadersByArea($id_get);
                if ($headers) {
                    print_r(json_encode($headers, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                } else {
                    print_r(json_encode([
                        "sEcho" => 1,
                        "iTotalRecords" => 0,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => []
                    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                }
                break;
            case 'listPreviousByArea':
                $headers = $hm->getPreviousHeadersByArea($id_get,$id_ev);
                if ($headers) {
                    print_r(json_encode($headers, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                } else {
                    print_r(json_encode([
                        "sEcho" => 1,
                        "iTotalRecords" => 0,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => []
                    ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                }
                break;
            case 'create':
                if (!$fecha || !$idArea || !$idAC) {
                    print_r(json_encode([
                        "success" => false,
                        "mensaje" => "¡Debe ingresar todos los datos!"
                    ]));
                } else {
                    $header = $hm->createrHeader($fecha, $idArea, $idAC);
                    if ($header[0]["resultado"] == 1) {
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Evaluacion agregada correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    } else {
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡Ocurrio un error!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'get':
                if ($id_get) {
                    $header = $hm->getrHeaderById($id_get);
                    if ($header) {
                        print_r(json_encode([
                            "success" => true,
                            "encabezado" => $header
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    } else {
                        print_r(json_encode([
                            "success" => false,
                            "encabezado" => []
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'update':
                if (!$fecha || !$idArea || !$idAC || !$id_post) {
                    print_r(json_encode([
                        "success" => false,
                        "mensaje" => "¡Debe ingresar todos los datos!"
                    ]));
                } else {
                    $header = $hm->updaterHeader($fecha, $idArea, $idAC, $id_post);
                    if ($header[0]["resultado"] == 1) {
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Evaluacion actualizado correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    } else {
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡Esa evaluacion ya existe!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'updateStatus':
                if (!$id_get) {
                    print_r(json_encode([
                        "success" => false,
                        "mensaje" => "¡Debe ingresar todos los datos!"
                    ]));
                } else {
                    $header = $hm->updaterHeaderStatus($status, $id_get);
                    if ($header[0]["resultado"] == 1) {
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Evaluacion actualizada correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    } else {
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡Ha ocurrido un error!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
            case 'delete':
                if ($id_get) {
                    $header = $hm->deleterHeader($id_get);
                    if ($header) {
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Evaluador eliminado correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    } else {
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡Hubo un problhma al eiliminar el evaluador!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
                case 'delete':
                if ($id_get) {
                    $header = $hm->deleterHeader($id_get);
                    if ($header) {
                        print_r(json_encode([
                            "success" => true,
                            "mensaje" => "¡Evaluador eliminado correctamente!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    } else {
                        print_r(json_encode([
                            "success" => false,
                            "mensaje" => "¡Hubo un problhma al eiliminar el evaluador!",
                        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    }
                }
                break;
                case 'resume':
                    $details = $hm->validateCalc($id_get);
                    if ($details) {
                      print_r(json_encode($details, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
                    } else {
                      print_r(json_encode([
                        "sEcho" => 1,
                        "iTotalRecords" => 0,
                        "iTotalDisplayRecords" => 0,
                        "aaData" => []
                      ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
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
