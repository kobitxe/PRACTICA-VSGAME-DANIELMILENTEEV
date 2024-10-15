<?php 

Class Juego {

    private $numCartas;
    private $maxAtaque;
    private $maxDefensa;

    public function __construct($numCartas, $maxAtaque, $maxDefensa) {

        $this->numCartas = $numCartas;
        $this->maxAtaque = $maxAtaque;
        $this->maxDefensa = $maxDefensa;

    }

    public function getNumCartas() {
        return $this->numCartas;
    }

    public function getMaxAtaque() {
        return $this->maxAtaque;
    }

    public function getMaxDefensa() {
        return $this->maxDefensa;
    }

    public function generarCartasAleatorias() {

        $cartas = []; 

        $nombresCartas = 'Guardián, Místico, Sombra, Mago de Hielo, Elemental de Fuego,
        Cazador de Tormentas, Caballero Dragón, Oráculo, Bardo,
        Encantador, Domador, Caballero Sombrío, Mago Rúnico,
        Acechador Nocturno, Hechicero Celestial, Guerrero Fénix,
        Ranger, Druida, Vampiro, Hechicero, Bruja, Gladiador, Monje,
        Alquimista, Valquiria, Ilusionista, Maestro de Bestias, Cambiante,
        Elementalista, Nigromante';

        $nombres = explode(',',$nombresCartas);

        
        for ($i = 0; $i < $this->numCartas; $i++) {

            $nombre = $nombres[rand(0, count($nombres) -1)];
            $ataque = rand(1, $this->maxAtaque);
            $defensa = rand(1, $this->maxDefensa);
            $cartas[] = new CartaBase($nombre, $ataque, $defensa);
        
        }
        
        return $cartas;

    }

}

?>