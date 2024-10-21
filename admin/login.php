<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/admin.css"> <!-- Archivo CSS externo -->
</head>
<body>
    <div class="login-container">

        <form action="login_action.php" method="POST" class="login-form">
            
            <h2>Iniciar Sesión</h2>
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <input type="checkbox" name="remember">
            <label>Recordar contraseña</label>

            <button type="submit">Entrar</button>
            
        </form>
    </div>
</body>
</html>
