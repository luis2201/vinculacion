<?php  
  
  $peticionAjax = false; 
  
  session_start(['name' => 'VIN']);
  if(isset($_SESSION['usuario_vin'])){    
    switch($_SESSION['tipo_vin']){            
      case 'ADMINISTRADOR':
        header('Location: ../Admin');
        break;
      case 'COORDINADOR':
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

?>
  <div class="container-fluid">
    <div class="col-md-8 mt-5" style="margin: auto;">
      <div class="card shadow-lg" style="border-top-color: #e94e1b; border-top-width: 4px;">
        <div class="card-header">
          <a href="<?php echo __SERVER__; ?>" class="float-left">
            <button type="button" class="btn btn-sm text-primary"><i class="far fa-window-close fa-2x text-dark"></i></button>
          </a>
          <h3>            
            <span class="float-right text-dark font-weight-bold" style="font-family: 'Squada One', cursive; font-size: 35px;"><?php echo __APPNAME__; ?></span>
          </h3>
        </div>
        <div class="card-body">            
          <div class="row">
            <div class="col-md-6">
              <img src="<?php echo __SERVER__.__IMG__; ?>logo-sistema.png" class="img-fluid mx-auto d-block" alt="vinculacion-itsup" style="width:80%">
            </div>
            <div class="col-md-6">
              <div class="alert alert-success text-justify" role="alert">
                <strong>¡Atenci&oacute;n!</strong> Antes de ingresar sus datos en esta pantalla, verifique si la dirección en 
                  la barra superior es segura: <br>
                  <center><strong><i class="fas fa-lock"></i> https://vinculacion.itsup.edu.ec</strong></center>
              </div>
              <form class="frmAction" action="<?php echo __SERVER__; ?>ajax/loginAjax.php" method="POST" data-form="login" enctype="multipart/form-data" autocomplete="off">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                  <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  </div>
                  <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Contrase&ntilde;a">
                </div>
                <button type="submit" class="btn btn-pill btn-block btn-dark">Ingresar</button>
                <a href="#" class="float-right text-dark" style="text-decoration:none;">¿Olvid&oacute; su contrase&ntilde;a?</a>
              </form>
              <div id="RespuestaForm" class="form-group">
  <?php
    $key = hash('sha256', SECRET_KEY);
    $iv = substr(hash('sha256', SECRET_IV), 0, 16);
    $output = openssl_decrypt(base64_decode('ZEdYaER2eEoxZGMwVnZmR2M5TjNDZz09'), METHOD, $key, 0, $iv);   

    echo $output;
?>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer bg-primary border-0 text-light" style="background-color: #4f5157 !important">
          <div class="footer-copyright">
            <span style="font-family: 'Squada One', cursive;">
              © 2020 Copyright:
              <a href="https://itsup.edu.ec/" class="text-light"> Itsup</a>
              <p class="float-right">vinculacion@itsup.edu.ec</p>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>    
  <?php require '../layout/footerlogin.php'; ?>
  <script src="<?php echo __SERVER__.__APP__; ?>login.js"></script>  
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>