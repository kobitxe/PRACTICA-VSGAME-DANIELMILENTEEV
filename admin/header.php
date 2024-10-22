<?php
session_start();

if (!isset($_SESSION['usuario'])) {

    if (isset($_COOKIE['usuario'])) {
        
        $_SESSION['usuario'] = $_COOKIE['usuario'];
    } 
    
    else {
       
        header("Location: http://127.0.0.1/daw/PRACTICA-VSGAME-DANIELMILENTEEV/admin/login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="http://127.0.0.1/daw/PRACTICA-VSGAME-DANIELMILENTEEV/admin/assets/css/admin.css"> 
<body>

<header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="http://127.0.0.1/daw/PRACTICA-VSGAME-DANIELMILENTEEV/admin/dashboard.php">Inicio</a></li>
                <li><a href="http://127.0.0.1/daw/PRACTICA-VSGAME-DANIELMILENTEEV/admin/cards/cards.php">Cartas</a></li>
                <li><a href="http://127.0.0.1/daw/PRACTICA-VSGAME-DANIELMILENTEEV/admin/users/users.php">Usuarios</a></li>
                <li><a href="http://127.0.0.1/daw/PRACTICA-VSGAME-DANIELMILENTEEV/admin/config/config.php">Configuración</a></li>

            <?php 
                $nombre = $_SESSION["usuario"];
                echo '<li><a href="http://127.0.0.1/daw/PRACTICA-VSGAME-DANIELMILENTEEV/admin/logout.php?logout=true">Hola '.$nombre.' (Cerrar Sesión)</a></li>';
            ?>
                
            </ul>
        </nav>
</header>

