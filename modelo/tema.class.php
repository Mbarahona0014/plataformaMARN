<?php
// Importamos los archivos necesarios
require_once '../conexion/connection.class.php';
// Instanciamos las clases
$con = new Connection();

class Topic
{
  // Método para obtener temas
  public function getTopics()
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $topics = [];
    // Consulta
    $sql = "SELECT * FROM tema";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $topics["data"] = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $topics;
  }
  // Método para crear un tema
  public function createTopic($nom, $descrip, $obser, $id_am)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $topic = [];
    // Consulta
    $sql = "CALL `agregarTema`(:n1, :n2, :n3 , :n4);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $nom, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $descrip, PDO::PARAM_STR);
      $stmt->bindParam(':n3', $obser, PDO::PARAM_STR);
      $stmt->bindParam(':n4', $id_am, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $topic = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $topic;
  }
  // Método para obtener un tema
  public function getTopicById($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $topic = [];
    // Consulta
    $sql = "SELECT * FROM tema WHERE id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $topic = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $topic;
  }
  public function getRemainingTopicByScope($id_am,$id_en){
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $topics = [];
    // Consulta
    $sql = "SELECT * FROM tema WHERE id NOT IN (SELECT id_tema FROM detalle_reporte WHERE id_encabezado = :n2 AND id_ambito= :n1) AND id_ambito= :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id_am, PDO::PARAM_INT);
      $stmt->bindParam(':n2', $id_en, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $topics = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $topics;
  }

  public function getRemainingTopic($id_en){
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $numTopics = 0;
    // Consulta
    $sql = "SELECT COUNT(*) 'pendientes' FROM tema WHERE id NOT IN (SELECT id_tema FROM detalle_reporte WHERE id_encabezado = :n1)";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id_en, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $numTopics = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $numTopics;
  }
  // Método para obtener temas por ámbito
  public function getTopicByScope($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $topics = [];
    // Consulta
    $sql = "SELECT * FROM tema WHERE id_ambito = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $topics = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $topics;
  }
  // Método para obtener pyntajes por tema
  public function getScoresByTopic($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $scores = [];
    // Consulta
    $sql = "SELECT a.id, CONCAT_WS('-', a.puntaje, a.descripcion) puntaje FROM puntaje a WHERE a.id_tema = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $scores = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $scores;
  }
  // Método para actualizar un tema
  public function updateTopic($nom, $descrip, $obser, $id_am, $id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $topic = [];
    // Consulta
    $sql = "CALL `actualizarTema`(:n1, :n2, :n3, :n4, :n5);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $nom, PDO::PARAM_STR);
      $stmt->bindParam(':n2', $descrip, PDO::PARAM_STR);
      $stmt->bindParam(':n3', $obser, PDO::PARAM_STR);
      $stmt->bindParam(':n4', $id_am, PDO::PARAM_INT);
      $stmt->bindParam(':n5', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $topic = $stmt->fetchAll();
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $topic;
  }
  // Método para eliminar un tema
  public function deleteTopic($id)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $topic = false;
    // Consulta
    $sql = "DELETE FROM tema WHERE id = :n1";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
      // Ejecutamos la consulta
      $stmt->execute();
      // Capturamos el resultado de la consulta
      $topic = true;
      // Cerrar la conexion
      $con->disconnect();
    } catch (PDOException $e) {
      // Cerrar la conexion
      $con->disconnect();
      // Si ocurre un error lo mostramos
      die("Error: " . $e->getMessage());
    }
    // Retornamos el resultado de la consulta
    return $topic;
  }
}
