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
            <div class="col-sm-8" style="margin: auto;">
              <div class="card mb-3">
                <div class="card-header text-right bg-primary" style="padding: 2px;">
                  <a href="Evidencia.php"><button type="button" class="btn btn-outline-light btn-sm"><i class="fas fa-backspace"></i> Volver</button></a>
                </div>                
                <div class="card-body">
                  <form class="frmAction" action="<?php echo __SERVER__; ?>ajax/insertEvidenciaAjax.php" method="POST" data-form="insert" enctype="multipart/form-data" autocomplete="off">                    
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="idsolicitud">N&uacute;mero de la Solicitud</label>
                        <select id="idsolicitud" name="idsolicitud" class="form-control">
                          <option value="">-- Seleccione N&uacute;mero --</option>
                          <?php
                            $result = $requerimiento->consulta_todos_evidencia_estudiante_business();
                            foreach ($result as $row) {
                          ?>
                            <option value="<?php echo $row['idrequerimiento'] ?>"><?php echo $row['numero'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group col-md-8">
                        <label for="evidencia">Evidencia</label>
                        <input type="file" id="evidencia" name="evidencia" class="form-control-file">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="observacion">Observaci&oacute;n</label>
                        <textarea id="observacion" name="observacion" class="form-control" rows="4"></textarea>
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
  <script src="<?php echo __SERVER__.__APP__; ?>evidencia.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>