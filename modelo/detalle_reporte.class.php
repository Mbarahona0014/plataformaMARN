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

  public function getDetailsById($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $details = [];
    // Consulta
    $sql = "SELECT * FROM detalle_reporte a WHERE a.id = :n1;";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $details = $stmt->fetch();
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

  public function updateDetail($evi, $obser, $idTema, $idAmbito, $idPuntaje, $id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $update = false;
    // Consulta
    $sql = "UPDATE detalle_reporte SET evidencia = :n1, observaciones = :n2, id_tema = :n3, id_ambito = :n4, id_puntaje = :n5 WHERE id = :n6;";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $evi, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $obser, PDO::PARAM_STR);
      $stmt->bindParam(':n3', $idTema, PDO::PARAM_INT);
      $stmt->bindParam(':n4', $idAmbito, PDO::PARAM_INT);
      $stmt->bindParam(':n5', $idPuntaje, PDO::PARAM_INT);
      $stmt->bindParam(':n6', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $update = true;
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $update;
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

  public function getFileById($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $file = [];
    // Consulta
    $sql = "SELECT * FROM archivos_evaluacion a WHERE a.id = :n1;";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $file = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $file;
  }

  public function deleteFile($name_file)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $delete = false;
    // Consulta
    $sql = "DELETE FROM archivos_evaluacion WHERE archivo = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $name_file, PDO::PARAM_STR);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $delete = true;
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $delete;
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

  public function getCalcHistory($id_en)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $details = [];
    // Consulta<
    $sql = "SELECT
    evaluacion.nombre_ambito ambito,
		ROUND(evaluacion.peso_ambito,2) peso,
		ROUND(evaluacion.puntaje_ucg,2) puntajeucg ,
    ROUND(SUM(evaluacion.puntaje_anp),2) puntajeanp,
    ROUND((evaluacion.puntaje_ucg-(SUM(evaluacion.puntaje_anp))),2) diferencia,
    ROUND((SUM(evaluacion.puntaje_anp)/evaluacion.puntaje_ucg)*100,2) porcentaje
    FROM (SELECT * FROM historico_anp WHERE id_encabezado=:n1) AS evaluacion
    GROUP BY evaluacion.nombre_ambito, evaluacion.peso_ambito, evaluacion.puntaje_ucg";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      $stmt->bindParam(':n1', $id_en, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $details["data"] = $stmt->fetchAll();
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

  public function getScaleHistory($id_en)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $details = [];
    // Consulta
    $sql = "SELECT
    evaluacion.nombre_ambito ambito,
    ROUND((SUM(evaluacion.puntaje_anp)/evaluacion.puntaje_ucg)*1000,2) indicador
    FROM (SELECT * FROM historico_anp WHERE id_encabezado=:n1) AS evaluacion
    GROUP BY evaluacion.nombre_ambito, evaluacion.puntaje_ucg";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      $stmt->bindParam(':n1', $id_en, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $details["data"] = $stmt->fetchAll();
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

  public function getGeneralScale($id_en){
    // Obtenemos la conexion
    global $con;
    // Consulta<
    $sql = "SELECT ROUND(SUM(evaluacion.puntaje_anp),2) puntajeanp
    FROM (SELECT * FROM historico_anp WHERE id_encabezado=:n1) AS evaluacion";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      $stmt->bindParam(':n1', $id_en, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $general = $stmt->fetch();
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $general["puntajeanp"];
  }

  public function getAnterior($id_en, $id_ap)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $id = "";
    // Consulta
    $sql = "SELECT MAX(a.id) id FROM encabezado_reporte a WHERE a.id < :n1 AND a.id_area_natural = :n2 AND a.estado = 3;";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      $stmt->bindParam(':n1', $id_en, PDO::PARAM_INT);
      $stmt->bindParam(':n2', $id_ap, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $id = $stmt->fetch();
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $id["id"];
  }

  public function getYear($id_en)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $anio = "";
    // Consulta
    $sql = "SELECT YEAR(a.fecha_evaluacion) anio FROM encabezado_reporte a WHERE a.id = :n1;";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      $stmt->bindParam(':n1', $id_en, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $anio = $stmt->fetch();
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $anio["anio"];
  }

  public function getAnteriores($id_ap, $anio)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $ids = [];
    // Valores
    $anioExacto = (int)$anio - 1;
    $anioAtras = (int)$anio - 5;
    // Consulta
    $sql = "SELECT a.id FROM encabezado_reporte a
    WHERE (YEAR(a.fecha_evaluacion) BETWEEN :n1 AND :n2)
    AND a.id_area_natural = :n3 AND a.estado = 3 ORDER BY a.id ASC LIMIT 5;";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      $stmt->bindParam(':n1', $anioAtras, PDO::PARAM_INT);
      $stmt->bindParam(':n2', $anioExacto, PDO::PARAM_INT);
      $stmt->bindParam(':n3', $id_ap, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $ids = $stmt->fetchAll();
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $ids;
  }

  //METODOS DE LEGADO PARA CALCULO DE CALIFACIONES, PODRIAN SERVIR PARA VISTA PREVIA

  public function getCalc($id_en)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $details = [];
    // Consulta<
    $sql = "SELECT
    evaluacion.nombreAmbito ambito,
		ROUND(evaluacion.pesoAmbito,2) peso,
		ROUND(evaluacion.puntajeUCG,2) puntajeucg ,
    ROUND(SUM(evaluacion.puntajeAnp),2) puntajeanp,
    ROUND((evaluacion.puntajeUCG-(SUM(evaluacion.puntajeAnp))),2) diferencia,
    ROUND((SUM(evaluacion.puntajeAnp)/evaluacion.puntajeUCG)*100,2) porcentaje
    FROM (SELECT
    			dr.id_ambito ambito,
    			(SELECT a.nombre FROM ambito a WHERE a.id=dr.id_ambito) nombreAmbito,
    			(SELECT a.peso FROM ambito a WHERE a.id=dr.id_ambito) pesoAmbito,
    			@sumaPesoFactor := (SELECT SUM(t.peso) FROM tema t WHERE t.id_factor=(SELECT f.id FROM tema t INNER JOIN factor f ON t.id_factor=f.id WHERE t.id=dr.id_tema)) sumaPesoFactor,
    			@puntaje:= (SELECT p.puntaje FROM puntaje p WHERE p.id=dr.id_puntaje) puntaje,
    			@pesoFactor:= (SELECT f.peso FROM tema t INNER JOIN factor f ON t.id_factor=f.id WHERE t.id=dr.id_tema) pesoFactor,
          @puntajeUCG:= (((SELECT a.peso FROM ambito a WHERE a.id=dr.id_ambito)/(SELECT SUM(peso) FROM ambito))*1000) puntajeUCG,
          @totalPesoFactor:= (SELECT SUM(f.peso) from factor f WHERE f.id IN (SELECT id_factor FROM tema WHERE id_ambito=dr.id_ambito)) totalPesoFactor,
          @puntajeFactor := ((@pesoFactor*@puntajeUCG)/@totalPesoFactor) puntajeFactor,
          @pesoIndicador := (SELECT t.peso FROM tema t WHERE t.id=dr.id_tema) pesoIndicador,
          @puntajeIndicador := (@pesoIndicador*@puntajeFactor)/@sumaPesoFactor puntajeIndicador,
          @pesoAnp:= ((@puntaje-1)*0.25)*@pesoIndicador pesoAnp,
          @puntajeAnp:= (@pesoAnp*@puntajeIndicador)/@pesoIndicador puntajeAnp
          FROM detalle_reporte dr
          WHERE dr.id_encabezado=:n1) AS evaluacion
    GROUP BY evaluacion.ambito";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      $stmt->bindParam(':n1', $id_en, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $details["data"] = $stmt->fetchAll();
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

  public function getScale($id_en)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $details = [];
    // Consulta
    $sql = "SELECT
    evaluacion.nombreAmbito ambito,
    ROUND((SUM(evaluacion.puntajeAnp)/evaluacion.puntajeUCG)*1000,2) indicador
    FROM (SELECT
    			dr.id_ambito ambito,
    			(SELECT a.nombre FROM ambito a WHERE a.id=dr.id_ambito) nombreAmbito,
    			(SELECT a.peso FROM ambito a WHERE a.id=dr.id_ambito) pesoAmbito,
    			@sumaPesoFactor := (SELECT SUM(t.peso) FROM tema t WHERE t.id_factor=(SELECT f.id FROM tema t INNER JOIN factor f ON t.id_factor=f.id WHERE t.id=dr.id_tema)) sumaPesoFactor,
    			@puntaje:= (SELECT p.puntaje FROM puntaje p WHERE p.id=dr.id_puntaje) puntaje,
    			@pesoFactor:= (SELECT f.peso FROM tema t INNER JOIN factor f ON t.id_factor=f.id WHERE t.id=dr.id_tema) pesoFactor,
          @puntajeUCG:= (((SELECT a.peso FROM ambito a WHERE a.id=dr.id_ambito)/(SELECT SUM(peso) FROM ambito))*1000) puntajeUCG,
          @totalPesoFactor:= (SELECT SUM(f.peso) from factor f WHERE f.id IN (SELECT id_factor FROM tema WHERE id_ambito=dr.id_ambito)) totalPesoFactor,
          @puntajeFactor := ((@pesoFactor*@puntajeUCG)/@totalPesoFactor) puntajeFactor,
          @pesoIndicador := (SELECT t.peso FROM tema t WHERE t.id=dr.id_tema) pesoIndicador,
          @puntajeIndicador := (@pesoIndicador*@puntajeFactor)/@sumaPesoFactor puntajeIndicador,
          @pesoAnp:= ((@puntaje-1)*0.25)*@pesoIndicador pesoAnp,
          @puntajeAnp:= (@pesoAnp*@puntajeIndicador)/@pesoIndicador puntajeAnp
          FROM detalle_reporte dr
          WHERE dr.id_encabezado=:n1) AS evaluacion
    GROUP BY evaluacion.ambito";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      $stmt->bindParam(':n1', $id_en, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $details["data"] = $stmt->fetchAll();
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
