<?php include './../header.php'; ?>

<main>
<section class="dashboard-info">
          
<h2>Listado de usuarios</h2>
           
<?php

require_once __DIR__ ."/../../models/UsuarioBD.php";

$userBD = new UsuarioBD();

$userBD->obtenerUsuarios();

?>
        
</section>
</main>
<?php include './../footer.php'; ?>