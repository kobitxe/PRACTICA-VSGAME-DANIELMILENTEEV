<?php 

require_once(__DIR__ . '/../config/Conexion.php');
class UsuarioBD {
    private $conexion;
    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->get_conexion();
    }

    public function insertarUsuario($nickname, $email, $password, $path) {

        $sql = "INSERT INTO usuarios (nickname, email, password, img) VALUES (:nickname, :email, :password, :img)";
        $stmt = $this->conexion->prepare($sql);
        
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password); 
        $stmt->bindParam(':img', $path); 
        
        if ($stmt->execute()){
            echo "<h2> Usuario insertado correctamente. </h2>";
            echo '<a href="userAdd.html">Volver a la página principal</a>';
            return true;
        }
        else {
            return false;
        }

    }

    public function obtenerUsuarios() {

    $sql = "SELECT * FROM usuarios";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    
    echo '<table border = 1px >';

    echo '<tr>';
    echo '<td> ID </td>';
    echo '<td> NICKNAME </td>';
    echo '<td> EMAIL </td>';
    echo '<td> PASSWORD </td>';
    echo '<td> IMAGEN </td>';
    echo '<td> ACCIONES </td>';
    echo '</tr>';

    foreach ($result as $usuario) {
        
        echo '<tr>';
        echo '<td>' . $usuario['id']. '</td>';
        echo '<td>' . $usuario['nickname']. '</td>';
        echo '<td>' . $usuario['email']. '</td>';
        echo '<td>' . $usuario['password']. '</td>';
        echo '<td><img height ="60px" src=\'./uploads/imagenes/' . $usuario['img']. '\'></td>';
        echo '<td style= "padding: 10px;"> <button onclick="location.href=\'userEdit.php?id='. $usuario['id'].'\'"> Editar </button> <button class="eliminar" onclick="location.href=\'procesar_eliminar_user.php?id=' . $usuario['id'].'\'"> Eliminar </button> </td>';
        echo '</tr>';
    }

    echo '</table>';

    }
    public function ActualizarUsuario($nickname, $email, $id) {

        $sql = "UPDATE usuarios SET nickname = :nickname, email = :email WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        
        $stmt->bindParam(':nickname', $nickname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()){
           header("Location: userEdit.php");
           exit();
        }

        else {
            echo "<h2> Error al editar usuario. </h2>";
            echo '<a href="users.php">Editar otro usuario</a>';
        }
        
    }

    public function EliminarUsuario($id) {

        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        
        if ($stmt->execute()){
           header("Location: users.php");
           exit();
        }
    
        else {
            echo "<h2> Error al eliminar usuario. </h2>";
            echo '<a href="userEdit.php">Eliminar otro usuario</a>';
        }
        
    }

    // Método para obtener un usuario por su ID
    public function obtenerUsuarioPorID($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>