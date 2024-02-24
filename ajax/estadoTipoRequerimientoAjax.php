<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['idtipo'])){
      require_once "../business/tiporequerimientoBusiness.php";
      $tiporequerimiento = new TipoRequerimientoBusiness();
      echo $tiporequerimiento->cambio_estado_tiporequerimiento_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'Login/"</script>';
  }

?>