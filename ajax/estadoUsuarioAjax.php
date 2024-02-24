<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['idusuario'])){
      require_once "../business/usuarioBusiness.php";
      $usuario = new UsuarioBusiness();
      echo $usuario->cambio_estado_usuario_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'Login/"</script>';
  }

?>