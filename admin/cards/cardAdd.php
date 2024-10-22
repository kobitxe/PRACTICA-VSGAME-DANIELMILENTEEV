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
                <li><a href="./cardEdit.php">Editar cartas</a></li>
                <li><a href="">Configuración</a></li>
                <li><a href="">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

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
