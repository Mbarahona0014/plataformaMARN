<?php
// Importamos los archivos necesarios
require_once '../conexion/connection.class.php';
// Instanciamos las clases
$con = new Connection();

class Cord
{
  // Método para obtener ámbitos
  public function getCords()
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $cord = [];
    // Consulta
    $sql = "SELECT * FROM coordenadas";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $cord["data"] = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $cord;
  }
  // Método para crear un ámbito
  public function createCord($id_a,$lat,$lon)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $cord = [];
    // Consulta
    $sql = "INSERT INTO coordenadas values (null,:n1,:n2,:n3)";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id_a, PDO::PARAM_INT);
      $stmt->bindParam(':n2', $lat, PDO::PARAM_STR);
      $stmt->bindParam(':n3', $lon, PDO::PARAM_STR);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $cord = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
      return true;
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
      return false;
    }
    // Retornamos el resultado de la consulta
  }
  // Método para obtener un ámbito
  public function getCordById($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $cord = [];
    // Consulta
    $sql = "SELECT * FROM coordenadas WHERE id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $cord = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $cord;
  }
  // Método para actualizar un ámbito
  public function updateCord($id_a,$lat,$lon,$id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $cord = [];
    // Consulta
    $sql = "UPDATE coordenadas SET id_anp=:n1, lat=:n2, lon=:n3 WHERE id=:n4";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id_a, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $lat, PDO::PARAM_STR);
      $stmt->bindParam(':n3', $lon, PDO::PARAM_STR);
      $stmt->bindParam(':n4', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $cord = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
      return true;
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
      return false;
    }
    // Retornamos el resultado de la consulta
  }
  // Método para eliminar un ámbito
  public function deleteCord($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $cord = false;
    // Consulta
    $sql = "DELETE FROM coordenadas WHERE id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $cord = true;
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $cord;
  }
}