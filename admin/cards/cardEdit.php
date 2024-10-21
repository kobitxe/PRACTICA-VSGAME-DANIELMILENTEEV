<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="">Inicio</a></li>
                <li><a href="">Cartas</a></li>
                <li><a href="./cards.php">Cartas</a></li>
                <li><a href="./cardAdd.php">Añadir cartas</a></li>
                <li><a href="">Configuración</a></li>
                <li><a href="">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Editar Carta</h2>

            <?php

                require_once (__DIR__ . '/../../config/Conexion.php');

                $carta_encontrada = null;

                if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['id'])) {

                    if (isset($_POST['id'])) {
                        $id = $_POST['id'];
                    } 
                    
                    else if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                    }
                
                    $conn = new Conexion();
                    $conexion = $conn->get_conexion();

                    $sql = "SELECT * FROM cartas WHERE id = :id";
                    $stmt = $conexion->prepare($sql);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                    $carta_encontrada = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($carta_encontrada) {

                        echo '<h2>Carta con ID ' . $carta_encontrada['id'] . '</h2>';
                        echo '<form action="procesar_carta_edit.php" method="POST">';
                        echo '<input type="hidden" name="id" value="' . $carta_encontrada['id'] . '">';
                        echo '<br><br>Nombre: <input type="text" name="new_nombre" value="' . $carta_encontrada['nombre'] . '">';
                        echo ' <br><br>Ataque: <input type="text" name="new_ataque" value="' . $carta_encontrada['ataque'] . '">';
                        echo ' <br><br>Defensa: <input type="text" name="new_defensa" value="' . $carta_encontrada['defensa'] . '">';
                        echo ' <br><br>Poder Especial: <input type="text" name="new_poderespecial" value="' . $carta_encontrada['poder_especial'] . '">';
                        echo ' <br><br>Ruta de imagen: <input type="text" name="new_img" value="' . $carta_encontrada['img'] . '">';
                        echo '<br><br> <button type="submit">Aplicar cambios</button>';
                        echo '</form>';

                    } 
                    
                    else {
                        echo '<p>Carta no encontrada.</p>';
                        echo '<a href="cardEdit.php">Editar otra carta</a>';
                    }

                
                }
                else {
            ?>

            <form action="cardEdit.php" method="POST">
                Buscar por ID: <input type="text" name="id" required>
                <button type="submit">Buscar</button>
            </form>

            <?php } ?>
           
           </div>
        </section>
    </main>
</body>
</html>
