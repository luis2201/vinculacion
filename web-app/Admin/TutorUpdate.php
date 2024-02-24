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
              <h1 class="m-0 text-dark">Actualizar datos del Coordinador</h1>              
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
                  <a href="Tutor.php"><button type="button" class="btn btn-outline-light btn-sm"><i class="fas fa-backspace"></i> Volver</button></a>
                </div>
                <?php 
                  $result = $tutor->view_tutor_business();                  
                  if(count($result)==0){
                    echo '<script>window.location="Tutor.php";</script>';
                  }
                  foreach ($result as $row) {
                ?>
                <div class="card-body">
                  <form class="frmAction" action="<?php echo __SERVER__; ?>ajax/updateTutorAjax.php?>" method="POST" data-form="update" enctype="multipart/form-data" autocomplete="off">                    
                    <input type="hidden" name="idtutor" id="idtutor" value="<?php echo $tutor->encryption($row['idtutor']); ?>">
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="idcarrera">Carrera</label>
                        <select name="idcarrera" id="idcarrera" class="form-control">
                          <?php

                            $result = $carrera->consulta_todos_carrera_business();
                            foreach ($result as $carreras) {
                              echo '<option value="'.$tutor->encryption($carreras["idcarrera"]);
                              if ($carreras['idcarrera']==$row['idcarrera']) {
                                echo '" selected>';
                              } else{
                                echo '">';
                              }
                              echo $carreras["carrera"].'</option>';
                            } 

                          ?>
                        </select>
                      </div>                                          
                      <div class="form-group col-md-6">
                        <label for="cedula">C&eacute;dula</label>
                        <input type="text" name="cedula" id="cedula" class="form-control-plaintext" placeholder="C&eacute;dula" value="<?php echo $row['cedula']; ?>" readonly>
                      </div>                      
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="nombres">Nombres</label>
                        <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombres" value="<?php echo $row['nombres']; ?>">
                      </div>                                          
                      <div class="form-group col-md-6">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos" value="<?php echo $row['apellidos']; ?>">
                      </div>                      
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="correo">Correo electr&oacute;nico</label>
                        <input type="text" name="correo" id="correo" class="form-control-plaintext" placeholder="Correo Electr&oacute;nico" value="<?php echo $row['correo']; ?>" readonly>
                      </div>                                          
                      <div class="form-group col-md-6">
                        <label for="telefono">Tel&eacute;fono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Tel&eacute;fono" value="<?php echo $row['telefono']; ?>">
                      </div>                      
                    </div>
                    <div class="form-row"> 
                      <div class="form-group col-md-6">
                        <button type="submit" id="btnEnviar" class="btn btn-block btn-success"><i class="fas fa-sync"></i> Guardar</button>
                      </div>
                      <div class="form-group col-md-6">
                        <button type="button" id="btnCancelar" class="btn btn-block btn-warning"><i class="far fa-window-close"></i> Cancelar</button>
                      </div>
                    </div>
                  </form>
                  <div id="RespuestaForm"></div>
                </div>  
                <?php } ?>              
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
  <script src="<?php echo __SERVER__.__APP__; ?>tutor.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>