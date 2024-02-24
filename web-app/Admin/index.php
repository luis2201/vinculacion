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
              <h1 class="m-0 text-dark">Home</h1>
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
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">                  
                  <h3><?php echo count($usuario->consulta_todos_usuario_business()); ?></h3>
                  <p>Usuarios Registrados</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="Usuario.php" class="small-box-footer">Ver Todos <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?php echo count($tutor->consulta_todos_tutor_business()); ?></h3>
                  <p>Tutores Registrados</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="Tutor.php" class="small-box-footer">Ver Todos <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>            
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3><?php echo count($estudiante->consulta_todos_estudiante_business()); ?></h3>
                  <p>Estudiantes Registrados</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="Estudiante.php" class="small-box-footer">Ver Todos <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->            
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3><?php echo count($asistencia->consulta_todos_asistencia_business()); ?></h3>
                  <p>Solicitudes de Asistencia</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="Solicitud.php" class="small-box-footer">Ver todas <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="card">
                <div class="card-header bg-primary">
                  <?php 
                    $result = $asistencia->consulta_todos_asistencia_business();
                    echo '<h5>Solicitudes ('.count($result).')</h5>';
                  ?>
                </div>
                <div class="card-body">
                  <?php
                    $p = 0;
                    $s = 0;
                    foreach ($result as $row) {
                      if ($row['estado']==0) {
                        $p = $p+1;
                      } else{
                        $s = $s + 1;
                      }
                    } 
                    echo '<input type="hidden" id="pendientes" name="pendientes" value="'.$p.'">';
                    echo '<input type="hidden" id="solucionados" name="pendientes" value="'.$s.'">';
                  ?>
                  <canvas id="chDonut1"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="card">
                <div class="card-header bg-success">
                  <?php 
                    $result = $requerimiento->consulta_todos_requerimiento_business();
                    echo '<h5>Requerimientos ('.count($result).')</h5>';
                  ?>
                </div>
                <div class="card-body">
                  <?php
                    $r = 0;
                    $ep = 0;
                    $c = 0;
                    $a = 0;
                    foreach ($result as $row) {
                      if ($row['estado']==4){
                        $r = $r+1;
                      } else if ($row['estado']==3){
                        $ep = $ep + 1;
                      } else if ($row['estado']==2){
                        $c = $c + 1;
                      } else if ($row['estado']==1){
                        $a = $a + 1;
                      }
                    } 
                    echo '<input type="hidden" id="resueltos" name="resueltos" value="'.$r.'">';
                    echo '<input type="hidden" id="enproceso" name="enproceso" value="'.$ep.'">';
                    echo '<input type="hidden" id="contactado" name="contactado" value="'.$c.'">';
                    echo '<input type="hidden" id="asignado" name="asignado" value="'.$a.'">';
                  ?>
                  <canvas id="chBar"></canvas>
                </div>
            </div>
            </div>
          </div>
          <!-- Main row -->
          <div class="row">
           
          </div>
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  <?php require '../layout/footer.php'; ?>
  <script src="<?php echo __SERVER__.__APP__; ?>usuario.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
  <script>
    // chart colors
    var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
    
    var solucionados = document.getElementById("solucionados").value;
    var pendientes = document.getElementById("pendientes").value;

    /* 3 donut charts */
    var donutOptions = {
      cutoutPercentage: 60, 
      legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
    };

    var chDonutData1 = {
      labels: ['Solucionados', 'pendientes'],
      datasets: [
        {
          backgroundColor: colors.slice(0,2),
          borderWidth: 4,
          data: [solucionados, pendientes]
        }
      ]
    };

    var chDonut1 = document.getElementById("chDonut1");
    if (chDonut1) {
      new Chart(chDonut1, {
          type: 'pie',
          data: chDonutData1,
          options: donutOptions
      });
    }

    var resueltos = document.getElementById("resueltos").value;
    var enproceso = document.getElementById("enproceso").value;
    var contactado = document.getElementById("contactado").value;
    var asignado = document.getElementById("asignado").value;
    /* bar chart */
    var chBar = document.getElementById("chBar");
    if (chBar) {
      new Chart(chBar, {
      type: 'bar',
      data: {
        labels: ["Resueltos", "En Proceso", "Contactado", "Asignado"],
        datasets: [{
          data: [resueltos, enproceso, contactado, asignado],
          backgroundColor: colors.slice(0,4)
        }]
      },
      options: {
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            barPercentage: 0.4,
            categoryPercentage: 2
          }]
        }
      }
      });
    }
  </script>
</body>
</html>
<?php ob_end_flush(); ?>