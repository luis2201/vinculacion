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
              <h1 class="m-0 text-dark">Asignar Tutor y Estudiante</h1>              
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
            <div class="col-sm-8" style="margin: auto;">
              <div class="card mb-3">
                <div class="card-header text-right bg-primary" style="padding: 2px;">
                  <a href="Solicitud.php"><button type="button" class="btn btn-outline-light btn-sm"><i class="fas fa-backspace"></i> Volver</button></a>
                </div>
                <?php 
                  $result = $asistencia->view_asistencia_business();
                  if(count($result)==0){
                    echo '<script>window.location="Solicitud.php";</script>';
                  }
                  foreach ($result as $row) {
                    $idsolicitud = $row['idsolicitud'];
                  }

                ?>
                <div class="card-body">
                  <form class="frmAction" action="<?php echo __SERVER__; ?>ajax/asignarAsistenciaAjax.php?>" method="POST" data-form="update" enctype="multipart/form-data" autocomplete="off">                                        
                    <input type="hidden" id="idsolicitud" name="idsolicitud" value="<?php echo $asistencia->encryption($idsolicitud); ?>">                    
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="idcarrera">Carrera</label>
                        <select name="idcarrera" id="idcarrera" class="form-control">
                          <option value="">-- Seleccione una carrera --</option>
                          <?php

                            $result = $carrera->consulta_todos_carrera_business();
                            foreach ($result as $carreras) {
                          ?>                            
                          <option value="<?php echo $estudiante->encryption($carreras['idcarrera']); ?>"><?php echo $carreras["carrera"]; ?></option>;
                          <?php   
                            } 
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="idtipo">Tipo de Requerimiento</label>
                        <select name="idtipo" id="idtipo" class="form-control">
                          <option value="">-- Defina el tipo de Requerimieto --</option>
                          <?php

                            $result = $tiporequerimiento->consulta_todos_tiporequerimiento_business();
                            foreach ($result as $carreras) {
                          ?>                            
                          <option value="<?php echo $estudiante->encryption($carreras['idtipo']); ?>"><?php echo $carreras["tipo"].'-('.$carreras["horas"].') Horas'; ?></option>;
                          <?php   
                            } 
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="idtutor">Tutor</label>
                        <select name="idtutor" id="idtutor" class="form-control">
                          
                        </select>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="idestudiante">Estudiante asignado para el requerimiento</label>
                        <select name="idestudiante" id="idestudiante" class="form-control" required>
                          
                        </select>
                      </div>
                    </div>                    
                    <div class="form-row"> 
                      <div class="form-group col-md-6">
                        <button type="submit" id="btnEnviar" class="btn btn-block btn-success"><i class="far fa-save"></i> Guardar</button>
                      </div>
                      <div class="form-group col-md-6">
                        <button type="button" id="btnCancelar" class="btn btn-block btn-warning"><i class="far fa-window-close"></i> Cancelar</button>
                      </div>
                    </div>
                  </form>
                  <div id="RespuestaForm"></div>
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
  <script src="<?php echo __SERVER__.__APP__; ?>solicitud.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>