<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['usuario'])){
      require_once "../business/usuarioBusiness.php";
      $usuario = new UsuarioBusiness();
      echo $usuario->login_usuario_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'Login/"</script>';
  }

?>