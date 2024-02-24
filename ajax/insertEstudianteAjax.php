<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['cedula'])){
      require_once "../business/estudianteBusiness.php";
      $estudiante = new EstudianteBusiness();
      echo $estudiante->insert_estudiante_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'Login/"</script>';
  }

?>