<?php include './../header.php'; ?>
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
    echo '<td><img height="60px" src=\'./uploads/imagenes/' . $carta['img']. '\'></td>';
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
