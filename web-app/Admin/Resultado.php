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
              <h1 class="m-0 text-dark">Resultados</h1>
            </div><!-- /.col -->            
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">            
            <div class="col-lg-4 col-12">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">                  
                  <h3>
                    <?php 
                      $result = $resultado->consulta_resultado_promedio_business(); 
                      foreach ($result as $row) {
                        echo $row['promedio'];
                      }
                    ?>/5
                  </h3>
                  <p>Satisfacci&oacute;n del Cliente</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Promedio <i class="fas fa-check-circle"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-12">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>
                  <?php 
                    $result = $resultado->consulta_resultado_promedio_business(); 
                    foreach ($result as $row) {
                      $lista = array("1"=>$row['p1'], "2"=>$row['p2'], "3"=>$row['p3'], "4"=>$row['p4'], "5"=>$row['p5']);
                      $label = array_search(max($lista), $lista);
                      echo max($lista);
                    }
                  ?>
                  </h3>
                  <p>
                  <?php 
                    $result = $pregunta->view_pregunta_texto_business($label);
                    foreach ($result as $row) {
                      echo $row['pregunta'];   
                    } 
                  ?>
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="Tutor.php" class="small-box-footer">M&aacute;s Alta <i class="fas fa-arrow-circle-up"></i></a>
              </div>
            </div>            
            <!-- ./col -->
            <div class="col-lg-4 col-12">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>
                    <?php 
                    $result = $resultado->consulta_resultado_promedio_business(); 
                    foreach ($result as $row) {
                      $lista = array("1"=>$row['p1'], "2"=>$row['p2'], "3"=>$row['p3'], "4"=>$row['p4'], "5"=>$row['p5']);
                      $label = array_search(min($lista), $lista);
                      echo min($lista);
                    }
                  ?>
                  </h3>
                  <p>
                  <?php 
                    $result = $pregunta->view_pregunta_texto_business($label);
                    foreach ($result as $row) {
                      echo $row['pregunta'];   
                    } 
                  ?>
                  </p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">M&aacute;s Baja <i class="fas fa-arrow-circle-down"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="card">
                <div class="card-header bg-primary">
                  <label for="mes">Solicitudes por mes</label>
                  <select id="idmes1" name="idmes1" class="float-right">
                    <?php    
                      $Meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
                      for ($i=1; $i<=12; $i++) {
                           if ($i == date('m'))
                      echo '<option value="'.$i.'"selected>'.$Meses[($i)-1].'</option>';
                           else
                      echo '<option value="'.$i.'">'.$Meses[($i)-1].'</option>';
                           }
                    ?>
                  </select>
                </div>
                <div class="card-body">                                    
                  <canvas id="chDonut1"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="card">
                <div class="card-header bg-success">
                  <label for="mes">Solicitudes por mes</label>
                  <select id="idmes2" name="idmes2" class="float-right">
                    <?php    
                      $Meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
                      for ($i=1; $i<=12; $i++) {
                           if ($i == date('m'))
                      echo '<option value="'.$i.'"selected>'.$Meses[($i)-1].'</option>';
                           else
                      echo '<option value="'.$i.'">'.$Meses[($i)-1].'</option>';
                           }
                    ?>
                  </select>
                </div>
                <div class="card-body">                  
                  <canvas id="chBar"></canvas>
                </div>
            </div>
            </div>
          </div>
          <!-- Main row -->
          <div id="RespuestaForm" class="row">
            
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  <?php require '../layout/footer.php'; ?>
  <script src="<?php echo __SERVER__.__APP__; ?>resultado.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
  <script>
    

    
  </script>
</body>
</html>
<?php ob_end_flush(); ?>