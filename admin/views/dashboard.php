<?php include 'header.php'; ?>

    <main>
        <section class="dashboard-info">
            <h2>Información del juego</h2>
            <p>Número total de cartas: <?php echo $total_cartas; ?> </p>
            <p>Configuración actual:  </p>
                
            <table>
                
                <tr>
                    <th>Nº Cartas</th>
                    <th>Ataque máximo</th>
                    <th>Defensa máxima</th>
                </tr>
                
                <tr>
        
                <?php 

                echo "<th>" . $num_cartas . "</th>";
                echo "<th>" . $max_ataque . "</th>";
                echo "<th>" . $max_defensa . "</th>";

                ?>

                </tr>

            </table>
        </section>
    </main>

<?php include 'footer.php'; ?>