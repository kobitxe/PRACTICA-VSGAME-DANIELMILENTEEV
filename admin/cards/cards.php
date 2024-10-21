

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css"> <!-- Archivo CSS externo -->
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="">Inicio</a></li>
                <li><a href="">Cartas</a></li>
                <li><a href="./cardEdit.php">Editar Cartas</a></li>
                <li><a href="./cardAdd.php">Añadir Cartas</a></li>
                <li><a href="">Configuración</a></li>
                <li><a href="">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
 <main>
        <section class="dashboard-info">
          
            <h2>Listado de cartas</h2>
           
<?php 

require_once (__DIR__ . '/../../config/Conexion.php');

$conn = new Conexion();
$conexion = $conn->get_conexion();

$sql = "SELECT * FROM cartas";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

echo '<table border = 1px>';

echo '<tr>';
echo '<td> ID </td>';
echo '<td> NOMBRE </td>';
echo '<td> ATAQUE </td>';
echo '<td> DEFENSA </td>';
echo '<td> IMAGEN </td>';
echo '<td> EDITAR </td>';
echo '<td> ELIMINAR </td>';
echo '</tr>';

foreach ($result as $carta) {
    
    echo '<tr>';
    echo '<td>' . $carta['id']. '</td>';
    echo '<td>' . $carta['nombre']. '</td>';
    echo '<td>' . $carta['ataque']. '</td>';
    echo '<td>' . $carta['defensa']. '</td>';
    echo '<td><img height="60px" src=\'' . $carta['img']. '\'></td>';
    echo '<td> <button onclick="window.location.href=\'cardEdit.php?id=' . $carta['id'] . '\'"> Editar </button></td>';
    echo '<td> <button onclick="window.location.href=\'procesar_eliminar_carta.php?id=' . $carta['id'] . '\'"> Eliminar </button> </td>';
    echo '</tr>';
}

echo '</table>';

?>

        </section>
    </main>
</body>
</html>
