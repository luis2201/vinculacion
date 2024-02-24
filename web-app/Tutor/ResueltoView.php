<?php 
  
  $peticionAjax = false;

  session_start(['name' => 'VIN']);    
  if(!isset($_SESSION['usuario_vin'])){
    header('Location: ../Login/');
  } else{
    switch($_SESSION['tipo_vin']){            
      case 'ADMINISTRADOR':
        header('Location: ../Admin');
        break;
      case 'COORDINADOR':
        header('Location: ../Coordinador');        
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
              <h1 class="m-0 text-dark">Datos de la Solicitud</h1>              
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
                  <a href="Pendiente.php"><button type="button" class="btn btn-outline-light btn-sm"><i class="fas fa-backspace"></i> Volver</button></a>
                </div>
                <div class="card-body">
                  <?php 
                    $result = $requerimiento->view_solucionado_business();
                    if(count($result)){
                      foreach($result as $row){
                  ?>
                  <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <h4 class="display-5"><?php echo $row['requerimiento']; ?></h4>
                      <p class="lead"><?php echo 'N&uacute;mero Solicitud: '.$row['numero']; ?></p>
                      <p class="lead"><?php echo 'Fecha Solicitud: '.$row['fecha']; ?></p>
                      <p class="lead"><?php echo '&Uacute;ltima Actualizaci&oacute;n: '.$row['fecha_actualizacion']; ?></p>                      
                      <p class="lead"><?php
                        if($row['estado']==1){
                          echo '<span class="badge badge-danger">PENDIENTE';
                        } else if($row['estado']==2){
                          echo '<span class="badge badge-warning">ASIGNADO';
                        } else if($row['estado']==3){
                          echo '<span class="badge badge-primary">CONTACTO';
                        } else{
                          echo '<span class="badge badge-success">RESUELTO';
                        }
                        echo '</span>';
                      ?></p>
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