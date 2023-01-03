<?php
// Importamos los archivos de helpers y modelos
require_once '../modelo/usuario.class.php';
require_once '../helpers/helper.class.php';
// Instanciamos la clase User
$um = new User();
$hlp = new Helper();
// Validamos si existe peticion ajax y si es verdadero
if (isset($_POST) || isset($_GET)) {
  // Variables de peticion ajax
  $accion = isset($_GET["accion"]) ? (string)$_GET["accion"] : false;
  // Parametros de peticion ajax
  $user = isset($_POST['user']) ? $hlp->clear($_POST['user']) : false;
  $pass = isset($_POST['pass']) ? $hlp->clear($_POST['pass']) : false;
  $pass = $hlp->encrypt($pass);
  // Switch para validar la acción a realizar
  if ($accion) {
    switch ($accion) {
      case 'login':
        // Validamos si el usuario y contraseña son correctos
        session_start();
        $userDb = $um->verifyUser($user, $pass);
        if ($userDb) {
          $_SESSION['user'] = $userDb;
          print_r(json_encode([
            'status' => true,
            'mensaje' => '¡Bienvenido/a ' . $_SESSION['user'][0]['usuario'] . '!',
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        } else {
          print_r(json_encode([
            'status' => false,
            'mensaje' => '¡Usuario o contraseña incorrectos!',
          ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
        }
        break;
      case 'logout':
        // Cerramos la sesión
        session_start();
        session_destroy();
        print_r(json_encode([
          'status' => true,
          'mensaje' => '¡Sesión cerrada correctamente!',
        ], JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE));
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
