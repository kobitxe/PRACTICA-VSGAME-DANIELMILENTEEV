 <?php 
 
 require_once __DIR__ . "/../models/Users.php";
 require_once __DIR__ . '/../vendor/autoload.php';
 require_once __DIR__ . '/../config/config.php';

 use PHPMailer\PHPMailer\PHPMailer; 

 Class UserController {

    public function userList() {

       
        include __DIR__ . "/../views/Users/users.php";

    }

    public function mostrarUsuarios() {

        $userBD = new UsuarioBD();
        $userBD->obtenerUsuarios();

    }

    public function anyadir_usuario() {
        
        include __DIR__ . "/../views/Users/userAdd.php";

    }

    public function procesar_anyadir_usuario() {

        if (!empty($_POST['nickname']) && !empty($_POST['password']) && !empty($_POST['email']) && isset($_FILES['img']) && $_FILES['img']['error'] == UPLOAD_ERR_OK) {
        
            $nickname = $_POST['nickname'];
            $password = md5($_POST['password']); 
            $email = $_POST['email'];

            $ruta_temporal = $_FILES['img']['tmp_name'];
            $nombre_imagen = basename($_FILES['img']['name']);
            $ruta_final = 'C:/wamp64/www/DAW/VSGAME-MVC-DANIELMILENTEEV/admin/views/Users/uploads/imagenes/' . $nombre_imagen;
            
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
                header ("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=User&action=userList&mensaje=Error al añadir usuario");
                exit;
            }
        } 
        
        else {
            echo "Todos los campos son obligatorios.";
            echo '<a href="userAdd.html">Volver a añadir</a>';
        }

    }

    public function borrar_usuario() {
        $userBD = new UsuarioBD();
        $userBD->EliminarUsuario($_GET['id']);
    }

    public function editar_usuario() {

        include __DIR__ . "/../views/Users/userEdit.php";
       
    }

    public function procesar_editar_usuario() {

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $id = $_POST['id']; 
            $nickname = $_POST['new_nickname'];  
            $email = $_POST['new_email'];  
            $password = md5($_POST['new_password']);  
            
            //Si hay imagen nueva al editar se sube a uploads.

            if ($_FILES['new_img']['name'] != "") {
                
                $ruta_temporal = $_FILES['new_img']['tmp_name']; 
                $imagen = basename($_FILES['new_img']['name']); 
                $ruta_final = 'C:/wamp64/www/DAW/VSGAME-MVC-DANIELMILENTEEV/admin/views/Users/uploads/imagenes/' . $imagen; 
                move_uploaded_file($ruta_temporal, $ruta_final);
        
            }

            //Si la imagen no cambia se queda la que ya estaba.

            else {
                $imagen = $_POST['old_img'];
            }

            $usuariodb = new UsuarioBD();
            $update = $usuariodb->ActualizarUsuario($nickname, $email, $id, $password, $imagen);
                
            if ($update) {
                header ("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=User&action=userList&id=". $id . "&mensaje=Carta actualizada correctamente.");
                exit;
            }
            else {
                header ("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=User&action=userList&id=". $id . "&mensaje=Error al actualizar el usuario.");
                exit;
            }


            if (empty($nickname) || empty($email)) {
                echo 'No se permiten campos vacíos. Completa todos los campos.';
                echo '<a href="userEdit.php">Volver a editar</a>';
                exit;
            }

        }
    }
    
    public function mostraruserporID($id) {

        $userBD = new UsuarioBD();
        $usuario_encontrado = $userBD->obtenerUsuarioPorID($id);

        if ($usuario_encontrado) {

                echo '<h2>Usuario con ID ' . $usuario_encontrado['id'] . '</h2>';
                if(isset($_GET['mensaje_error'])){echo "<a>" . $_GET['mensaje_error'] . "</a>";}
                echo '<form action="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=User&action=procesar_editar_usuario&id=' . $usuario_encontrado['id'] . ' " method="POST" enctype="multipart/form-data">'; 

                //DATOS NECESARIOS PERO OCULTOS AL USER                    
                echo '<input type="hidden" name="id" value="' . $usuario_encontrado['id'] . '">';
                echo '<input type="hidden" name="old_img" value="' . $usuario_encontrado['img'] . '">';

                echo '<label for="new_nombre">Nombre:</label> ';
                echo '<input type="text" id="new_nickname" name="new_nickname" value="' . $usuario_encontrado['nickname'] . '">';

                echo '<label for="new_ataque">Email:</label> ';
                echo '<input type="text" id="new_email" name="new_email" value="' . $usuario_encontrado['email'] . '">';

                echo '<label for="new_defensa">Contraseña:</label> ';
                echo '<input type="text" id="new_password" name="new_password" value="' . $usuario_encontrado['password'] . '">';

                echo '<label for="img">Imagen:</label> ';
                echo '<input type="file" id="img" name="new_img" accept="image/*">';

                echo '<br><br><img height="200px" src="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/views/Users/uploads/imagenes/' . $usuario_encontrado['img'] . '">';

                echo '<br><br> <button type="submit">Aplicar cambios</button>';
                echo '</form>';

                } 
                    
                else {
                    echo '<p>Usuario no encontrado.</p>';
                    echo '<a href="userEdit.php">Editar otro usuario</a>';
                }
    }
}
?>