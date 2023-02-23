<?php
// Importamos los archivos de helpers y modelos
require_once '../modelo/historico.class.php';
require_once '../helpers/helper.class.php';
// Instanciamos la clase Scope
$hm = new Histo();
$hlp = new Helper();
// Validamos si existe peticion ajax y si es verdadero
if (isset($_POST) || isset($_GET)) {
  // Variables de peticion ajax
  $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;
  // Parametros de peticion ajax
  $id_get = isset($_GET['id']) ? (int)$hlp->clear($_GET['id']) : false;
  $id_am  = isset($_GET['id_am']) ? $_GET['id_am'] : 0;
  $n_am   = isset($_GET['n_am']) ? $_GET['n_am'] : 0; 
  $p_am   = isset($_GET['p_am']) ? $_GET['p_am'] : 0;
  $pt     = isset($_GET['pt']) ? $_GET['pt'] : 0;
  $spf    = isset($_GET['spf']) ? $_GET['spf'] : 0;
  $ptucg  = isset($_GET['ptucg']) ? $_GET['ptucg'] : 0;
  $pfa    = isset($_GET['pfa']) ? $_GET['pfa'] : 0;
  $ptfac  = isset($_GET['ptfac']) ? $_GET['ptfac'] : 0;
  $totpf  = isset($_GET['totpf']) ? $_GET['totpf'] : 0;
  $pi     = isset($_GET['pi']) ? $_GET['pi'] : 0;
  $pti    = isset($_GET['pti']) ? $_GET['pti'] : 0;
  $pANP   = isset($_GET['pANP']) ? $_GET['pANP'] : 0;
  $ptANP  = isset($_GET['ptANP']) ? $_GET['ptANP'] : 0;
  // Switch para validar la acción a realizar
  if ($accion) {
    switch ($accion) {
      case 'create':
        // Validamos datos
        if (false) {
          print_r(json_encode([
            "success" => false,
            "mensaje" => "¡Debe ingresar todos los datos!"
          ]));
        } else {
          $his = $hm->create($id_get,$id_am,$n_am,$p_am,$pt,$spf,$ptucg,$pfa,$ptfac,$totpf,$pi,$pti,$pANP,$ptANP);
          // Verificamos que todo esté correcto
          if ($his) {
            print_r(json_encode([
              "success" => true,
              "mensaje" => "¡Historico agregado correctamente!",
            ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
          } else {
            print_r(json_encode([
              "success" => false,
              "mensaje" => "¡Ocurrio un error!",
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
