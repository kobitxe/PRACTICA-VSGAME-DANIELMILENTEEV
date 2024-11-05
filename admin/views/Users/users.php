<?php include __DIR__ . '/../header.php'; ?>

<main>
<section class="dashboard-info" id="user-dashboard-info">
          
<h2>Listado de usuarios</h2>

<p class="mensaje"><?php if(isset($_GET['mensaje'])) {echo $_GET['mensaje'];}?></p>

<div class = "botones-accion">
<button onclick="window.location.href='http:\/\/127.0.0.1/daw/VSGAME-MVC-DANIELMILENTEEV/admin/index.php?controller=User&action=anyadir_usuario'">Añadir Usuario</button>
</div>
           
<?php  $this->mostrarUsuarios();  ?>
        
</section>
</main>

<?php include __DIR__ . '/../footer.php'; ?>