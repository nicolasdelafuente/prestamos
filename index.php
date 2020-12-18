<?php
  session_start();  
  require_once 'cargarControladores.php';
  require_once 'config/database.php';
  require_once 'config/parameters.php';
  require_once 'helpers/utils.php';
  include_once "views/layouts/header.php";
?>


<div class="container-fluid">

  <?php include_once "views/layouts/navbar.php"; ?>

  <section>
    <?php include_once "views/layouts/content.php"; ?>
  </section>

</div>

<?php include_once "views/layouts/footer.php"; ?>