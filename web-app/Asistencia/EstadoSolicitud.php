<?php  
  
  $peticionAjax = false; 
  
  include '../../config/routes.php';
  include '../layout/head.php';

?>
  <div class="container-fluid">
    <div class="col-md-6 mt-5" style="margin: auto;">
      <div class="card shadow-lg" style="border-top-color: #0275d8; border-top-width: 4px;">
        <div class="card-header" style="padding: 0px;">
          <a href="<?php echo __SERVER__; ?>">
            <button type="button" class="btn btn-sm text-primary"><i class="far fa-window-close fa-2x"></i></button>
          </a>
        </div>
        <div class="card-body">            
          <div class="row">
            <div class="col-md">
              <center><h3 style="font-family: 'Squada One', cursive; font-size: 35px;"><strong>Estados de Solicitud de Asistencia</strong></h3></center>
              <div id="RespuestaForm" class="form-group text-center" style="margin-top: 30px; margin-bottom: 30px;">
              	<h1>
          		<?php                
          			$result = $requerimiento->consulta_estado_requerimiento_business($_POST['numero']);
          			if (count($result)>0) {
          				foreach ($result as $row) {
	          				if ($row['estado']==1) {
	          					echo '<span class="badge badge-secondary">ASIGNADO</span>';
	          				} else if ($row['estado']==2) {
	          					echo '<span class="badge badge-warning">CONTACTADO</span>';
	          				} else if ($row['estado']==3) {
	          					echo '<span class="badge badge-primary">EN PROCESO</span>';
	          				} else if ($row['estado']==4) {
	          					echo '<span class="badge badge-success">RESUELTO</span>';
	          				}
	          			}	
          			} else{
          				echo '<span class="badge badge-danger">SIN REVISAR</span>';
          			}
          		?>	
              	</span></h1>
              </div>
            </div>
          </div>
          <?php if($row['estado']==4) { ?>
          <div class="row">
            <div class="col-md text-center">                             
              <a href="Encuesta.php?id=<?php echo $requerimiento->encryption($row['idsolicitud']); ?>">
                <button type="button" class="btn btn-sm btn-primary">Llenar Encuesta</button>
              </a>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="card-footer bg-primary border-0 text-light">
          <div class="footer-copyright">
            <span style="font-family: 'Squada One', cursive;">
              © 2020 Copyright:
              <a href="http://itsup.edu.ec/" class="text-light"> Itsup</a>
              <p class="float-right">vinculacion@itsup.edu.ec</p>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>    
  <?php require '../layout/footerlogin.php'; ?>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>