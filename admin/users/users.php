<?php include './../header.php'; ?>

<main>
<section class="dashboard-info" id="user-dashboard-info">
          
<h2>Listado de usuarios</h2>

<p class="mensaje"><?php if(isset($_GET['mensaje'])) {echo $_GET['mensaje'];}?></p>

<div class = "botones-accion">
<button onclick="window.location.href='userAdd.php'">Añadir Usuario</button>
</div>
           
<?php

require_once __DIR__ ."/../../models/UsuarioBD.php";

$userBD = new UsuarioBD();

$userBD->obtenerUsuarios();

?>
        
</section>
</main>
<?php include './../footer.php'; ?>