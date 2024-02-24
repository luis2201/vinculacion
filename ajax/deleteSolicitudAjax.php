<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['idsolicitud'])){
      require_once "../business/requerimientoBusiness.php";
      $carrera = new RequerimientoBusiness();
      echo $carrera->delete_requerimiento_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'Login/"</script>';
  }

?>