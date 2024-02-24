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
              <h1 class="m-0 text-dark">Estudiante</h1>              
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
                  <a href="EstudianteInsert.php"><button type="button" class="btn btn-outline-light btn-sm"><i class="far fa-plus-square"></i> Agregar Estudiante</button></a>
                </div>
                <div class="card-body">
                  <table id="tbLista" class="table table-responsive-sm table-striped table-hover" style="font-size: 12px;">
                    <thead>
                      <tr class="text-center">
                        <th>#</th>                          
                        <th>Carrera</th>                        
                        <th>Apellidos</th>
                        <th>Nombres</th>                        
                        <th>Tel&eacute;fono</th>                        
                        <th>Horas</th>
                        <th>Estado</th>
                      </tr>
                    </thead>                    
                    <tbody>
                      <?php 
                        $i = 1;
                        $result = $estudiante->consulta_todos_estudiante_tutor_business();
                        foreach($result as $row){ 
                      ?>
                      <tr>
                        <th class="text-center"><?php echo $i++ ?></th>
                        <th><?php echo $row['carrera'] ?></th>
                        <th><?php echo $row['apellidos'] ?></th>
                        <th><?php echo $row['nombres'] ?></th>
                        <th><?php echo $row['telefono'] ?></th>
                        <th class="text-center"><?php echo $row['numero_horas'] ?></th>
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