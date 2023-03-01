<?php
// Importamos los archivos necesarios
require_once '../conexion/connection.class.php';
require_once '../modelo/detalle_reporte.class.php';
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
  public function createCord($id_a, $lat, $lon)
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
  public function updateCord($id_a, $lat, $lon, $id)
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

  public function getLastEvaluations()
  {
    global $con;
    $sql = "SELECT
    hanp.id_encabezado id,
    c.lat lat,
    c.lon lon,
    max(er.fecha_evaluacion) fecha,
    (SELECT nombre FROM area_natural WHERE id = er.id_area_natural) area
    FROM historico_anp hanp
    INNER JOIN encabezado_reporte er ON hanp.id_encabezado=er.id
    INNER JOIN coordenadas c ON er.id_area_natural=c.id_anp
    GROUP BY er.id_area_natural, hanp.id_encabezado,c.lat,c.lon";
    $stmt = $con->connect()->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll();
    $con->disconnect();
    return $res;
  }

  public function consultarPoints()
  {
    $dr = new dReport();
    $evas = $this->getLastEvaluations();
    foreach ($evas as $index => $datos) {
      $id = $datos["id"];
      $datosEv = $dr->getGeneralScale($id);
      if ($datosEv < 200) {
        $satisfaccion = "No aceptable";
      } else if ($datosEv >= 200 && $datosEv < 400) {
        $satisfaccion = "Poco aceptable";
      } else if ($datosEv >= 400 && $datosEv < 600) {
        $satisfaccion = "Regular";
      } else if ($datosEv >= 600 && $datosEv < 800) {
        $satisfaccion = "Aceptable";
      } else if ($datosEv > 800) {
        $satisfaccion = "Satisfactorio";
      }
      //var_dump($dr->getGeneralScale([$datos["id"]]));
      $puntos[$id] = array(
        'area' => $datos['area'],
        'fecha' => $datos['fecha'],
        'escala' => $datosEv,
        'lat' => $datos['lat'],
        'lon' => $datos['lon'],
        'satisfaccion' => $satisfaccion
      );
    }
    return $puntos;
  }
}
