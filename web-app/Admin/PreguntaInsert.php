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
              <h1 class="m-0 text-dark">Registro de Pregunta</h1>
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
                  <a href="Pregunta.php"><button type="button" class="btn btn-outline-light btn-sm"><i class="fas fa-backspace"></i> Volver</button></a>
                </div>                
                <div class="card-body">
                  <form class="frmAction" action="<?php echo __SERVER__; ?>ajax/insertPreguntaAjax.php?>" method="POST" data-form="insert" enctype="multipart/form-data" autocomplete="off">                    
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="pregunta">Texto de la Pregunta</label>
                        <input type="text" name="pregunta" id="pregunta" class="form-control" placeholder="Pregunta">
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
  <script src="<?php echo __SERVER__.__APP__; ?>pregunta.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>