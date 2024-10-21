<?php
session_start();

if (!isset($_SESSION['usuario'])) {

    if (isset($_COOKIE['usuario'])) {
        
        $_SESSION['usuario'] = $_COOKIE['usuario'];
    } 
    
    else {
       
        header("Location: login.php");
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
    <link rel="stylesheet" href="./assets/css/admin.css"> <!-- Archivo CSS externo -->
</head>
<body>

