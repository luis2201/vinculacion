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
              <h1 class="m-0 text-dark">Usuarios</h1>              
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
                </div>
                <div class="card-body">
                  <table id="tbLista" class="table table-responsive-sm table-striped table-hover" style="font-size: 12px;">
                    <thead>
                      <tr class="text-center">
                        <th>#</th>                          
                        <th>Nombres</th>                        
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Fecha Registro</th>
                        <th>Estado</th>                        
                        <th>Acci&oacute;n</th>
                      </tr>
                    </thead>                    
                    <tbody>
                      <?php 
                        $i = 1;
                        $result = $usuario->consulta_todos_usuario_business();
                        foreach($result as $row){ 
                      ?>
                      <tr>
                        <th class="text-center"><?php echo $i++ ?></th>
                        <th><?php echo $row['nombres'] ?></th>
                        <th><?php echo $row['usuario'] ?></th>
                        <th class="text-center"><?php echo $row['rol'] ?></th>
                        <th><?php echo $row['fecha_registro'] ?></th>                        
                        <th class="text-center">
                          <?php 
                            if($row['estado']==1){
                              echo '<span class="badge badge-success">ACTIVO';
                            } else{
                              echo '<span class="badge badge-danger">DESACTIVADO';
                            }
                            echo '</span>';
                          ?>
                        </th>
                        <th class="text-center" style="padding:0.5%; width: 60px; margin: auto;">
                          <div class="row" style="width: 115%">
                            <div class="col-sm-6" style="padding:0; margin: 0;">
                              <form class="frmAction" action="<?php echo __SERVER__; ?>ajax/resetUsuarioAjax.php" method="POST" data-form="reset" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" id="idusuario" name="idusuario" value="<?php echo $usuario->encryption($row['usuario']); ?>">
                                <button type="submit" class="btn btn-sm btn-warning"><i class="fas fa-key"></i></button>
                              </form>
                            </div>                          
                            <div class="col-sm-6" style="padding:0; margin: 0;">
                              <form class="frmAction" action="<?php echo __SERVER__; ?>ajax/estadoUsuarioAjax.php" method="POST" data-form="estado" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" id="idusuario" name="idusuario" value="<?php echo $usuario->encryption($row['idusuario']); ?>">
                                <button type="submit" class="btn btn-sm btn-secondary"><i class="fa fa-retweet"></i></button>
                              </form>
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
  <script src="<?php echo __SERVER__.__APP__; ?>usuario.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>