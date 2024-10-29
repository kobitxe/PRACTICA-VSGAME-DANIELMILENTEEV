<?php 
include './../header.php'; 
require_once '../.././models/UsuarioBD.php';
?>

    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Editar Usuario</h2>

            <?php
                

                $usuario_encontrado = null;

                if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['id'])) {

                    if (isset($_POST['id'])) {
                        $id = $_POST['id'];
                    } 
                    
                    else if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                    }
                
                    $userBD = new UsuarioBD();
                    $usuario_encontrado = $userBD->obtenerUsuarioPorID($id);

                if ($usuario_encontrado) {

                    echo '<h2>Usuario con ID ' . $usuario_encontrado['id'] . '</h2>';
                    if(isset($_GET['mensaje_error'])){echo "<a>" . $_GET['mensaje_error'] . "</a>";}
                    echo '<form action="procesar_user_edit.php" method="POST" enctype="multipart/form-data">'; 

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

                    echo '<br><br><img height="200px" src="./uploads/imagenes/' . $usuario_encontrado['img'] . '">';

                    echo '<br><br> <button type="submit">Aplicar cambios</button>';
                    echo '</form>';

                    } 
                    
                    else {
                        echo '<p>Usuario no encontrado.</p>';
                        echo '<a href="userEdit.php">Editar otro usuario</a>';
                    }

                
                }
                else {
            ?>

            <form action="userEdit.php" method="POST">
                Buscar por ID: <input type="text" name="id" required>
                <button type="submit">Buscar</button>
            </form>

            <?php } ?>
           
           </div>
        </section>
    </main>
</body>
</html>
