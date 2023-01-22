<?php

require_once '../conexion/connection.class.php';
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
    a.id_encabezado,
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

  public function getLastId()
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $lastId = [];
    // Consulta
    $sql = "SELECT MAX(a.id) id FROM detalle_reporte a ORDER BY a.id DESC;";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $lastId = $stmt->fetch();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $lastId;
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

  public function saveFile($arch, $id_eva)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $insert = false;
    // Consulta
    $sql = "INSERT INTO archivos_evaluacion
    VALUES
    (NULL, :n1, :n2);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $arch, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $id_eva, PDO::PARAM_INT);
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

  public function getFilesByDetail($idDetail)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $files = [];
    // Consulta
    $sql = "SELECT * FROM archivos_evaluacion a WHERE a.id_detalle = :n1;";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $idDetail, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $files["data"] = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $files;
  }

  public function deleteDetail($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $detail = false;
    // Consulta
    $sql = "DELETE FROM detalle_reporte WHERE id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $detail = true;
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $detail;
  }

  public function getResume($id_en)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $details = [];
    // Consulta<
    $sql = "SELECT 
    a.nombre 'ambito',
    a.peso 'peso',
    ((a.peso/(SELECT SUM(peso) 'total' FROM ambito))*1000) 'puntajeucg',
    sum(p.puntaje) 'total_ambito' 
    FROM detalle_reporte dr 
    INNER JOIN puntaje p ON dr.id_puntaje = p.id
    INNER JOIN ambito a ON dr.id_ambito= a.id 
    WHERE dr.id_encabezado= :n1 
    GROUP by dr.id_ambito";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      $stmt->bindParam(':n1', $id_en, PDO::PARAM_INT);
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
}
