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
              <h1 class="m-0 text-dark">Carrera</h1>              
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
                  <a href="CarreraInsert.php"><button type="button" class="btn btn-outline-light btn-sm"><i class="far fa-plus-square"></i> Agregar Carrera</button></a>
                </div>
                <div class="card-body">
                  <table id="tbLista" class="table table-responsive-sm table-striped table-hover" style="font-size: 12px;">
                    <thead>
                      <tr class="text-center">
                        <th>#</th>                        
                        <th>Carrera</th>
                        <th>Estado</th>
                        <th>Acci&oacute;n</th>
                      </tr>
                    </thead>                    
                    <tbody>
                      <?php 
                        $i = 1;
                        $result = $carrera->consulta_todos_carrera_business();
                        foreach($result as $row){ 
                      ?>
                      <tr>
                        <th class="text-center"><?php echo $i++ ?></th>                        
                        <th><?php echo $row['carrera'] ?></th>
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
                        <th class="text-center" style="padding:0.5%; width: 130px; margin: auto;">
                          <div class="row" style="width: 115%">
                            <div class="col-sm-3" style="padding:0; margin: 0">                                                              
                              <a href="CarreraView.php?id=<?php echo $carrera->encryption($row['idcarrera']); ?>"><button type="button" class="btn btn-sm btn-warning"><i class="far fa-eye"></i></button></a>
                            </div>
                            <div class="col-sm-3" style="padding:0; margin: 0">
                              <a href="CarreraUpdate.php?id=<?php echo $carrera->encryption($row['idcarrera']); ?>"><button type="button" class="btn btn-sm btn-success"><i class="far fa-edit"></i></button></a>
                            </div>                                                      
                            <!-- Cambiar estado -->
                            <div class="col-sm-3" style="padding:0; margin: 0">
                              <form class="frmAction" action="<?php echo __SERVER__; ?>ajax/estadoCarreraAjax.php" method="POST" data-form="estado" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" id="idcarrera" name="idcarrera" value="<?php echo $carrera->encryption($row['idcarrera']); ?>">
                                <button type="submit" class="btn btn-sm btn-secondary"><i class="fas fa-retweet"></i></button>
                              </form>
                            </div>
                            <!-- Eliminar registro -->
                            <div class="col-sm-3" style="padding:0; margin: 0">
                              <form class="frmAction" action="<?php echo __SERVER__; ?>ajax/deleteCarreraAjax.php" method="POST" data-form="delete" enctype="multipart/form-data" autocomplete="off">
                                <input type="hidden" id="idcarrera" name="idcarrera" value="<?php echo $carrera->encryption($row['idcarrera']); ?>">
                                <button type="submit" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
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
  <script src="<?php echo __SERVER__.__APP__; ?>carrera.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>