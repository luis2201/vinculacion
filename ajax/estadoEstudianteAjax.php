<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['idestudiante'])){
      require_once "../business/estudianteBusiness.php";
      $estudiante = new EstudianteBusiness();
      echo $estudiante->cambio_estado_estudiante_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'Login/"</script>';
  }

?>