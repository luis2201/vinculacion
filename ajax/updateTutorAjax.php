<?php

  $peticionAjax = true;
  require_once "../config/routes.php";

  if(isset($_POST['idtutor'])){
      require_once "../business/tutorBusiness.php";
      $tutor = new TutorBusiness();
      echo $tutor->update_tutor_business();
  } else{
      session_start();
      session_destroy();
      echo '<script>window.location.href="'.__SERVER__.'Login/"</script>';
  }

?>