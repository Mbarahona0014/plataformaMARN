<?php

require_once '../connection/connection.class.php';
// Instanciamos las clases
$con = new Connection();

class dReport
{
  public function getDetails()
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $details = [];
    // Consulta
    $sql = "SELECT
    a.id,
    a.evidencia,
    a.observaciones,
    (SELECT nombre FROM ambito b WHERE b.id = a.id_ambito) ambito,
    (SELECT nombre FROM tema c WHERE c.id = a.id_tema) tema,
    (SELECT CONCAT_WS('-',d.puntaje,d.descripcion) FROM puntaje d WHERE d.id = a.id_puntaje) puntaje
    FROM detalle_reporte a ORDER BY a.id_puntaje ASC;";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $details["data"] = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $details;
  }

  public function getDetailsByHeader($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $details = [];
    // Consulta
    $sql = "SELECT
    a.id,
    a.evidencia,
    a.observaciones,
    (SELECT nombre FROM ambito b WHERE b.id = a.id_ambito) ambito,
    (SELECT nombre FROM tema c WHERE c.id = a.id_tema) tema,
    (SELECT CONCAT_WS('-',d.puntaje,d.descripcion) FROM puntaje d WHERE d.id = a.id_puntaje) puntaje
    FROM detalle_reporte a WHERE a.id_encabezado = :n1 ORDER BY a.id_puntaje ASC;";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $details["data"] = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $details;
  }

  public function createDetail($evi, $obser, $idTema, $idAmbito, $idPuntaje, $idEncabezado)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $insert = false;
    // Consulta
    $sql = "INSERT INTO detalle_reporte
    VALUES
    (NULL, :n1, :n2, :n3, :n4, :n5, :n6);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $evi, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $obser, PDO::PARAM_STR);
      $stmt->bindParam(':n3', $idTema, PDO::PARAM_INT);
      $stmt->bindParam(':n4', $idAmbito, PDO::PARAM_INT);
      $stmt->bindParam(':n5', $idPuntaje, PDO::PARAM_INT);
      $stmt->bindParam(':n6', $idEncabezado, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $insert = true;
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $insert;
  }
}
