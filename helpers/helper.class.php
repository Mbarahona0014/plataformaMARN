<?php

class Helper
{
  // Parámetros de encriptación
  private $method = 'AES-256-CBC';
  private $secretKey = '$M4n3j04r3$4sN4tur4l3s$';
  private $secretIv = '$M4n3j04r3$4sN4tur4l3s$';
  // Método para encriptar
  public function encrypt($string)
  {
    $output = false;
    $key = hash('sha256', $this->secretKey);
    $iv = substr(hash('sha256', $this->secretIv), 0, 16);
    $output = openssl_encrypt($string, $this->method, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
  }
  // Método para desencriptar
  public function decrypt($string)
  {
    $key = hash('sha256', $this->secretKey);
    $iv = substr(hash('sha256', $this->secretIv), 0, 16);
    $output = openssl_decrypt(base64_decode($string), $this->method, $key, 0, $iv);
    return $output;
  }
  // Limpiar Texto
  public function clear($string)
  {
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    return $string;
  }
  // Validar decimales
  public function validateDecimal($string)
  {
    $valid = false;
    if (preg_match('/^[0-9]\d{1,8}(\.\d{1,2})?$/', $string)) {
      $valid = true;
    }
    return $valid;
  }
}
