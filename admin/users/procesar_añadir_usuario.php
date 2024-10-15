<?php 

require_once '../../models/UsuarioBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if (!empty($_POST['nickname'])||!empty($_POST['password'])||!empty($_POST['email'])) {

    $usuariodb = new UsuarioBD();

    $nickname = $_POST['nickname'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];

    $usuariodb->insertarUsuario($nickname, $email, $password);
    
}

}

?>