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
echo '<td> EDITAR </td>';
echo '<td> ELIMINAR </td>';
echo '</tr>';

foreach ($result as $carta) {
    
    echo '<tr>';
    echo '<td>' . $carta['id']. '</td>';
    echo '<td>' . $carta['nombre']. '</td>';
    echo '<td>' . $carta['ataque']. '</td>';
    echo '<td>' . $carta['defensa']. '</td>';
    echo '<td> <button> Editar </button></td>';
    echo '<td> <button> Eliminar </button> </td>';
    echo '</tr>';
}

echo '</table>';

?>