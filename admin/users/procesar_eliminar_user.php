<?php 

require_once __DIR__ ."/../../models/UsuarioBD.php";

$userBD = new UsuarioBD();

$userBD->EliminarUsuario($_GET['id']);


?>