<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['idcarrera'])){
      require_once "../business/asistenciaBusiness.php";
      $asistencia = new AsistenciaBusiness();
      $result = $asistencia->select_tutor_carrera_asistencia_business();

      echo '<option value="">-- Seleccione un Tutor --</option>';
      foreach ($result as $row) {
        echo '<option value="'.mainModel::encryption($row["idtutor"]).'">'.$row["tutor"].'</option>'; 
      }      
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'"</script>';
  }

?>