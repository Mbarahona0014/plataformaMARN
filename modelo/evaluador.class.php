<?php
require_once '../connection/connection.class.php';
$con = new Connection();

class Evaluator{
    public function getEvaluators(){
        // Obtenemos la conexion
        global $con;
        // Variable para almacenar el resultado de la consulta
        $evaluators = [];
        // Consulta
        $sql = "SELECT * FROM evaluador";
        try {
        // Preparamos la consulta
        $stmt = $con->connect()->prepare($sql);
        // Ejecutamos la consulta
        $stmt->execute();
        // Capturamos el resultado de la consulta
        $evaluators["data"] = $stmt->fetchAll();
        // Cerrar la conexion
        $con->disconnect();
        } catch (PDOException $e) {
        // Cerrar la conexion
        $con->disconnect();
        // Si ocurre un error lo mostramos
        die("Error: " . $e->getMessage());
        }
        // Retornamos el resultado de la consulta
        return $evaluators;
    }
    public function createEvaluator($nom, $apl, $cor, $tel)
    {
        // Obtenemos la conexion
        global $con;
        // Variable para almacenar el resultado de la consulta
        $evaluator = [];
        // Consulta
        $sql = "CALL `agregarEvaluador`(:n1, :n2, :n3, :n4);";
        try {
            // Preparamos la consulta
            $stmt = $con->connect()->prepare($sql);
            // Asignamos valores a los parámetros
            $stmt->bindParam(':n1', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $apl, PDO::PARAM_STR);
            $stmt->bindParam(':n3', $cor, PDO::PARAM_STR);
            $stmt->bindParam(':n4', $tel, PDO::PARAM_STR);
            // Ejecutamos la consulta
            $stmt->execute();
            // Capturamos el resultado de la consulta
            $evaluator = $stmt->fetchAll();
            // Cerrar la conexion
            $con->disconnect();
        } catch (PDOException $e) {
            // Cerrar la conexion
            $con->disconnect();
            // Si ocurre un error lo mostramos
            die("Error: " . $e->getMessage());
        }
        // Retornamos el resultado de la consulta
        return $evaluator;
    }
    public function getEvaluatorById($id)
    {
        // Obtenemos la conexion
        global $con;
        // Variable para almacenar el resultado de la consulta
        $evaluator = [];
        // Consulta
        $sql = "SELECT * FROM evaluador WHERE id = :n1";
        try {
            // Preparamos la consulta
            $stmt = $con->connect()->prepare($sql);
            // Asignamos valores a los parámetros
            $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
            // Ejecutamos la consulta
            $stmt->execute();
            // Capturamos el resultado de la consulta
            $evaluator = $stmt->fetchAll();
            // Cerrar la conexion
            $con->disconnect();
        } catch (PDOException $e) {
            // Cerrar la conexion
            $con->disconnect();
            // Si ocurre un error lo mostramos
            die("Error: " . $e->getMessage());
        }
        // Retornamos el resultado de la consulta
        return $evaluator;
    }
    public function updateEvaluator($nom, $apl, $cor, $tel, $id)
    {
        // Obtenemos la conexion
        global $con;
        // Variable para almacenar el resultado de la consulta
        $evaluator = [];
        // Consulta
        $sql = "CALL `actualizarEvaluador`(:n1, :n2, :n3, :n4, :n5);";
        try {
            // Preparamos la consulta
            $stmt = $con->connect()->prepare($sql);
            // Asignamos valores a los parámetros
            $stmt->bindParam(':n1', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':n2', $apl, PDO::PARAM_STR);
            $stmt->bindParam(':n3', $cor, PDO::PARAM_STR);
            $stmt->bindParam(':n4', $tel, PDO::PARAM_STR);
            $stmt->bindParam(':n5', $id, PDO::PARAM_INT);
            // Ejecutamos la consulta
            $stmt->execute();
            // Capturamos el resultado de la consulta
            $evaluator = $stmt->fetchAll();
            // Cerrar la conexion
            $con->disconnect();
        } catch (PDOException $e) {
            // Cerrar la conexion
            $con->disconnect();
            // Si ocurre un error lo mostramos
            die("Error: " . $e->getMessage());
        }
        // Retornamos el resultado de la consulta
        return $evaluator;
    }
    public function deleteEvaluator($id)
    {
        // Obtenemos la conexion
        global $con;
        // Variable para almacenar el resultado de la consulta
        $evaluator = false;
        // Consulta
        $sql = "DELETE FROM evaluador WHERE id = :n1";
        try {
            // Preparamos la consulta
            $stmt = $con->connect()->prepare($sql);
            // Asignamos valores a los parámetros
            $stmt->bindParam(':n1', $id, PDO::PARAM_INT);
            // Ejecutamos la consulta
            $stmt->execute();
            // Capturamos el resultado de la consulta
            $evaluator = true;
            // Cerrar la conexion
            $con->disconnect();
        } catch (PDOException $e) {
            // Cerrar la conexion
            $con->disconnect();
            // Si ocurre un error lo mostramos
            die("Error: " . $e->getMessage());
        }
            // Retornamos el resultado de la consulta
        return $evaluator;
    }
}
