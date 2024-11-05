<?php

require_once (__DIR__ . "/config/config.php");

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

                if (isset($_POST['remember'])) {

                    setcookie('usuario', $usuario['nickname'], time() + (86400 * 30), "/"); 
            
                }

                header('Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php');
                exit();

            }

        }
    }

    header('Location: login.php?error=Credenciales incorrectas, intentelo de nuevo.');   

}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = $_POST['username'];
    $password = md5($_POST['password']);

validarLogin($user, $password);

}

?>