<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['idmes'])){
      require_once "../business/requerimientoBusiness.php";
      $requerimiento = new RequerimientoBusiness();      
      $result = $requerimiento->consulta_todos_requerimiento_mes_business(); 
      echo json_encode($result);      
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'"</script>';
  }

?>