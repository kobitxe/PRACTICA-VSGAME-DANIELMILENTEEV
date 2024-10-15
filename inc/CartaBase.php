<?php 

Class CartaBase implements Carta {

    private $nombre;
    private $ataque;
    private $defensa;

    public function __construct($nombre, $ataque, $defensa) {

        $this->nombre = $nombre;
        $this->ataque = $ataque;
        $this->defensa = $defensa;

    }

    function getNombre() {
        return $this->nombre;
    }

    function getAtaque() {
        return $this->ataque;
    }

    function getDefensa() {
        return $this->defensa;
    }

    function mostrarInfo() {
        return "Nombre: " . $this->nombre . ", Ataque: " . $this->ataque . ", Defensa: " . $this->defensa;
    }

    function __tostring() {
       return $this->mostrarInfo();
        
    }
}

?>