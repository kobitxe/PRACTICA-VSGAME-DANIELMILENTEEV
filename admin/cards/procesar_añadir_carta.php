<?php 

require_once '../../models/UsuarioBD.php';
require_once '../../config/Conexion.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (!empty($_POST['nombre']) && !empty($_POST['ataque']) && !empty($_POST['defensa']) && isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
    
        $nombre = $_POST['nombre'];
        $ataque = $_POST['ataque']; 
        $defensa = $_POST['defensa'];

        $ruta_temporal = $_FILES['img']['tmp_name'];
        
        $nombre_imagen = basename($_FILES['img']['name']);
        
        $ruta_final = './uploads/imagenes/' . $nombre_imagen;
        
        move_uploaded_file($ruta_temporal, $ruta_final);

        $conexion = new Conexion();
        $con = $conexion->get_conexion();
 
        $sql = "INSERT INTO cartas (nombre, ataque, defensa, img) VALUES (:nombre, :ataque, :defensa, :img)";
        $stmt = $con->prepare($sql);
        
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ataque', $ataque);
        $stmt->bindParam(':defensa', $defensa); 
        $stmt->bindParam(':img', $ruta_final); 
        
        if ($stmt->execute()){
            echo "<h2> Carta insertada correctamente. </h2>";
            echo '<a href="cardAdd.php">Volver a la página principal</a>';
            
        }
        else {
            echo "<h2> Error al insertar carta. </h2>";
            echo '<a href="cardAdd.php">Volver a la página principal</a>';
        }
        
    } 
    
    else {
        echo "Todos los campos son obligatorios.";
        echo '<a href="cardAdd.php">Volver a añadir</a>';
    }
}

?>
