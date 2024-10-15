<?php

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $password = $_POST['password'];

    if(empty($user) || empty($password)) {
        echo 'Asegurate de rellenar todos los campos. <br>';
        echo '<a href="login.php"> Volver a intentarlo. </a>';
    }

    else if ($user != "admin" || $password != '123') {
        echo '<h3>Usuario o contraseña incorrectos.</h3> <br>';
        echo '<a href="login.php"> Volver a intentarlo. </a>';
    }

    else if ($user == "admin" && $password == '123') {
        header("Location: dashboard.php");
    }


}

?>