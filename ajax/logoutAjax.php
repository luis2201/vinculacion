<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_GET['Token'])){
      require_once "../business/usuarioBusiness.php";
      $logout = new UsuarioBusiness();

      echo $logout->logout_usuario_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'"</script>';
  }

?>