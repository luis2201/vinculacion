<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['pregunta'])){
      require_once "../business/preguntaBusiness.php";
      $pregunta = new PreguntaBusiness();
      echo $pregunta->insert_pregunta_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'Login/"</script>';
  }

?>