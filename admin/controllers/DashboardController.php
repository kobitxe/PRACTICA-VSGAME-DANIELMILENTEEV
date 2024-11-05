<?php 
require_once __DIR__ . "/../models/Cards.php";
require_once __DIR__ . "/../models/Configuracion.php";
Class DashboardController {
public function panel() {
    
    $cartas = new CartasBD();
    $total_cartas = $cartas->contarCartas();

    $conf = new ConfiguracionDB();
    $conf_juego = $conf->mostrarConfiguracion();

    $num_cartas = $conf_juego[0]["num_cartas"];
    $max_ataque = $conf_juego[0]["max_ataque"];
    $max_defensa = $conf_juego[0]["max_defensa"];
    
    // header("Location: views/dashboard.php?total_cartas=" . $total_cartas  . "&num_cartas=" . $num_cartas . "&max_ataque=" . $max_ataque . "&max_defensa=" . $max_defensa);

    include __DIR__ . "/../views/dashboard.php";
}
    

}

?>