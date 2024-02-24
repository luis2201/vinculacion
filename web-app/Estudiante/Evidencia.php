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
              <h1 class="m-0 text-dark">Registro de Evidencias</h1>              
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
                  <a href="EvidenciaInsert.php"><button type="button" class="btn btn-outline-light btn-sm"><i class="far fa-plus-square"></i> Agregar Evidencia</button></a>                
                </div>
                <div class="card-body">
                  <table id="tbLista" class="table table-responsive-sm table-striped table-hover" style="font-size: 12px;">
                    <thead>
                      <tr class="text-center">
                        <th>#</th>                        
                        <th>No. Solicitud</th>
                        <th>Fecha Carga</th>
                        <th>Estado de Revisi&oacute;n</th>                        
                        <th>Evidencia</th>
                      </tr>
                    </thead>                    
                    <tbody>
                      <?php 
                        $i = 1;
                        $result = $evidencia->consulta_evidencia_estudiante_business();
                                                
                        foreach($result as $row){ 
                      ?>
                      <tr>
                        <th class="text-center"><?php echo $i++ ?></th>                        
                        <th><?php echo $row['numero'] ?></th>                        
                        <th><?php echo $row['fecha'] ?></th>                        
                        <th class="text-center">
                          <?php 
                            if($row['estado']==0){
                              echo '<span class="badge badge-danger">PENDIENTE';
                            } else{                              
                              echo '<span class="badge badge-success">REVISADO';
                            }
                            echo '</span>';
                          ?>
                        </th>
                        <th class="text-center" style="padding:0.5%; width: 50px; margin: auto;">
                          <div class="row">
                            <div class="col-sm-12" style="padding:0; margin: 0">                                                              
                              <a href="ViewInforme.php?id=<?php echo $row['evidencia']; ?>" target="_blank"><button type="button" class="btn btn-sm btn-warning"><i class="far fa-eye"></i></button></a>
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
  <script src="<?php echo __SERVER__.__APP__; ?>evidencia.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>