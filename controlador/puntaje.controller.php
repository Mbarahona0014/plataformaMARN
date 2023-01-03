<?php
// Importamos los archivos de helpers y modelos
require_once '../modelo/puntaje.class.php';
require_once '../helpers/helper.class.php';
// Instanciamos la clase Point
$sm = new Point();
$hlp = new Helper();
// Validamos si existe peticion ajax y si es verdadero
if (isset($_POST) || isset($_GET)) {
  // Variables de peticion ajax
  $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;
  // Parametros de peticion ajax
  /* $nombre = isset($_POST['nombre']) ? $hlp->clear($_POST['nombre']) : false; */
  $desc = isset($_POST['ptsDesc']) ? $hlp->clear($_POST['ptsDesc']) : false;
  $id_tema = isset($_POST['id_tema']) ? (int)$hlp->clear($_POST['id_tema']) : false;
  $id_post = isset($_POST['id_puntaje']) ? (int)$hlp->clear($_POST['id_puntaje']) : false;
  $pts_post = isset($_POST['pts']) ? (int)$hlp->clear($_POST['pts']) : false;
  /* $id_get = isset($_GET['id']) ? (int)$hlp->clear($_GET['id']) : false; */
  $pts = isset($_GET['pts']) ? (int)$hlp->clear($_GET['pts']) : false;
  $idt = isset($_GET['idt']) ? (int)$hlp->clear($_GET['idt']) : false;
  // Switch para validar la acción a realizar
  if ($accion) {
    switch ($accion) {
      /* case 'list':
        // Validamos si hay data
        $scopes = $sm->getScopes();
        // Verificamos que todo esté correcto
        if ($scopes) {
          print_r(json_encode($scopes, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          print_r(json_encode([
            "sEcho" => 1,
            "iTotalRecords" => 0,
            "iTotalDisplayRecords" => 0,
            "aaData" => []
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }
        break; */
      case 'create':
        // Validamos datos
        if (!$desc) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar todos los datos!"
          ]));
        } else {
          $point = $sm->createPoint($pts_post,$desc,$id_tema);
          // Verificamos que todo esté correcto
          if ($point[0]["resultado"] == 1) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Puntaje agregado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡El puntaje ya existe!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'get':
        if ($id_get) {
          // Verificamos que todo esté correcto
          $point = $sm->getPointById($id_get);
          if ($point) {
            print_r(json_encode([
              "success" => true,
              "puntaje" => $point
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "puntaje" => []
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
        case 'getPts':
            if ($pts || $idt) {
              // Verificamos que todo esté correcto
              $point = $sm->getPointByPtj($pts,$idt);
              if ($point) {
                print_r(json_encode([
                  "success" => true,
                  "puntaje" => $point
                ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
              } else {
                print_r(json_encode([
                  "success" => false,
                  "puntaje" => []
                ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
              }
            }
            break;
      case 'update':
        // Validamos datos
        if (!$desc || !$id_post) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar todos los datos!"
          ]));
        } else {
          $point = $sm->updatePoint($pts_post, $desc,$id_post,$id_tema);
          // Verificamos que todo esté correcto
          if ($point[0]["resultado"] == 1) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Puntaje actualizado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡El puntaje ya existe!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      /* case 'delete':
        if ($id_get) {
          // Verificamos que todo esté correcto
          $point = $sm->deleteScope($id_get);
          if ($point) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Ámbito eliminado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡Hubo un problema al eliminar el ámbito!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break; */
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