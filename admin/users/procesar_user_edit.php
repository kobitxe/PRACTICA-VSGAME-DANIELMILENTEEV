<?php 

require_once '../../config/Conexion.php';
require_once '../.././models/UsuarioBD.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id']; 
    $nickname = $_POST['new_nickname'];  
    $email = $_POST['new_email'];  
    $password = md5($_POST['new_password']);  
    
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

    $usuariodb = new UsuarioBD();
    $update = $usuariodb->ActualizarUsuario($nickname, $email, $id, $password, $imagen);
        
    if ($update) {
        header ("Location: users.php?mensaje=Carta actualizada correctamente.");
        exit;
    }
    else {
        header ("Location: userEdit.php?id=". $id . "&mensaje_error=Error al actualizar el usuario.");
        exit;
    }


    if (empty($nickname) || empty($email)) {
        echo 'No se permiten campos vacíos. Completa todos los campos.';
        echo '<a href="userEdit.php">Volver a editar</a>';
        exit;
    }

    

}

?>