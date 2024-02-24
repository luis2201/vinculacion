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
      case 'TUTOR':
        header('Location: ../Tutor');
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
              <h1 class="m-0 text-dark">Imprimir Certificado</h1>              
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
            <div class="col-sm-6" style="margin: auto;">
              <div class="card mb-3">
                
                <div class="card-body">
                  <?php

                    $result = $estudiante->horas_estudiante_business();
                    foreach ($result as $row) {
                      if($row['numero_horas']==40){
                        echo '<div class="col-md-12 text-center">';
                        echo '<a href="#"><button type="button" class="btn btn-md btn-success"><i class="fas fa-print"></i> Imprimir</button></a>';
                        echo '</div>';
                      } else{
                        echo '<center><h3 class="text-danger">N&uacute;mero de horas insuficientes</h3></center>';
                      }
                    }
                  ?>  
                </div>

              </div>
            </div>
          </div>
          <div id="RespuestaForm"></div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  <?php require '../layout/footer.php'; ?>
  <script src="<?php echo __SERVER__.__APP__; ?>evidencia.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>