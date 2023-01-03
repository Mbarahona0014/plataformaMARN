<?php

class Connection
{
  // Datos de conexion a la base de datos
  private $host = 'localhost';
  private $user = 'root';
  private $password = '';
  private $db = 'mapas';
  private $charset = 'utf8';
  private $port = '3306';
  private $driver = 'mysql';
  // Opciones de conexión
  private $options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::MYSQL_ATTR_FOUND_ROWS => true
  ];
  // Variable para almacenar la conexión
  private $connection = null;
  // Método para obtener la conexión
  public function connect()
  {
    try {
      // Creamos la conexion
      $this->connection = new PDO(
        $this->driver . ':host=' . $this->host . ';dbname=' . $this->db . ';charset=' . $this->charset . ';port=' . $this->port,
        $this->user,
        $this->password,
        $this->options
      );
      // Activamos el manejo de errores y excepciones de PDO
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // Activamos los arrays asociativos de PDO
      $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      // Si ocurre un error lo mostramos
      die('Connection failed: ' . $e->getMessage());
    }
    // Retornamos la conexión
    return $this->connection;
  }

  // Método para cerrar la conexión
  public function disconnect()
  {
    // Asignamos a la conexión el valor null
    return $this->connection = null;
  }
}

?>