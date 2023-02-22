<?php
// Importamos los archivos necesarios
require_once '../conexion/connection.class.php';
// Instanciamos las clases
$con = new Connection();
class Histo
{
  // Método para crear un histórico
  public function create($id_enca, $id_ambi, $nombre_ambi, $peso_ambi, $puntaje, $suma_peso_fact, $punta_ucg, $peso_fact, $punta_fact, $tot_peso_fact, $peso_indica, $punta_indica, $peso_anp, $punta_anp)
  {
    // Obtenemos la conexion
    global $con;
    // Variable para almacenar el resultado de la consulta
    $insert = false;
    // Consulta
    $sql = "CALL `insertarHistorico`(:n1, :n2, :n3, :n4, :n5, :n6, :n7, :n8, :n9, :n10, :n11, :n12, :n13, :n14);";
    try {
      // Preparamos la consulta
      $stmt = $con->connect()->prepare($sql);
      // Asignamos valores a los parámetros
      $stmt->bindParam(':n1', $id_enca, PDO::PARAM_INT);
      $stmt->bindParam(':n2', $id_ambi, PDO::PARAM_INT);
      $stmt->bindParam(':n3', $nombre_ambi, PDO::PARAM_STR);
      $stmt->bindParam(':n4', $peso_ambi, PDO::PARAM_STR);
      $stmt->bindParam(':n5', $puntaje, PDO::PARAM_STR);
      $stmt->bindParam(':n6', $suma_peso_fact, PDO::PARAM_STR);
      $stmt->bindParam(':n7', $punta_ucg, PDO::PARAM_STR);
      $stmt->bindParam(':n8', $peso_fact, PDO::PARAM_STR);
      $stmt->bindParam(':n9', $punta_fact, PDO::PARAM_STR);
      $stmt->bindParam(':n10', $tot_peso_fact, PDO::PARAM_STR);
      $stmt->bindParam(':n11', $peso_indica, PDO::PARAM_STR);
      $stmt->bindParam(':n12', $punta_indica, PDO::PARAM_STR);
      $stmt->bindParam(':n13', $peso_anp, PDO::PARAM_STR);
      $stmt->bindParam(':n14', $punta_anp, PDO::PARAM_STR);
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