<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['idcarrera'])){
      require_once "../business/asistenciaBusiness.php";
      $asistencia = new AsistenciaBusiness();
      $result = $asistencia->select_estudiante_carrera_asistencia_business();

      if(count($result)<=0){
        echo '<option value="">-- No hay estudiantes en la Carrera --</option>';
      } else{
        foreach ($result as $row) {
        echo '<option value="'.mainModel::encryption($row["idestudiante"]).'">'.$row["estudiante"].'</option>'; 
      }      
      }      
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'"</script>';
  }

?>