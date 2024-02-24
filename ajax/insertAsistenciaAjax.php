<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['cliente'])){
      require_once "../business/asistenciaBusiness.php";
      $asistencia = new AsistenciaBusiness();
      echo $asistencia->insert_asistencia_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'"</script>';
  }

?>