<?php 
include './../../models/CartasBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['new_nombre'];  
    $ataque = $_POST['new_ataque'];  
    $defensa = $_POST['new_defensa'];  
    $poder_especial = $_POST['new_poderespecial'];  
    $imagen = $_POST['new_img'];
    $id = $_POST['id']; 

    if (empty($nombre) || empty($ataque) || empty($defensa)) {
        header ("Location: cardEdit.php?id=". $id . "&mensaje_error=Complete todos los campos necesarios.");
        exit;
    }

    $cartasDB = new CartasBD();
    $update = $cartasDB->ActualizarCarta($id, $nombre, $ataque, $defensa, $poder_especial, $imagen);
        
    if ($update) {
        header ("Location: cards.php?mensaje=Carta actualizada correctamente.");
        exit;
    }
    else {
        header ("Location: cardEdit.php?id=". $id . "&mensaje_error=Error al actualizar la carta.");
        exit;
    }

}

?>