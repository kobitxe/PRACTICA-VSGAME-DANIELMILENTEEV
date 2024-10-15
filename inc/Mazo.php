<?php
class Mazo {
    private $cartas = [];

    public function __construct(Juego $Juego) { 
        $this->generarCartasAleatorias($Juego);
    }

    public function generarCartasAleatorias(Juego $Juego) {


        $this->cartas = $Juego->generarCartasAleatorias(); 

        //ESTABLECER CONFIGURACIÓN TRAS CONEXIÓN CON BD 

        $hostname = "localhost";
        $username = "root";
        $password = "";
        $database = "VSGAME";

        $numCartas = $maxAtaque = $maxDefensa = 0; 

        $conexion = new mysqli($hostname, $username, $password, $database);

        $conexion = mysqli_connect($hostname, $username, $password, $database);

        if($conexion->connect_errno){

        die("Error en la conexión");

        }

        else {

        $sql = "SELECT * from conf_juego";
        $resultado = $conexion->query($sql);
        if($resultado->num_rows > 0){

            while($fila = $resultado->fetch_assoc()){

                $numCartas = $fila['num_cartas']; 
                $maxAtaque = $fila['max_ataque'];
                $maxDefensa = $fila['max_defensa'];  

            }

        }

        $conexion->close(); 

        }
    }

    public function sacarCarta() {
        return array_shift($this->cartas); 
    }


    public function cartasRestantes() {
        return count($this->cartas);
    }
}
?>
