<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AÑADIR PERSONAJE</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/> 
</head>


<body>

<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "VSGAME";

$conexion = new mysqli($hostname, $username, $password, $database);

if($conexion->connect_errno) {
    die("Error en la conexión: " . $conexion->connect_error);
}

    $resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $ataque = $_POST['ataque'];
    $defensa = $_POST['defensa'];
    $poder_especial = $_POST['poder_especial'];

    if (empty($nombre) || empty($ataque) || empty($defensa)) {
        $resultado =  "Rellena los campos obligatorios.";
    } else {


    if (empty($poder_especial)) {
        $poder_especial = "null"; 
    } 
    else {
        $poder_especial = "'" . $poder_especial . "'"; 
    }

    $query = "INSERT INTO cartas (nombre, ataque, defensa, poder_especial) 
              VALUES ('$nombre', $ataque, $defensa, $poder_especial)";

    if ($conexion->query($query) === TRUE) {
        $resultado = "Personaje añadido correctamente.";
    } 
    
    else {
        $resultado = $conexion->error;
    }

}

}



?>

    
    <button class = "btn-anyadir-personaje" onclick = "window.location.href='./vsgame.php'"> Volver a la partida </button>
    <div class = "contenedor-grande">

        <form class="formulario" action="anyadir_personaje.php" method="post">
            <h2>Añadir personaje</h2>

            <h3><?php echo $resultado;?></h3>
            
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre"><br><br>
            
            <label for="ataque">Ataque:</label><br>
            <input type="number" id="ataque" name="ataque"><br><br>
            
            <label for="defensa">Defensa:</label><br>
            <input type="number" id="defensa" name="defensa"><br><br>
            
            <label for="poder_especial">Poder Especial:</label><br>
            <input type="text" id="poder_especial" name="poder_especial"><br><br>
            
            <input type="submit" value="Enviar">

        </form>

    </div>




    
</body>
</html>