<?php
// Importamos los archivos necesarios
require_once '../connection/connection.class.php';
// Instanciamos las clases
$con = new Connection();

class Area
{
  // Método para obtener áreas
  public function getAreas()
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $areas = [];
    // Consulta
    $sql = "SELECT * FROM area_natural";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $areas["data"] = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $areas;
  }
  // Método para crear una área
  public function createArea($nom, $ubica, $descrip, $obser, $ext)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $area = [];
    // Consulta
    $sql = "CALL `agregarArea`(:n1, :n2, :n3, :n4, :n5);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $nom, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $ubica, PDO::PARAM_STR);
      $stmt->bindParam(':n3', $descrip, PDO::PARAM_STR);
      $stmt->bindParam(':n4', $obser, PDO::PARAM_STR);
      $stmt->bindParam(':n5', $ext, PDO::PARAM_STR);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $area = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $area;
  }
  // Método para obtener una área
  public function getAreaById($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $area = [];
    // Consulta
    $sql = "SELECT * FROM area_natural WHERE id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $area = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $area;
  }
  // Método para actualizar una área
  public function updateArea($nom, $ubica, $descrip, $obser, $ext, $id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $area = [];
    // Consulta
    $sql = "CALL `actualizarArea`(:n1, :n2, :n3, :n4, :n5, :n6);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $nom, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $ubica, PDO::PARAM_STR);
      $stmt->bindParam(':n3', $descrip, PDO::PARAM_STR);
      $stmt->bindParam(':n4', $obser, PDO::PARAM_STR);
      $stmt->bindParam(':n5', $ext, PDO::PARAM_STR);
      $stmt->bindParam(':n6', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $area = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $area;
  }
  // Método para eliminar una área
  public function deleteArea($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $area = false;
    // Consulta
    $sql = "DELETE FROM area_natural WHERE id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $area = true;
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $area;
  }
}
