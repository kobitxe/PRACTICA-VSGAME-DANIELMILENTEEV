<?php 

require_once '../../models/UsuarioBD.php';

use PHPMailer\PHPMailer\PHPMailer; 

require_once './../../vendor/autoload.php';

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
        $result = $userdb->insertarUsuario($nickname, $email, $password, $nombre_imagen);
        
        if($result) {

            $phpmailer = new PHPMailer();
            $phpmailer->isSMTP();
            $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 2525;
            $phpmailer->Username = '839a1920f7f515';
            $phpmailer->Password = '2d2bf2c9eacbe4';
            $phpmailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;


            $phpmailer->setFrom('info@vsgame.com', 'VSGAME'); 
            $phpmailer->addAddress($email, $nickname); 

            $phpmailer->Subject = 'Gracias por registrarte';
            $phpmailer->Body = file_get_contents('./../mail/registro.php');
            $phpmailer->isHTML(true); 

            $phpmailer->send();

        }

        else {
            header("Location: users.php?mensaje=Error al añadir usuario");
            exit;
        }

        

    } 
    
    else {
        echo "Todos los campos son obligatorios.";
        echo '<a href="userAdd.html">Volver a añadir</a>';
    }
}

?>
