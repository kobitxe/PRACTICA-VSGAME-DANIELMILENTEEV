<?php 


Class Jugador {

    private $nombre;
    public $mazo;
    public function __construct(Juego $juego, $nombre) {
        $this->nombre = $nombre;
        $this->mazo = new Mazo($juego);
    }
    
    public function jugarCarta() {
        return array_shift($this->mazo);
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getMazo() {
        return $this->mazo;
    }

    public function mostrarMazo() {
        return count($this->mazo);
    }

    public function cartasRestantes() {
        return $this->mazo->cartasRestantes();
    }

}

?>