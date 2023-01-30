<?php

require_once '../conexion/connection.class.php';
// Instanciamos las clases
$con = new Connection();

class rHeader
{
  public function getHeaders()
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $headers = [];
    // Consulta
    $sql = "SELECT
    er.id,
    (SELECT nombre FROM area_natural an WHERE an.id=er.id_area_natural) area,
    (SELECT nombre FROM paisaje p WHERE p.id=er.id_area_conservacion) paisaje,
    er.fecha_evaluacion
    FROM encabezado_reporte er";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $headers["data"] = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $headers;
  }

  public function getHeadersByArea($idArea)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $headers = [];
    // Consulta
    $sql = "SELECT
    er.id,
    (SELECT nombre FROM area_natural an WHERE an.id=er.id_area_natural) AREA,
    (SELECT nombre FROM paisaje p WHERE p.id=er.id_area_conservacion) paisaje,
    er.fecha_evaluacion
    FROM encabezado_reporte er
    WHERE er.id_area_natural = :n1 AND er.estado = 1;";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $idArea, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $headers["data"] = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $headers;
  }
  // Método para crear un ámbito
  public function createrHeader($fec, $idArea, $idACon)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $rHeader = [];
    // Consulta
    $sql = "CALL `agregarEncabezadoReporte`(:n1, :n2, :n3);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $fec, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $idArea, PDO::PARAM_INT);
      $stmt->bindParam(':n3', $idACon, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $rHeader = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $rHeader;
  }

  // Método para obtener un ámbito
  public function getrHeaderById($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $rHeader = [];
    // Consulta
    $sql = "SELECT a.id, a.id_area_natural, a.id_area_conservacion , b.nombre, a.fecha_evaluacion
    FROM encabezado_reporte a
    INNER JOIN area_natural b ON a.id_area_natural = b.id
    WHERE a.id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $rHeader = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $rHeader;
  }
  // Método para actualizar un ámbito
  public function updaterHeader($fec, $idArea, $idACon, $id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $rHeader = [];
    // Consulta
    $sql = "CALL `actualizarEncabezadoReporte`(:n1, :n2, :n3, :n4);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $fec, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $idArea, PDO::PARAM_INT);
      $stmt->bindParam(':n3', $idACon, PDO::PARAM_INT);
      $stmt->bindParam(':n4', $id, PDO::PARAM_STR);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $rHeader = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $rHeader;
  }

  public function updaterHeaderStatus($est, $id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $rHeader = [];
    // Consulta
    $sql = "CALL `actualizarEncabezadoEstado`(:n1, :n2);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $est, PDO::PARAM_INT);
      $stmt->bindParam(':n2', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $rHeader = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $rHeader;
  }

  // Método para eliminar un ámbito
  public function deleterHeader($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $rHeader = false;
    // Consulta
    $sql = "DELETE FROM encabezado_reporte WHERE id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $rHeader = true;
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $rHeader;
  }
  public function deleterHeaders($id_area)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $rHeader = false;
    // Consulta
    $sql = "DELETE FROM encabezado_reporte WHERE id_area_natural = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id_area, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $rHeader = true;
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $rHeader;
  }
}
