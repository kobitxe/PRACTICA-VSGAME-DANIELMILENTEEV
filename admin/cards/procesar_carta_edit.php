<?php 
include './../../models/CartasBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id']; 
    $nombre = $_POST['new_nombre'];  
    $ataque = $_POST['new_ataque'];  
    $defensa = $_POST['new_defensa'];  
    $poder_especial = $_POST['new_poderespecial'];  
    
    //Si hay imagen nueva al editar se sube a uploads.

    if ($_FILES['new_img']['name'] != "") {

        $ruta_temporal = $_FILES['new_img']['tmp_name']; 
        $imagen = basename($_FILES['new_img']['name']); 
        $ruta_final = './uploads/imagenes/' . $imagen; 
        move_uploaded_file($ruta_temporal, $ruta_final);
  
    }

    //Si la imagen no cambia se queda la que ya estaba.

    else {
        $imagen = $_POST['old_img'];
    }

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