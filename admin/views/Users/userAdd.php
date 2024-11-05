<?php include __DIR__ . '/../header.php'; ?>

    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Añadir Usuario</h2>
            <form action="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=User&action=procesar_anyadir_usuario" method="POST" enctype="multipart/form-data">
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
    
<?php include __DIR__ . '/../footer.php'; ?>