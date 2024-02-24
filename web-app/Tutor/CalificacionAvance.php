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
              <h1 class="m-0 text-dark">Requerimientos Pendientes</h1>              
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
            <div class="col-sm-12" style="margin: auto;">
              <div class="card mb-3">
                <div class="card-header text-right bg-primary" style="padding: 2px;">                  
                </div>
                <div class="card-body">
                  <table id="tbLista" class="table table-responsive-sm table-striped table-hover" style="font-size: 12px;">
                    <thead>
                      <tr class="text-center">
                        <th>#</th>                        
                        <th>Fecha Solicitud</th>
                        <th>No. Solicitud</th>
                        <th>Estudiante</th>
                        <th>&Uacute;ltima Actualizaci&oacute;n</th>
                        <th>Estado</th>
                        <th>Avanzar Fase</th>
                      </tr>
                    </thead>                    
                    <tbody>
                      <?php 
                        $i = 1;
                        $result = $tutor->tutor_estudiante_requerimiento_pendiente_business();
                        foreach($result as $row){ 
                      ?>
                      <tr>
                        <th class="text-center"><?php echo $i++ ?></th>                        
                        <th class="text-center"><?php echo $row['fecha'] ?></th>
                        <th class="text-center"><?php echo $row['numero'] ?></th>
                        <th class="text-center"><?php echo $row['estudiante'] ?></th>
                        <th class="text-center"><?php echo $row['fecha_actualizacion'] ?></th>
                        <th class="text-center">
                          <?php 
                            if($row['estado']==1){
                              echo '<span class="badge badge-danger">ASIGNADO';
                            } else if($row['estado']==2){
                              echo '<span class="badge badge-warning">CONTACTADO';
                            } else if($row['estado']==3){
                              echo '<span class="badge badge-primary">EN PROCESO';
                            } else if($row['estado']==4){
                              echo '<span class="badge badge-success">RESUELTO';
                            }
                            echo '</span>';
                          ?>
                        </th>
                        <th class="text-center" style="padding:0.5%; margin: auto;">
                          <div class="row">
                            <div class="col-sm-12" style="padding:0; margin: 0">
                              <?php if($row['estado']!=4){ ?>
                                <form class="frmAction" action="<?php echo __SERVER__; ?>ajax/estadoRequerimientoAjax.php" method="POST" data-form="update" enctype="multipart/form-data" autocomplete="off">
                                  <input type="hidden" id="idrequerimiento" name="idrequerimiento" value="<?php echo $tutor->encryption($row['idrequerimiento']); ?>">
                                  <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-forward"></i></button>
                                </form>
                              <?php } ?>
                            </div>                            
                          </div>
                        </th>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
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
  <script src="<?php echo __SERVER__.__APP__; ?>calificacionavance.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>