<?php 

require_once '../../models/UsuarioBD.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (!empty($_POST['nickname']) && !empty($_POST['password']) && !empty($_POST['email']) && isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
    
        $nickname = $_POST['nickname'];
        $password = md5($_POST['password']); 
        $email = $_POST['email'];

        $ruta_temporal = $_FILES['img']['tmp_name'];
        
        $nombre_imagen = basename($_FILES['img']['name']);
        
        $ruta_final = './uploads/imagenes/' . $nombre_imagen;
        
        move_uploaded_file($ruta_temporal, $ruta_final);
            
        $userdb = new UsuarioBD();
        $result = $userdb->insertarUsuario($nickname, $email, $password, $ruta_final);
        
    } 
    
    else {
        echo "Todos los campos son obligatorios.";
        echo '<a href="userAdd.html">Volver a añadir</a>';
    }
}

?>
