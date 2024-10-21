<?php 

require_once '../../models/UsuarioBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_FILES['img']['error'] == UPLOAD_ERR_INI_SIZE) {
        echo "El archivo supera el tamaño máximo permitido por el servidor.";
        exit();
    }

    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';
    
    if (!empty($_POST['nickname']) && !empty($_POST['password']) && !empty($_POST['email']) && isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
        
        $nickname = $_POST['nickname'];
        $password = md5($_POST['password']); 
        $email = $_POST['email'];

        $imgTmpPath = $_FILES['img']['tmp_name'];
        $imgName = basename($_FILES['img']['name']);
        $imgPath = './uploads/imagenes/' . $imgName;
        
        if (move_uploaded_file($imgTmpPath, $imgPath)) {
            
            $usuariodb = new UsuarioBD();
            $result = $usuariodb->insertarUsuario($nickname, $email, $password, $imgPath);
            
            if ($result) {
                echo "Usuario registrado con éxito.";
                echo '<a href="userAdd.html">Volver a añadir</a>';
            } 
            
            else {
                echo "Error al registrar el usuario.";
            }
        } else {
            echo "Error al subir la imagen.";
        }
        
    } 
    
    else {
        echo "Todos los campos son obligatorios.";
        echo '<a href="userAdd.html">Volver a añadir</a>';
    }
}

?>
