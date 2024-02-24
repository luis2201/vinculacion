<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['idrequerimiento'])){
      require_once "../business/requerimientoBusiness.php";
      $requerimiento = new RequerimientoBusiness();
      echo $requerimiento->cambio_estado_requerimiento_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'Login/"</script>';
  }

?>