<?php 

require_once(__DIR__ . '/../config/Conexion.php');
class CartasBD {
    private $conexion;
    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->get_conexion();
    }

    public function insertarUsuario($nombre, $ataque, $defensa, $poder_especial, $nombre_imagen) {

        $sql = "INSERT INTO cartas (nombre, ataque, defensa, poder_especial, img) VALUES (:nombre, :ataque, :defensa, :poder_especial, :img)";
        $stmt = $this->conexion->prepare($sql);
        
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ataque', $ataque);
        $stmt->bindParam(':defensa', $defensa); 
        $stmt->bindParam(':poder_especial', $poder_especial); 
        $stmt->bindParam(':img', $nombre_imagen); 
        $anyadir = $stmt->execute();

        if($anyadir) {
            return true;
        }
        else {
            return false;
        }

    }

    public function obtenerCartas() {

        $sql = "SELECT * FROM cartas";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        
        echo '<table border = 1px>';
        
        echo '<tr>';
        echo '<td> ID </td>';
        echo '<td> NOMBRE </td>';
        echo '<td> ATAQUE </td>';
        echo '<td> DEFENSA </td>';
        echo '<td> PODER ESPECIAL </td>';
        echo '<td> IMAGEN </td>';
        echo '<td> EDITAR </td>';
        echo '<td> ELIMINAR </td>';
        echo '</tr>';
        
        foreach ($result as $carta) {
            
            echo '<tr>';
            echo '<td>' . $carta['id']. '</td>';
            echo '<td>' . $carta['nombre']. '</td>';
            echo '<td>' . $carta['ataque']. '</td>';
            echo '<td>' . $carta['defensa']. '</td>';
            echo '<td>' . $carta['poder_especial']. '</td>';
            echo '<td><img height="60px" src=\'./uploads/imagenes/' . $carta['img']. '\'></td>';
            echo '<td> <button onclick="window.location.href=\'cardEdit.php?id=' . $carta['id'] . '\'"> Editar </button></td>';
            echo '<td> <button class="eliminar" onclick="window.location.href=\'procesar_eliminar_carta.php?id=' . $carta['id'] . '\'"> Eliminar </button> </td>';
            echo '</tr>';
        }
        
        echo '</table>';
    }
    public function ActualizarCarta($id, $nombre, $ataque, $defensa, $poder_especial, $imagen) {
        
        $sql = "UPDATE cartas SET nombre = :nombre, ataque = :ataque, defensa = :defensa, poder_especial = :poder_especial, img = :img WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
            
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':ataque', $ataque);
        $stmt->bindParam(':defensa', $defensa);
        $stmt->bindParam(':img', $imagen);
        $stmt->bindParam(':poder_especial', $poder_especial);
        
            
        if ($stmt->execute()){
            return true;
        }
    
        else {
            return false;
        }


    }

    public function EliminarCarta($id) {

        $sql = "DELETE FROM cartas WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->execute()) {
            return true;
        }

        else {
            return false;   
        }
    }

    // Método para obtener un carta por su ID
    public function obtenerCartaPorID($id) {

        $sql = "SELECT * FROM cartas WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $carta_encontrada = $stmt->fetch(PDO::FETCH_ASSOC);

        return $carta_encontrada;

    }
}
?>