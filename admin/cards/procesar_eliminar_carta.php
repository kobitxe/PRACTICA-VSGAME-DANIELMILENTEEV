<?php 
include './../../models/CartasBD.php';
  
if (isset($_GET['id'])){

    $id = $_GET['id'];

    $cardDB = new CartasBD();
    $eliminar = $cardDB->EliminarCarta($id);
    
    if ($eliminar){
        header ("Location: cards.php?mensaje=Carta borrada correctamente.");
        exit;
    }

    else {
        header ("Location: cards.php?mensaje=Carta actualizada correctamente.");
        exit;
    }

}
  
?>