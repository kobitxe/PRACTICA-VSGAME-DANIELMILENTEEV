<?php 

require_once(__DIR__ . '/../config/config.php');
class ConfiguracionDB {
    private $conexion;
    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->get_conexion();
    }
    public function mostrarConfiguracion() {

        $sql = "SELECT * FROM conf_juego";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;

    }

}
?>