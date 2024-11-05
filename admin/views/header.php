<?php
session_start();

if (!isset($_SESSION['usuario'])) {

    if (isset($_COOKIE['usuario'])) {
        
        $_SESSION['usuario'] = $_COOKIE['usuario'];
    } 
    
    else {
       
        header("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/login.php");
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
    <link rel="stylesheet" href="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/assets/css/admin.css"> 
<body>

<header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php">Inicio</a></li>
                <li><a href="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=Card&action=cardList">Cartas</a></li>
                <li><a href="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=User&action=userList">Usuarios</a></li>
                <li><a href="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/">Configuración</a></li>

            <?php 
                $nombre = $_SESSION["usuario"];
                echo '<li><a href="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/logout.php?logout=true">¡Hola, '.$nombre.'! (Cerrar Sesión)</a></li>';
            ?>
                
            </ul>
        </nav>
</header>

