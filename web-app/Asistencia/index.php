<?php  
  
  $peticionAjax = false; 
  
  include '../../config/routes.php';
  include '../layout/head.php';

?>
  <div class="container-fluid">
    <div class="col-md-6 mt-5" style="margin: auto;">
      <div class="card shadow-lg" style="border-top-color: #e94e1b; border-top-width: 4px;">
        <div class="card-header" style="padding: 0px;">
          <a href="<?php echo __SERVER__; ?>">
            <button type="button" class="btn btn-sm text-primary"><i class="far fa-window-close fa-2x text-secondary"></i></button>
          </a>
        </div>
        <div class="card-body">            
          <div class="row">            
            <div class="col-md">              
              <center><h3 style="font-family: 'Squada One', cursive; font-size: 35px;"><strong>Registro de Solicitud de Asistencia</strong></h3></center>
              <form class="frmAction" action="<?php echo __SERVER__; ?>ajax/insertAsistenciaAjax.php" method="POST" data-form="insert" enctype="multipart/form-data" autocomplete="off">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" id="cliente" name="cliente" class="form-control" placeholder="Nombres y Apellidos" required>
                </div>                
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                  </div>
                  <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Tel&eacute;fono" required>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                  </div>
                  <input type="mail" id="correo" name="correo" class="form-control" placeholder="Correo electr&oacute;nico">
                </div>
                <div class="input-group mb-3">                  
                  <textarea id="requerimiento" name="requerimiento" class="form-control" rows="4" placeholder="Escriba aqu&iacute; su requerimiento" required></textarea>
                </div>
                <button type="submit" class="btn btn-pill btn-block btn-secondary">Enviar Solicitud</button>                
              </form>
              <div id="RespuestaForm" class="form-group">

              </div>
            </div>
          </div>
        </div>
        <div class="card-footer bg-secondary border-0 text-light">
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