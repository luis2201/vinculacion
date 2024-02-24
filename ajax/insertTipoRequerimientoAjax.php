<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['tipo'])){
      require_once "../business/tiporequerimientoBusiness.php";
      $tiporequerimiento = new TipoRequerimientoBusiness();
      echo $tiporequerimiento->insert_tiporequerimiento_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'Login/"</script>';
  }

?>