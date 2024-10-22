<?php 
include './../header.php'; 
include './../../models/CartasBD.php';
?>


<main>
        <section class="dashboard-info">
          
            <h2>Listado de cartas</h2>

            <p><?php if(isset($_GET['mensaje'])){echo $_GET['mensaje'];}?></p>

            <button onclick="window.location.href='cardAdd.php'">Añadir Carta</button>
            <br><br>

        <?php 
        
        $cartasDB = new CartasBD();
        $cartasDB->obtenerCartas();
        
        ?>

        </section>
    </main>
</body>
</html>
