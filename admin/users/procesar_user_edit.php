<?php 

require_once '../../config/Conexion.php';
require_once '../.././models/UsuarioBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $usuariodb = new UsuarioBD();

    $nickname = $_POST['new_nickname'];  
    $email = $_POST['new_email'];
    $id = $_POST['id']; 

    if (empty($nickname) || empty($email)) {
        echo 'No se permiten campos vacíos. Completa todos los campos.';
        echo '<a href="userEdit.php">Volver a editar</a>';
        exit;
    }

    $usuariodb->ActualizarUsuario($nickname, $email, $id);

}

?>