<?php

require_once '../modelo/detalle_reporte.class.php';
require_once '../helpers/helper.class.php';

$dm = new dReport();
$hlp = new Helper();

if (isset($_POST) || isset($_GET)) {
  $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;

  $id_get = isset($_GET['id']) ? (int)$hlp->clear($_GET['id']) : false;
  $id_post = isset($_POST['id_detalle']) ? (int)$hlp->clear($_POST['id_detalle']) : false;

  $idEncabezado = isset($_POST['id_encabezado_detalle']) ? (int)$hlp->clear($_POST['id_encabezado_detalle']) : false;
  $idAmbito = isset($_POST['id_ambito']) ? $hlp->clear($_POST['id_ambito']) : false;
  $idTema = isset($_POST['id_tema']) ? $hlp->clear($_POST['id_tema']) : false;
  $idPuntaje = isset($_POST['id_puntaje']) ? $hlp->clear($_POST['id_puntaje']) : false;
  $obserDeta = isset($_POST['obser_deta']) ? $hlp->clear($_POST['obser_deta']) : false;
  $eviDeta = isset($_POST['evi_deta']) ? $hlp->clear($_POST['evi_deta']) : false;

  if ($accion) {
    switch ($accion) {
      case 'list':
        $details = $dm->getDetails();
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
      case 'create':
        if (!$idEncabezado || !$idAmbito || !$idTema || !$idPuntaje || !$obserDeta || !$eviDeta) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar todos los datos!"
          ]));
        } else {
          $detail = $dm->createDetail($eviDeta, $obserDeta, $idTema, $idAmbito, $idPuntaje, $idEncabezado);
          if ($detail) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Detalle agregado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡Ocurrio un error!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'getByHeader':
        if ($id_get) {
          $details = $dm->getDetailsByHeader($id_get);
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
