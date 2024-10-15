<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css"> <!-- Archivo CSS externo -->
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="">Inicio</a></li>
                <li><a href="">Cartas</a></li>
                <li><a href="./users.php">Usuarios</a></li>
                <li><a href="./userAdd.html">Añadir usuarios</a></li>
                <li><a href="">Configuración</a></li>
                <li><a href="">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Editar Usuario</h2>

            <?php
                require_once '../config/config.php';
                require_once '../.././models/UsuarioBD.php';

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
                        echo '<form action="procesar_user_edit.php" method="POST">';
                        echo '<input type="hidden" name="id" value="' . $usuario_encontrado['id'] . '">';
                        echo '<br><br>Nickname: <input type="text" name="new_nickname" value="' . $usuario_encontrado['nickname'] . '">';
                        echo ' <br><br>Email: <input type="text" name="new_email" value="' . $usuario_encontrado['email'] . '">';
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
