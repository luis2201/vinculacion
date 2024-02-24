<?php 
  
  $peticionAjax = false;

  session_start(['name' => 'VIN']);    
  if(!isset($_SESSION['usuario_vin'])){
    header('Location: ../Login/');
  } else{
    switch($_SESSION['tipo_vin']){            
      case 'COORDINADOR':
        header('Location: ../Coordinador');        
        break;
      case 'TUTOR':
        header('Location: ../Tutor');
        break;
      case 'ESTUDIANTE':
        header('Location: ../Estudiante');
        break;
    }
  }

  include '../../config/routes.php';
  include '../layout/head.php';
  include '../layout/nav.php';
  include 'sidebar.php'; 

?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Datos del Tutor</h1>
            </div><!-- /.col -->            
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">          
          <!-- Main row -->
          <div class="row">
            <div class="col-sm-10" style="margin: auto;">
              <div class="card mb-3">
                <div class="card-header text-right bg-primary" style="padding: 2px;">
                  <a href="Tutor.php"><button type="button" class="btn btn-outline-light btn-sm"><i class="fas fa-backspace"></i> Volver</button></a>
                </div>
                <div class="card-body">
                  <?php 
                    $result = $tutor->view_tutor_business();
                    if(count($result)){
                      foreach($result as $row){
                  ?>
                  <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <h1 class="display-6"><?php echo $row['apellidos'].' '.$row['nombres']; ?></h1>
                      <p class="lead"><?php echo 'Carrera: '.$row['carrera']; ?></p>
                      <p class="lead"><?php echo 'C&eacute;dula: '.$row['cedula']; ?></p>
                      <p class="lead"><?php echo 'Correo: '.$row['correo']; ?></p>
                      <p class="lead"><?php echo 'Tel&eacute;fono: '.$row['telefono']; ?></p>
                      <p class="lead"><?php echo ($row['estado']==1)?'Estado: <span class="badge badge-success">ACTIVO':'Estado: <span class="badge badge-danger">INACTIVO'; ?></span></p>
                    </div>
                  </div>
                    <?php 
                        }
                      }else{
                    ?>
                  <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <h1 class="display-4">Nada para mostrar</h1>
                      <p class="lead">No existe informaci&oacute;n relacionada de un local comercial con su b&uacute;squeda.</p>
                    </div>
                  </div>
                    <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  <?php require '../layout/footer.php'; ?>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>