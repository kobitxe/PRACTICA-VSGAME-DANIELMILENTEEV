<?php 
include './../header.php';
include './../../models/CartasBD.php'; 
?>

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
                
                    $cartasDB = new CartasBD();
                    $carta_encontrada = $cartasDB->obtenerCartaPorID($id);

                if ($carta_encontrada) {

                        echo '<h2>Carta con ID ' . $carta_encontrada['id'] . '</h2>';
                        if(isset($_GET['mensaje_error'])){echo "<a>" . $_GET['mensaje_error'] . "</a>";}
                        echo '<form action="procesar_carta_edit.php" method="POST">';
                        echo '<input type="hidden" name="id" value="' . $carta_encontrada['id'] . '">';
                        echo '<input type="hidden" name="old_img" value="' . $carta_encontrada['img'] . '">';
                        echo '<br><br>Nombre: <input type="text" name="new_nombre" value="' . $carta_encontrada['nombre'] . '">';
                        echo ' <br><br>Ataque: <input type="text" name="new_ataque" value="' . $carta_encontrada['ataque'] . '">';
                        echo ' <br><br>Defensa: <input type="text" name="new_defensa" value="' . $carta_encontrada['defensa'] . '">';
                        echo ' <br><br>Poder Especial: <input type="text" name="new_poderespecial" value="' . $carta_encontrada['poder_especial'] . '">';
                        echo '<label for="img">Imagen:</label> ';
                        echo '<input type="file" name="new_img" id="img" accept="image/*">';
                        echo '<br><br><img height=200px src=\'./uploads/imagenes/' . $carta_encontrada['img'] . '\'>';
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
