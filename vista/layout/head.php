<?php
session_start();
$uri = $_SERVER['REQUEST_URI'];
$urlDividida = explode('/', $uri);
$pagina = end($urlDividida);

if ($pagina == 'login') {
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        header('Location: ../../index');
    }
} else if ($pagina != 'login') {
    if (!isset($_SESSION['user']) && empty($_SESSION['user'])) {
        header('Location: ../../index');
    }
}
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SISTEMA ÁREAS NATURALES</title>

<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="./template/plugins/fontawesome-free/css/all.min.css">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="./template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="./template/dist/css/adminlte.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="./template/plugins/datatables/css/datatables.min.css">