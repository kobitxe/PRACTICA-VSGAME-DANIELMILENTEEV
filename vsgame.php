<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSGAME</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/> 

</head>

<body>

<?php

include_once 'config/Conexion.php';
include_once 'inc/Carta.php';
include_once 'inc/CartaBase.php';
include_once 'inc/Juego.php';
include_once 'inc/Mazo.php';
include_once 'inc/Jugador.php';

session_start();

$obj_conexion = new Conexion();
$conexion = $obj_conexion->get_conexion();

//Insertar cartas en la BD

    $conexion->query('DELETE FROM cartas WHERE 1');
    $conexion->query('INSERT INTO cartas VALUES (1, "Hola", 10, 20, null)');
    $conexion->query('INSERT INTO cartas VALUES (2, "Hola", 10, 20, null)');
    $conexion->query('INSERT INTO cartas VALUES (3, "Hola", 10, 20, null)');
    $conexion->query('INSERT INTO cartas VALUES (4, "Hola", 10, 20, null)');
    $conexion->query('INSERT INTO cartas VALUES (5, "Hola", 10, 20, null)');
    $conexion->query('INSERT INTO cartas VALUES (6, "Hola", 10, 20, null)');
    $conexion->query('INSERT INTO cartas VALUES (7, "Hola", 10, 20, "Poderduro")');
    $conexion->query('INSERT INTO cartas VALUES (8, "Hola", 10, 20, "Poderduro")');
    $conexion->query('INSERT INTO cartas VALUES (9, "Hola", 10, 20, "Poderduro")');
    $conexion->query('INSERT INTO cartas VALUES (10, "Hola", 10, 20, "Poderduro")');


/*

2) Mostrar todos ordenados por número de ataque descendente

$resultado = $conexion->query('SELECT * FROM cartas ORDER BY ataque DESC');

3) Mostrar sólo las cartas especiales

$resultado = $conexion->query('SELECT * FROM cartas WHERE especial IS NOT NULL');

4) Eliminar las cartas que sean guerreros

$conexion->query('DELETE FROM cartas WHERE tipo = "Guerrero"');

5) Cambiar el título de una carta Guerrero a Mago

$conexion->query('UPDATE cartas SET tipo = "Mago" WHERE tipo = "Guerrero"');

6) Mostrar la configuración almacenada

resultado = $conexion->query('SELECT * FROM configuracion');

while ($fila = $resultado->fetch_assoc()) {
    print_r($fila);
}

*/

//INICIALIZAR JUEGO

$Juego = new Juego(10, 30, 15); 
    $_SESSION['juego'] = $Juego;

// INICIALIZAR JUGADOR Y MAQUINA

if (!isset($_SESSION['jugador']) || !isset($_SESSION['maquina'])) {
    $jugador = new Jugador($Juego, "Jugador");
    $_SESSION['jugador'] = $jugador;

    $maquina = new Jugador($Juego, "Máquina");
    $_SESSION['maquina'] = $maquina;

    $_SESSION['puntosJugador'] = 0;
    $_SESSION['puntosMaquina'] = 0;
    $_SESSION['ronda'] = 0;
} 

else {
    $jugador = $_SESSION['jugador'];
    $maquina = $_SESSION['maquina'];
}

$cartaJugador = $jugador->getMazo()->sacarCarta();
$cartaMaquina = $maquina->getMazo()->sacarCarta();

//CUANDO OCURRE UNA ACCION

if (isset($_GET['accion'])) {

    $accion = $_GET['accion'];

    $_SESSION['ronda']++;

    if ($cartaJugador !== null && $cartaMaquina !== null) {

        if ($accion === 'atacar') {
        
            if ($cartaJugador->getAtaque() > $cartaMaquina->getAtaque()) {
                $_SESSION['puntosJugador']++;
            } 
            
            elseif ($cartaJugador->getAtaque() < $cartaMaquina->getAtaque()) {
                $_SESSION['puntosMaquina']++;
            }

        } 
        
        elseif ($accion === 'defender') {

            if ($cartaJugador->getDefensa() > $cartaMaquina->getDefensa()) {
                $_SESSION['puntosJugador']++;
            } 
            
            elseif ($cartaJugador->getDefensa() < $cartaMaquina->getDefensa()) {
                $_SESSION['puntosMaquina']++;
            }

        }

    }

    //FINAL DEL JUEGO

    if ($jugador->cartasRestantes() == 0 || $maquina->cartasRestantes() == 0) { 

        echo '<style> .pant-juego { display: none; } </style>';
        
        if ($_SESSION['puntosJugador'] > $_SESSION['puntosMaquina']) {
            echo '<div class="resultado"><p> El Jugador ha ganado. </p></div>';
        } 
        
        elseif ($_SESSION['puntosJugador'] < $_SESSION['puntosMaquina']) {
            echo '<div class="resultado"> <p> La Máquina ha ganado. </p> </div>';
        } 
        
        else {
            echo '<div class="resultado"> <p> Nadie gana, EMPATE. </p> </div>';
        }

    }

    //BOTÓN DE REINICIAR

    if ($accion === 'reiniciar') {
        session_destroy();
        header("Location: index.php");
        exit();
    }
    
}

$puntosJugador = $_SESSION['puntosJugador'];
$puntosMaquina = $_SESSION['puntosMaquina'];
$ronda = $_SESSION['ronda'];

?>

<button class = "btn-anyadir-personaje" onclick = "window.location.href='./anyadir_personaje.php'"> Añadir Personaje </button>

<div class = "pant-juego"> 

    <div class="contenedor-padre">
        
        <div class="carta1">
            <p><?php if ($cartaJugador != null) { echo $cartaJugador; } ?></p>
            <img class="carta1" src="<?php echo "img/cards/" . strval(rand(1,30)) . "_card.jpg" ?>">
            
        </div>

        <img src="img/vs.png" style="height: 12vh; margin-top: 150px;">

        <div class="carta2">
            <p><?php  if ($cartaMaquina != null) { echo $cartaMaquina; } ?></p>
            <img class="carta1" src="<?php echo "img/cards/" . strval(rand(1,30)) . "_card.jpg" ?>">
            
        </div>

    </div>

    <form method="get" class="contenedor-botones">

    <button type="submit" class="atacar" id = "accion" name="accion" value="atacar"><img class="atacar" src="img/atacar.png"></button>
    <button type="submit" class="defender" id = "accion" name="accion" value="defender"><img class="defender" src="img/defender.png"></button>

    </form>

</div>

    <form method="get">
        <button type="submit" id="accion" class="reiniciar" name="accion" value="reiniciar"><img class="reiniciar" src="img/restartgame.png"></button>
    </form>

    <div class = "puntuacion">
    <p class = "puntos-jugador"><?php echo $puntosJugador; ?></p>
    <p class = "puntos-maquina"><?php echo $puntosMaquina; ?></p>
    <p class = "ronda"><?php echo $ronda; ?></p>

    <img src="img/score.png">
   
    </div>

    
</body>

</html>