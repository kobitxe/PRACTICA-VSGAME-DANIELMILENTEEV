<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css"> <!-- Archivo CSS externo -->
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="">Inicio</a></li>
                <li><a href="">Cartas</a></li>
                <li><a href="./users.php">Usuarios</a></li>
                <li><a href="./userAdd.html">Añadir usuarios</a></li>
                <li><a href="">Configuración</a></li>
                <li><a href="">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
 <main>
        <section class="dashboard-info">
          
            <h2>Listado de usuarios</h2>
           
<?php

require_once __DIR__ ."/../../models/UsuarioBD.php";

$userBD = new UsuarioBD();

$userBD->obtenerUsuarios();

?>
        </section>
    </main>
</body>
</html>
