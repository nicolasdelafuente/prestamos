<div class="container-fluid">
  <div class="row justify-content-center m-1 p-1">

<?php

  function show_error(){
    $error = new ErrorController();
    $error->index();
  }

  if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'].'Controller';

  }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    $nombre_controlador = CONTROLLER_DEFAULT;
    
  }else{
    show_error();
    exit();
  }

  if(class_exists($nombre_controlador)){	
    $controlador = new $nombre_controlador();
    
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
      $action = $_GET['action'];
      $controlador->$action();
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
      $action_default = ACTION_DEFAULT;
      $controlador->$action_default();
    }else{
      show_error();
    }
  }else{
    show_error();
  }

  ?>

  </div>
</div>