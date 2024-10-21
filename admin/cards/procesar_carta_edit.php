<?php 

require_once '../../config/Conexion.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST['new_nombre'];  
    $ataque = $_POST['new_ataque'];  
    $defensa = $_POST['new_defensa'];  
    $poder_especial = $_POST['new_poderespecial'];  
    $imagen = $_POST['new_img'];
    $id = $_POST['id']; 

    if (empty($nombre) || empty($ataque) || empty($defensa)) {
        echo 'Completa todos los campos necesarios.';
        echo '<a href="cardEdit.php?id=' .$id. '">Volver a editar</a>';
        exit;
    }

    $conn = new Conexion();
    $conexion = $conn->get_conexion();

    $sql = "UPDATE cartas SET nombre = :nombre, ataque = :ataque, defensa = :defensa, poder_especial = :poder_especial, img = :img WHERE id = :id";
    $stmt = $conexion->prepare($sql);
        
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':ataque', $ataque);
    $stmt->bindParam(':defensa', $defensa);
    $stmt->bindParam(':img', $imagen);
    $stmt->bindParam(':poder_especial', $poder_especial);
    
        
    if ($stmt->execute()){
        echo "<h2> Carta editada correctamente. </h2>";
        echo '<a href="cards.php">Editar otra carta</a>';
        exit();
    }

    else {
        echo "<h2> Error al editar carta. </h2>";
        echo '<a href="cards.php">Editar otra carta</a>';
    }
        

}

?>