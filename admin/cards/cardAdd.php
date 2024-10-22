<?php include './../header.php'; ?>

    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Añadir Carta</h2>
            <form action="procesar_añadir_carta.php" method="POST" enctype="multipart/form-data">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>

                <label for="ataque">Ataque:</label>
                <input type="text" name="ataque" id="ataque" required>

                <label for="defensa">Defensa:</label>
                <input type="text" name="defensa" id="defensa" required>

                <label for="img">Imagen:</label>
                <input type="file" name="img" id="img" accept="image/*" required>

                <br><br>

                <button type="submit">Añadir Carta</button>
            </form>
        </div>
        </section>
    </main>
</body>
</html>
