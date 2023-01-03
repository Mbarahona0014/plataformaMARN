<?php
// Importamos los archivos necesarios
require_once('../conexion/connection.class.php');
// Instanciamos las clases
$con = new Connection();

class User
{
  // Método para verificar el usuario y hacer login
  public function verifyUser($us, $pass)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $user = [];
    try {
      // Preparamos la consulta
      $sql = "SELECT * FROM usuario WHERE usuario = :user AND contrasenia = :pass";
      $stmt = $con->connect()->prepare($sql);
      // Asignamos los valores a la consulta
      $stmt->bindParam(':user', $us, PDO::PARAM_STR);
      $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $user = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $user;
  }
}
