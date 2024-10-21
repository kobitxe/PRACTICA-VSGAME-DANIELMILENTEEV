<?php include 'header.php'; ?>

    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Inicio</a></li>
                <li><a href="cartas.php">Cartas</a></li>
                <li><a href="configuracion.php">Configuración</a></li>

            <?php 
                $nombre = $_SESSION["usuario"];
                echo '<li><a href="logout.php?logout=true">Hola '.$nombre.' (Cerrar Sesión)</a></li>';
            ?>
                
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard-info">
            <h2>Información del juego</h2>
            <p>Número total de cartas:
                
        <?php 
        
        

        ?>
        
        </p>
            <p>Configuración actual: <!-- Aquí va la configuración actual --> </p>
        </section>
    </main>

<?php include 'footer.php'; ?>