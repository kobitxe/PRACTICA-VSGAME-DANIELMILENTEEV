<?php 

require_once  __DIR__ . '/../../models/Cards.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {    
    $this->Hacer_PDF();
}

include __DIR__ . '/../header.php';

?>

<main>
        <section class="dashboard-info">
          
            <h2>Listado de cartas</h2>

            <p class="mensaje"><?php if (isset($mensaje)) {echo $mensaje;}?></p>

            <div class="botones-accion">
                <button onclick="window.location.href='http:\/\/127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=Card&action=anyadircarta'">Añadir Carta</button>
                <form method="POST">
                    <button type="submit">Descargar PDF</button>
                </form>
            </div> 

            
        <?php 
        
        $this->mostrarCartas();

        ?>

        <br><br>
        
        </section>
    </main>

<?php include __DIR__ . '/../footer.php'; ?>