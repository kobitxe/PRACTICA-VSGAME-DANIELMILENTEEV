<?php 

if (!isset($_SESSION['usuario'])) {

    if (isset($_COOKIE['usuario'])) {
        
        $_SESSION['usuario'] = $_COOKIE['usuario'];
    } 
    
}

if(isset($_SESSION['usuario'])) header("Location: http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php");

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="http://127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/assets/css/admin.css"> 

</head>

<body>

    <div class="login-container">

        <form action="login_action.php" method="POST" class="login-form">
            
            <h2>Iniciar Sesión</h2>

            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <div class = "recordar">
                <input type="checkbox" class="recordar-texto" name="remember">
                <label class = "recordar-check">Recordar contraseña</label>
            </div>
            <a><?php if(isset($_GET['error'])){echo $_GET['error'] . "<br><br>";}?></a>

            <button type="submit">Entrar</button>
            
        </form>
    </div>
</body>

</html>
