<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['carrera'])){
      require_once "../business/carreraBusiness.php";
      $carrera = new CarreraBusiness();
      echo $carrera->insert_carrera_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'Login/"</script>';
  }

?>