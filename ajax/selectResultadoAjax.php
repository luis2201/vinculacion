<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['idmes'])){
      require_once "../business/asistenciaBusiness.php";
      $asistencia = new AsistenciaBusiness();      
      $result = $asistencia->consulta_todos_asistencia_mes_business(); 
      echo json_encode($result);      
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'"</script>';
  }

?>