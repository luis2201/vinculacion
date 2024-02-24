<?php   

  require_once '../../business/usuarioBusiness.php';     
  require_once '../../business/asistenciaBusiness.php'; 
  require_once '../../business/carreraBusiness.php'; 
  require_once '../../business/tutorBusiness.php'; 
  require_once '../../business/estudianteBusiness.php';   
  require_once '../../business/tiporequerimientoBusiness.php';   
  require_once '../../business/asistenciaBusiness.php';   
  require_once '../../business/requerimientoBusiness.php'; 
  require_once '../../business/evidenciaBusiness.php'; 
  require_once '../../business/tutorBusiness.php'; 
  require_once '../../business/encuestaBusiness.php'; 
  require_once '../../business/preguntaBusiness.php'; 
  require_once '../../business/resultadoBusiness.php'; 
  $usuario = new UsuarioBusiness();      
  $carrera = new CarreraBusiness();
  $tutor = new TutorBusiness();
  $estudiante = new EstudianteBusiness();
  $tiporequerimiento = new TipoRequerimientoBusiness();
  $asistencia = new AsistenciaBusiness();
  $requerimiento = new RequerimientoBusiness();
  $evidencia = new EvidenciaBusiness();
  $tutor = new TutorBusiness();
  $encuesta = new EncuestaBusiness();
  $pregunta = new PreguntaBusiness();
  $resultado = new ResultadoBusiness();
?>

<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Tittle Site & Icon -->
  <title><?php echo __APPNAME__; ?></title>    
  <link rel="icon" href="<?php echo __SERVER__.__ICO__; ?>logo-sistema.png" sizes="16x16" type="image/png">
  
  <!-- FontAwesom CSS -->
  <link rel="stylesheet" href="<?php echo __SERVER__.__FONT__; ?>fontawesome/css/all.min.css">    
  <!-- Jquery Confirm -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo __SERVER__.__PLUGINS__; ?>tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo __SERVER__.__PLUGINS__; ?>icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo __SERVER__.__PLUGINS__; ?>jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo __SERVER__.__DIST__; ?>css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo __SERVER__.__PLUGINS__; ?>overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo __SERVER__.__PLUGINS__; ?>daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo __SERVER__.__PLUGINS__; ?>summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Squada+One&display=swap" rel="stylesheet">
  <!-- DataTable CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron&family=Squada+One&display=swap" rel="stylesheet">  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

