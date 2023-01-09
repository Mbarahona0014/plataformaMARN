<?php
// Importamos los archivos de helpers y modelos
require_once '../modelo/area.class.php';
require_once '../modelo/encabezado_reporte.class.php';
require_once '../helpers/helper.class.php';


// Instanciamos la clase Topic
$hm = new rHeader();
$am = new Area();
$hlp = new Helper();

// Validamos si existe peticion ajax y si es verdadero
if (isset($_POST) || isset($_GET)) {
  // Variables de peticion ajax
  $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;
  // Parametros de peticion ajax
  $nombre = isset($_POST['nombre']) ? $hlp->clear($_POST['nombre']) : false;
  $ubicacion = isset($_POST['ubicacion']) ? $hlp->clear($_POST['ubicacion']) : false;
  $ext = isset($_POST['ext']) ? $hlp->clear($_POST['ext']) : false;
  $desc = isset($_POST['desc']) ? $hlp->clear($_POST['desc']) : false;
  $obser = isset($_POST['obser']) ? $hlp->clear($_POST['obser']) : false;
  $id_post = isset($_POST['id_area']) ? (int)$hlp->clear($_POST['id_area']) : false;
  $id_get = isset($_GET['id']) ? (int)$hlp->clear($_GET['id']) : false;
  // Switch para validar la acción a realizar
  if ($accion) {
    switch ($accion) {
      case 'list':
        // Validamos si hay data
        $areas = $am->getAreas();
        // Verificamos que todo esté correcto
        if ($areas) {
          print_r(json_encode($areas, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          print_r(json_encode([
            "sEcho" => 1,
            "iTotalRecords" => 0,
            "iTotalDisplayRecords" => 0,
            "aaData" => []
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }
        break;
        case 'listC':
          // Validamos si hay data
          $areas = $am->getAreasC();
          // Verificamos que todo esté correcto
          if ($areas) {
            print_r(json_encode($areas, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
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
        // Validamos datos
        if (!$nombre || !$ubicacion || !$ext || !$desc || !$obser) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar todos los datos!"
          ]));
        } elseif (!$hlp->validateDecimal($ext)) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar correctamente la extensión!"
          ]));
        } else {
          $area = $am->createArea($nombre, $ubicacion, $desc, $obser, $ext);
          // Verificamos que todo esté correcto
          if ($area[0]["resultado"] == 1) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Área agregado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡La área ya existe!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'get':
        if ($id_get) {
          // Verificamos que todo esté correcto
          $area = $am->getAreaById($id_get);
          if ($area) {
            print_r(json_encode([
              "success" => true,
              "area" => $area
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "area" => []
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'update':
        // Validamos datos
        if (!$nombre || !$ubicacion || !$ext || !$desc || !$obser || !$id_post) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar todos los datos!"
          ]));
        } elseif (!$hlp->validateDecimal($ext)) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar correctamente la extensión!"
          ]));
        } else {
          $area = $am->updateArea($nombre, $ubicacion, $desc, $obser, $ext, $id_post);
          // Verificamos que todo esté correcto
          if ($area[0]["resultado"] == 1) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Área actualizada correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡La área ya existe!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'delete':
        if ($id_get) {
          $hm->deleterHeaders($id_get);
          // Verificamos que todo esté correcto
          $area = $am->deleteArea($id_get);
          if ($area) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Área eliminada correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡Hubo un problema al eliminar la área!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      default:
        // Si no existe la accion solicitada
        print_r(json_encode([
          'status' => false,
          "mensaje" => "Acción no encontrada",
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        break;
    }
  }
}
