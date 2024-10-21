<?php

require_once (__DIR__ . "/../config/Conexion.php");

session_start();
function validarLogin($email, $password) {

    $conexionDB = new Conexion();
    $conexion = $conexionDB->get_conexion();

    $sql = "SELECT * FROM usuarios";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    
    foreach ($result as $usuario) {
        
        if($usuario["email"] == $email) {

            if ($usuario["password"] == $password) { 
                $_SESSION['usuario'] = $usuario['nickname'];

                if (isset($_POST['remember']) && $_POST['remember'] == 1) {
                    setcookie('usuario', $usuario['nickname'], time() + (86400 * 30), "/"); 
                }

                header('Location: dashboard.php');
                exit();

            }

        }
    }

    echo "Credenciales incorrectas, intentelo de nuevo.";
    echo '<a href="login.php"> Volver a intentar. </a>';

}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $password = md5($_POST['password']);

validarLogin($user, $password);



}

?>