<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['idsolicitud'])){
      require_once "../business/encuestaBusiness.php";
      $encuesta = new EncuestaBusiness();
      echo $encuesta->insert_encuesta_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'Login/"</script>';
  }

?>