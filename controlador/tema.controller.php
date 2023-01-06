<?php
// Importamos los archivos de helpers y modelos
require_once '../modelo/tema.class.php';
require_once '../modelo/puntaje.class.php';
require_once '../helpers/helper.class.php';
// Instanciamos la clase Topic
$pm = new Point();
$tm = new Topic();
$hlp = new Helper();
// Validamos si existe peticion ajax y si es verdadero
if (isset($_POST) || isset($_GET)) {
  // Variables de peticion ajax
  $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;

  // Parametros de peticion ajax
  $nombre = isset($_POST['nombre']) ? $hlp->clear($_POST['nombre']) : false;
  $desc = isset($_POST['desc']) ? $hlp->clear($_POST['desc']) : false;
  $obser = isset($_POST['obser']) ? $hlp->clear($_POST['obser']) : false;
  $id_ambito = isset($_POST['ambito']) ? $hlp->clear($_POST['ambito']) : false;

  $id_post = isset($_POST['id_tema']) ? (int)$hlp->clear($_POST['id_tema']) : false;
  $id_get = isset($_GET['id']) ? (int)$hlp->clear($_GET['id']) : false;
  $id_en_get = isset($_GET['idEn']) ? (int)$hlp->clear($_GET['idEn']) : false;
  // Switch para validar la acción a realizar
  if ($accion) {
    switch ($accion) {
      case 'list':
        // Validamos si hay data
        $topics = $tm->getTopics();
        // Verificamos que todo esté correcto
        if ($topics) {
          print_r(json_encode($topics, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
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
        if (!$nombre || !$desc || !$obser || !$id_ambito) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar todos los datos!"
          ]));
        } else {
          $topic = $tm->createTopic($nombre, $desc, $obser, $id_ambito);
          // Verificamos que todo esté correcto
          if ($topic[0]["resultado"] == 1) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Tema agregado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡El tema ya existe!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'get':
        if ($id_get) {
          // Verificamos que todo esté correcto
          $topic = $tm->getTopicById($id_get);
          if ($topic) {
            print_r(json_encode([
              "success" => true,
              "tema" => $topic
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "tema" => []
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'getByScope':
        if ($id_get) {
          // Verificamos que todo esté correcto
          $topics = $tm->getTopicByScope($id_get);
          if ($topics) {
            print_r(json_encode([
              "success" => true,
              "temas" => $topics
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "temas" => []
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'getRemainingByScope':
        if ($id_get) {
          // Verificamos que todo esté correcto
          $topics = $tm->getRemainingTopicByScope($id_get,$id_en_get);
          if ($topics) {
            print_r(json_encode([
              "success" => true,
              "temas" => $topics
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "temas" => []
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'getByTopic':
        if ($id_get) {
          // Verificamos que todo esté correcto
          $scores = $tm->getScoresByTopic($id_get);
          if ($scores) {
            print_r(json_encode([
              "success" => true,
              "puntajes" => $scores
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "puntajes" => []
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'update':
        // Validamos datos
        if (!$nombre || !$desc || !$obser || !$id_ambito || !$id_post) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar todos los datos!"
          ]));
        } else {
          $topic = $tm->updateTopic($nombre, $desc, $obser, $id_ambito, $id_post);
          // Verificamos que todo esté correcto
          if ($topic[0]["resultado"] == 1) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Tema actualizado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡El tema ya existe!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          }
        }
        break;
      case 'delete':
        if ($id_get) {
          $pm->deletePoints($id_get);
          // Verificamos que todo esté correcto
          $topic = $tm->deleteTopic($id_get);

          if ($topic) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Tema eliminado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡Hubo un problema al eliminar el tema!",
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
