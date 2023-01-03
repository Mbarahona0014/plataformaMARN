<?php
// Importamos los archivos necesarios
require_once '../conexion/connection.class.php';
// Instanciamos las clases
$con = new Connection();

class Scope
{
  // Método para obtener ámbitos
  public function getScopes()
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $scopes = [];
    // Consulta
    $sql = "SELECT * FROM ambito";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $scopes["data"] = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $scopes;
  }
  // Método para crear un ámbito
  public function createScope($nom, $descrip)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $scope = [];
    // Consulta
    $sql = "CALL `agregarAmbito`(:n1, :n2);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $nom, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $descrip, PDO::PARAM_STR);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $scope = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $scope;
  }
  // Método para obtener un ámbito
  public function getScopeById($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $scope = [];
    // Consulta
    $sql = "SELECT * FROM ambito WHERE id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $scope = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $scope;
  }
  // Método para actualizar un ámbito
  public function updateScope($nom, $descrip, $id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $scope = [];
    // Consulta
    $sql = "CALL `actualizarAmbito`(:n1, :n2, :n3);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $nom, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $descrip, PDO::PARAM_STR);
      $stmt->bindParam(':n3', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $scope = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $scope;
  }
  // Método para eliminar un ámbito
  public function deleteScope($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $scope = false;
    // Consulta
    $sql = "DELETE FROM ambito WHERE id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $scope = true;
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $scope;
  }
}
