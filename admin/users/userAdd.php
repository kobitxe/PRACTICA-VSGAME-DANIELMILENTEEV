<?php include './../header.php'; ?>

    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Añadir Usuario</h2>
            <form action="procesar_añadir_usuario.php" method="POST" enctype="multipart/form-data">
                <label for="nickname">Nickname:</label>
                <input type="text" name="nickname" id="nickname" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>

                <label for="img">Imagen:</label>
                <input type="file" name="img" id="img" accept="image/*" required>

                <br><br>

                <button type="submit">Añadir Usuario</button>
            </form>
        </div>
        </section>
    </main>
</body>
</html>
