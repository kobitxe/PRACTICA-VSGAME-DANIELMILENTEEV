<?php 

Class TipoCartaEspecial extends CartaBase {

    private $poderEspecial;

    public function __construct($nombre, $ataque, $defensa, $poderEspecial) {
       
        parent::__construct($nombre, $ataque, $defensa);
        $this->poderEspecial = $poderEspecial;

    }

    function mostrarInfo() {
        parent::mostrarInfo();
        echo "Poder Especial: " . $this->poderEspecial;

    }

    function __tostring() {
        $salida = parent::__tostring() . ", Poder especial: " . $this->poderEspecial;
        return $salida;
    }

}

?>