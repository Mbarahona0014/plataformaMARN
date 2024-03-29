<?php

require_once '../modelo/detalle_reporte.class.php';
require_once '../helpers/helper.class.php';

$dm = new dReport();
$hlp = new Helper();

if (isset($_POST) || isset($_GET)) {
  $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;

  $id_get = isset($_GET['id']) ? (int)$hlp->clear($_GET['id']) : false;
  $id_ante = isset($_GET['id_ante']) ? (int)$hlp->clear($_GET['id_ante']) : false;
  $id_post = isset($_POST['id_detalle']) ? (int)$hlp->clear($_POST['id_detalle']) : false;

  $idEncabezado = isset($_POST['id_encabezado_detalle']) ? (int)$hlp->clear($_POST['id_encabezado_detalle']) : false;
  $idAmbito = isset($_POST['id_ambito']) ? $hlp->clear($_POST['id_ambito']) : false;
  $idTema = isset($_POST['id_tema']) ? $hlp->clear($_POST['id_tema']) : false;
  $idPuntaje = isset($_POST['id_puntaje']) ? $hlp->clear($_POST['id_puntaje']) : false;
  $obserDeta = isset($_POST['obser_deta']) ? $hlp->clear($_POST['obser_deta']) : false;
  $eviDeta = isset($_POST['evi_deta']) ? $hlp->clear($_POST['evi_deta']) : false;
  /* $imgs = isset($_FILES['files']) ? $_FILES['files'] : false; */
  $idAp = isset($_GET['id_ap']) ? $hlp->clear($_GET['id_ap']) : false;
  $id_detalle_archi = isset($_POST['id_detalle_archi']) ? $hlp->clear($_POST['id_detalle_archi']) : false;

  if ($accion) {
    switch ($accion) {
        //deleteDetail
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
      case 'listFiles':
        $files = $dm->getFilesByDetail($id_get);
        if ($files) {
          print_r(json_encode($files, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
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
          $insert = false;
          if ($detail) {
            $extension = array("jpeg", "jpg", "png", "gif", "doc", "docx", "pdf", "xls", "xlsx");
            $lastId = $dm->getLastId();
            if (!empty($_FILES["files"])) {
              foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
                $file_name = $_FILES["files"]["name"][$key];
                $file_tmp = $_FILES["files"]["tmp_name"][$key];
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                if (in_array($ext, $extension)) {
                  if (!file_exists("../vista/recursos/documents_evaluaciones/" . $file_name)) {
                    $newFileName = time() . $file_name;
                    $fileSave = $dm->saveFile($newFileName, $lastId["id"]);
                    if ($fileSave) {
                      move_uploaded_file($file_tmp = $_FILES["files"]["tmp_name"][$key], "../vista/recursos/documents_evaluaciones/" . $newFileName);
                      $insert = true;
                    }
                  }
                }
              }
            }
            $insert = true;
            if ($insert) {
              print_r(json_encode([
                "success" => true,
                "mensaje" => "¡Detalle agregado correctamente!",
              ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
            } else {
              print_r(json_encode([
                "success" => false,
                "mensaje" => "¡Ocurrio un error al subir archivo!",
              ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
            }
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡Ocurrio un error!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'update':
        if (!$idAmbito || !$idTema || !$idPuntaje || !$obserDeta || !$eviDeta) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar todos los datos!"
          ]));
        } else {
          $detail = $dm->updateDetail($eviDeta, $obserDeta, $idTema, $idAmbito, $idPuntaje, $id_get);
          if ($detail) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Detalle actualizado correctamente!",
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
      case 'getDetailsById':
        if ($id_get) {
          $details = $dm->getDetailsById($id_get);
          if ($details) {
            print_r(json_encode([
              "success" => true,
              "detalle" => $details
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "detalle" => []
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
      case 'delete':
        if ($id_get) {
          $files = $dm->getFilesByDetail($id_get);
          if (!empty($files)) {
            foreach ($files["data"] as $file) {
              if (file_exists("../vista/recursos/documents_evaluaciones/" . $file["archivo"])) {
                unlink("../vista/recursos/documents_evaluaciones/" . $file["archivo"]);
              }
            }
          }
          $detail = $dm->deleteDetail($id_get);
          if ($detail) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Detalle eliminado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡Hubo un problema al eliminar el detalle!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'deleteFile':
        if ($id_get) {
          $file = $dm->getFileById($id_get);
          $nameFile = $file[0]["archivo"];
          $fileDeleted = $dm->deleteFile($nameFile);
          if (file_exists("../vista/recursos/documents_evaluaciones/" . $nameFile)) {
            unlink("../vista/recursos/documents_evaluaciones/" . $nameFile);
          }
          if ($fileDeleted) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Archivo eliminado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡Hubo un problema al eliminar el archivo!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        } else {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Hubo un problema al eliminar el archivo!",
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }
        break;

      case 'createFile':
        $insert = false;
        if (!empty($_FILES["file_nuevo"])) {
          $extension = array("jpeg", "jpg", "png", "gif", "doc", "docx", "pdf", "xls", "xlsx");
          $file_name = $_FILES["file_nuevo"]["name"];
          $file_tmp = $_FILES["file_nuevo"]["tmp_name"];
          $ext = pathinfo($file_name, PATHINFO_EXTENSION);
          if (in_array($ext, $extension)) {
            if (!file_exists("../vista/recursos/documents_evaluaciones/" . $file_name)) {
              $newFileName = time() . $file_name;
              $fileSave = $dm->saveFile($newFileName, $id_detalle_archi);
              if ($fileSave) {
                move_uploaded_file($file_tmp = $_FILES["file_nuevo"]["tmp_name"], "../vista/recursos/documents_evaluaciones/" . $newFileName);
                $insert = true;
              }
            }
          }
          if ($insert) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Archivo agregado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡Ocurrio un error al subir archivo!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        } else {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar un archivo!"
          ]));
        }
        break;
      case 'resumeByHeader':
        $details = $dm->getCalcHistory($id_get);
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
      case 'generalScale':
        $general = $dm->getGeneralScale($id_get);
        if ($general) {
          print_r(json_encode($general, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          print_r(json_encode([
            "sEcho" => 1,
            "iTotalRecords" => 0,
            "iTotalDisplayRecords" => 0,
            "aaData" => []
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }
        break;
      case 'resumeByIndicator':
        $details = $dm->getScaleHistory($id_get);
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
      case 'comparetionByHeaders':
        $idAnte = $dm->getAnterior($id_get, $idAp);
        $detailsAnte = $dm->getCalcHistory($idAnte);
        $detailsActu = $dm->getCalcHistory($id_get);

        $det = [];
        $arrAux = [];

        if (sizeof($detailsAnte["data"]) == 0) {
          foreach ($detailsActu["data"] as $key => $value) {
            $ucg = $value["puntajeucg"];
            $cg = ($value["puntajeanp"] / $ucg) - (0 / $ucg);
            $arrAux = [
              'ambito' => $value["ambito"],
              'ucg' => $value["puntajeucg"],
              'gas1' => 'S/D',
              'gas2' => $value["puntajeanp"],
              'cg' => round($cg*100, 2),
            ];
            array_push($det, $arrAux);
          }
          return print_r(json_encode([
            'data' => $det,
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }

        foreach ($detailsActu["data"] as $key => $value) {
          $ucg = $detailsAnte["data"][$key]["puntajeucg"];
          $cg = ($value["puntajeanp"] / $ucg) - ($detailsAnte["data"][$key]["puntajeanp"] / $ucg);
          $arrAux = [
            'ambito' => $detailsAnte["data"][$key]["ambito"],
            'ucg' => $detailsAnte["data"][$key]["puntajeucg"],
            'gas1' => $detailsAnte["data"][$key]["puntajeanp"],
            'gas2' => $value["puntajeanp"],
            'cg' => round($cg, 2),
          ];
          array_push($det, $arrAux);
        }

        return print_r(json_encode([
          'data' => $det,
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        break;

      case 'comparetionByHeaders2':
        $idEn = $id_get ? $id_get : 0;
        $anio = $id_get ? $dm->getYear($idEn) : 0;
        $ids = $dm->getAnteriores($idAp, $anio);
        $detailsAnte1 = !empty($ids[0]["id"]) ? $dm->getCalcHistory($ids[0]["id"]) : ["data" => []];
        $detailsAnte2 = !empty($ids[1]["id"]) ? $dm->getCalcHistory($ids[1]["id"]) : ["data" => []];
        $detailsAnte3 = !empty($ids[2]["id"]) ? $dm->getCalcHistory($ids[2]["id"]) : ["data" => []];
        $detailsAnte4 = !empty($ids[3]["id"]) ? $dm->getCalcHistory($ids[3]["id"]) : ["data" => []];
        $detailsAnte5 = !empty($ids[4]["id"]) ? $dm->getCalcHistory($ids[4]["id"]) : ["data" => []];
        $detailsActu = $dm->getCalcHistory($id_get);

        $det = [];
        $arrAux = [];

        if (sizeof($detailsActu["data"]) > 0) {
          foreach ($detailsActu["data"] as $key => $value) {
            $arrAux = [
              'ambito' => $value["ambito"],
              'ucg' => $value["puntajeucg"],
              'ga1' => (sizeof($detailsAnte1["data"])) > 0 ? ($detailsAnte1["data"][$key]["puntajeanp"] ? $detailsAnte1["data"][$key]["puntajeanp"] : 'S/D') : 'S/D',
              'ga2' => (sizeof($detailsAnte2["data"])) > 0 ? ($detailsAnte2["data"][$key]["puntajeanp"] ? $detailsAnte2["data"][$key]["puntajeanp"] : 'S/D') : 'S/D',
              'ga3' => (sizeof($detailsAnte3["data"])) > 0 ? ($detailsAnte3["data"][$key]["puntajeanp"] ? $detailsAnte3["data"][$key]["puntajeanp"] : 'S/D') : 'S/D',
              'ga4' => (sizeof($detailsAnte4["data"])) > 0 ? ($detailsAnte4["data"][$key]["puntajeanp"] ? $detailsAnte4["data"][$key]["puntajeanp"] : 'S/D') : 'S/D',
              'ga5' => (sizeof($detailsAnte5["data"])) > 0 ? ($detailsAnte5["data"][$key]["puntajeanp"] ? $detailsAnte5["data"][$key]["puntajeanp"] : 'S/D') : 'S/D',
              'ga6' => $value["puntajeanp"]
            ];
            array_push($det, $arrAux);
          }
        }

        return print_r(json_encode([
          'data' => $det,
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        break;
    }
  }
}
