<?php
// Importamos los archivos de helpers y modelos
require_once '../modelo/factor.class.php';
require_once '../helpers/helper.class.php';
// Instanciamos la clase factor
$fm = new Factor();
$hlp = new Helper();
// Validamos si existe peticion ajax y si es verdadero
if (isset($_POST) || isset($_GET)) {
  // Variables de peticion ajax
  $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;
  // Parametros de peticion ajax
  $nombre = isset($_POST['nombre']) ? $hlp->clear($_POST['nombre']) : false;
  $pes = isset($_POST['peso']) ? $hlp->clear($_POST['peso']) : false;
  /* $desc = isset($_POST['desc']) ? $hlp->clear($_POST['desc']) : false; */
  $id_post = isset($_POST['id_factor']) ? (int)$hlp->clear($_POST['id_factor']) : false;
  $id_get = isset($_GET['id']) ? (int)$hlp->clear($_GET['id']) : false;
  // Switch para validar la acción a realizar
  if ($accion) {
    switch ($accion) {
      case 'list':
        // Validamos si hay data
        $factors = $fm->getFactors();
        // Verificamos que todo esté correcto
        if ($factors) {
          print_r(json_encode($factors, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
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
        if (!$nombre || !$pes) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar todos los datos!"
          ]));
        } else {
          $factor = $fm->createFactor($nombre,$pes);
          // Verificamos que todo esté correcto
          if ($factor[0]["resultado"] == 1) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Factor agregado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡El factor ya existe!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'get':
        if ($id_get) {
          // Verificamos que todo esté correcto
          $factor = $fm->getfactorById($id_get);
          if ($factor) {
            print_r(json_encode([
              "success" => true,
              "factor" => $factor
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "factor" => []
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'update':
        // Validamos datos
        if (!$nombre || !$pes || !$id_post) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar todos los datos!"
          ]));
        } else {
          $factor = $fm->updatefactor($nombre,$pes,$id_post);
          // Verificamos que todo esté correcto
          if ($factor[0]["resultado"] == 1) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Factor actualizado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡El factor ya existe!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'delete':
        if ($id_get) {
          // Verificamos que todo esté correcto
          $factor = $fm->deletefactor($id_get);
          if ($factor) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Factor eliminado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡Hubo un problema al eliminar el factor!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
        /* case 'getTotalWeight':
            $weight = $fm->getTotalWeight();
            if ($weight) {
              print_r(json_encode([
                "success" => true,
                "peso" => $weight
              ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
            } else {
              print_r(json_encode([
                "success" => false,
                "peso" => 0
              ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
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
