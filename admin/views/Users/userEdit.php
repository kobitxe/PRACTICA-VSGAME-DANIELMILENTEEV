<?php include __DIR__ . '/../header.php'; ?>
    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Editar Usuario</h2>

            <?php
                
                if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_GET['id'])) {

                    if (isset($_POST['id'])) {
                        $id = $_POST['id'];
                    } 
                    
                    else if (isset($_GET['id'])) {
                        $id = $_GET['id'];
                    }
                
                    $this->mostraruserporID($id);

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
<?php include __DIR__ . '/../footer.php'; ?>
