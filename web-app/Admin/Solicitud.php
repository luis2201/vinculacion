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
              <h1 class="m-0 text-dark">Solicitudes de Asistencia</h1>              
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
                        <th>Fecha</th>                        
                        <th>Número Solicitud</th>
                        <th>Cliente</th>                        
                        <th>Tel&eacute;fono</th>                        
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Acci&oacute;n</th>
                      </tr>
                    </thead>                    
                    <tbody>
                      <?php 
                        $i = 1;
                        $result = $asistencia->consulta_todos_asistencia_business();
                        foreach($result as $row){ 
                      ?>
                      <tr>
                        <th class="text-center"><?php echo $i++ ?></th>
                        <th class="text-center"><?php echo $row['fecha'] ?></th>
                        <th class="text-center"><?php echo $row['numero'] ?></th>
                        <th><?php echo $row['cliente'] ?></th>
                        <th><?php echo $row['telefono'] ?></th>
                        <th><?php echo $row['correo'] ?></th>                        
                        <th class="text-center">
                          <?php 
                            if($row['estado']==1){
                              echo '<span class="badge badge-success">FINALIZADO';
                            } else{
                              echo '<span class="badge badge-danger">PENDIENTE';
                            }
                            echo '</span>';
                          ?>
                        </th>
                        <th class="text-center" style="padding:0.5%; width: 100px; margin: auto;">
                          <div class="row" style="width: 115%">
                            <div class="col-sm-4" style="padding:0; margin: 0;">
                              <a href="SolicitudView.php?id=<?php echo $asistencia->encryption($row['idsolicitud']); ?>"><button type="button" class="btn btn-sm btn-warning"><i class="far fa-eye"></i></button></a>
                            </div>                                                        
                            <div class="col-sm-4" style="padding:0; margin: 0;">
                              <?php
                                $result = $requerimiento->comprueba_solicitud_requerimiento_business($asistencia->encryption($row['idsolicitud']));
                                if (count($result)<=0) {                                                              
                              ?>                              
                              <a href="SolicitudAsignar.php?id=<?php echo $asistencia->encryption($row['idsolicitud']); ?>"><button type="button" class="btn btn-sm btn-success"><i class="fas fa-user-edit"></i></button></a>
                              <?php } ?>
                            </div>
                            <div class="col-sm-4" style="padding:0; margin: 0; margin-right: -3px;">
                              <?php
                                $result = $requerimiento->comprueba_solicitud_requerimiento_business($asistencia->encryption($row['idsolicitud']));
                                if (count($result)<=0) { 
                              ?>
                              <form class="frmAction" action="<?php echo __SERVER__; ?>ajax/deleteSolicitudAjax.php" method="POST" data-form="delete" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" id="idsolicitud" name="idsolicitud" value="<?php echo $requerimiento->encryption($row['idsolicitud']); ?>">
                                <button type="submit" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
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
  <script src="<?php echo __SERVER__.__APP__; ?>solicitud.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>