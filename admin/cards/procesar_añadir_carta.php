<?php 

require_once '../../models/CartasBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (!empty($_POST['nombre']) && !empty($_POST['ataque']) && !empty($_POST['defensa']) && isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
    
        $nombre = $_POST['nombre'];
        $ataque = $_POST['ataque']; 
        $defensa = $_POST['defensa'];
        $poder_especial = $_POST['poder_especial'];

        $ruta_temporal = $_FILES['img']['tmp_name'];
        
        $nombre_imagen = basename($_FILES['img']['name']);
        
        $ruta_final = './uploads/imagenes/' . $nombre_imagen;
        
        move_uploaded_file($ruta_temporal, $ruta_final);

        $cartasDB = new CartasBD();
        $anyadir = $cartasDB->insertarUsuario($nombre, $ataque, $defensa, $poder_especial, $nombre_imagen);
 
        if ($anyadir){
            header ("Location: cards.php?mensaje=Carta insertada correctamente.");
            exit;
        }

        else {
            header ("Location: cards.php?mensaje=Error al insertar carta.");
            exit;
        }
        
    } 
    
    else {
        header ("Location: cardAdd.php?mensaje=Todos los campos son obligatorios, intentelo de nuevo.");
        exit;
    }
}

?>
