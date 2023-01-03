<?php

require_once '../conexion/connection.class.php';
// Instanciamos las clases
$con = new Connection();

class headerEvaluator
{
  public function getHeadersEvaluators(){
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $headersEvaluator = [];
    // Consulta
    $sql = "SELECT * FROM evaluador_encabezado";
    try {
    // Preparamos la consulta
    $stmt = $con->connect()->prepare($sql);
    // Ejecutamos la consulta
    $stmt->execute();
    // Capturamos el resultado de la consulta
    $headersEvaluator["data"] = $stmt->fetchAll();
    // Cerrar la conexion
    $con->disconnect();
    } catch (PDOException $e) {
    // Cerrar la conexion
    $con->disconnect();
    // Si ocurre un error lo mostramos
    die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $headersEvaluator;
}

public function getHeadersEvaluatorsNom($idEn){
  // Obtenemos la conexion
  global $con;
  // Variable para almacenar el resultado de la consulta
  $headersEvaluator = [];
  // Consulta
  $sql = "SELECT CONCAT(e.nombres,' ', e.apellidos) 'nombre_completo', ee.id 'id' FROM 
  evaluador_encabezado as ee INNER JOIN evaluador as e ON ee.id_evaluador=e.id 
  WHERE ee.id_encabezado_reporte = :n1 ";
  try {
  // Preparamos la consulta
  $stmt = $con->connect()->prepare($sql);
  $stmt->bindParam(':n1', $idEn, PDO::PARAM_INT);
  // Ejecutamos la consulta
  $stmt->execute();
  // Capturamos el resultado de la consulta
  $headersEvaluator["data"] = $stmt->fetchAll();
  // Cerrar la conexion
  $con->disconnect();
  } catch (PDOException $e) {
  // Cerrar la conexion
  $con->disconnect();
  // Si ocurre un error lo mostramos
  die("Error: " . $e->getMessage());
  }
  // Retornamos el resultado de la consulta
  return $headersEvaluator;
}
  // Método para crear un ámbito
  public function createHeaderEvaluator($idEncabezado, $idEvaluador)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $headerEvaluator = [];
    // Consulta
    $sql = "CALL `agregarEvaluadorEncabezado`(:n1, :n2);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $idEncabezado, PDO::PARAM_INT);
      $stmt->bindParam(':n2', $idEvaluador, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $headerEvaluator = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $headerEvaluator;
  }

  // Método para obtener un ámbito
  public function getheaderEvaluatorById($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $headerEvaluator = [];
    // Consulta
    $sql = "SELECT * FROM evaluador_encabezado WHERE id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $headerEvaluator = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $headerEvaluator;
  }
  // Método para actualizar un ámbito
  public function updateheaderEvaluator($idEncabezado,$idEvaluador,$id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $headerEvaluator = [];
    // Consulta
    $sql = "CALL `actualizarEncabezadoReporte`(:n1, :n2, :n3);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $idEncabezado, PDO::PARAM_INT);
      $stmt->bindParam(':n2', $idEvaluador, PDO::PARAM_INT);
      $stmt->bindParam(':n3', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $headerEvaluator = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $headerEvaluator;
  }
  // Método para eliminar un ámbito
  public function deleteheaderEvaluator($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $headerEvaluator = false;
    // Consulta
    $sql = "DELETE FROM evaluador_encabezado WHERE id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $headerEvaluator = true;
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $headerEvaluator;
  }
  public function deleteheaderEvaluators($id_evaluador)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $headerEvaluator = false;
    // Consulta
    $sql = "DELETE FROM evaluador_encabezado WHERE id_evaluador = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id_evaluador, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $headerEvaluator = true;
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $headerEvaluator;
  }
}