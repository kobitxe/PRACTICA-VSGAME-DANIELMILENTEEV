<?php 
  
require_once (__DIR__ . '/../../config/Conexion.php');

if (isset($_GET['id'])){

    $conn = new Conexion();
    $conexion = $conn->get_conexion();

    $id = $_GET['id'];

    $sql = "DELETE FROM cartas WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()){
        echo "<h2> Carta borrada correctamente. </h2>";
        echo '<a href="cards.php">Volver al listado de cartas</a>';
        exit();
    }

    else {
        echo "<h2> Error al eliminar usuario. </h2>";
        echo '<a href="userEdit.php">Eliminar otro usuario</a>';
    }

}


        
   
?>