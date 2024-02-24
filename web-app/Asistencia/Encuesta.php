<?php  

  $peticionAjax = false; 
  
  include '../../config/routes.php';
  include '../layout/head.php';

?>
  <div class="container-fluid">
    <div class="col-md-8 mt-5" style="margin: auto;">
      <div class="card shadow-lg" style="border-top-color: #0275d8; border-top-width: 4px;">
        <div class="card-header" style="padding: 0px;">
          <a href="<?php echo __SERVER__; ?>">
            <button type="button" class="btn btn-sm text-primary"><i class="far fa-window-close fa-2x"></i></button>
          </a>
        </div>
        <div class="card-body">            
          <div class="row">
            <div class="col-md">
              <center><h3 style="font-family: 'Squada One', cursive; font-size: 35px;"><strong>Encuesta de Satisfacci&oacute;n</strong></h3></center>
              <div class="form-group" style="margin-top: 30px; margin-bottom: 30px;">
                <?php 
                  $result = $encuesta->consulta_solicitud_encuesta_business();                  
                  if(count($result)==0){
                    echo '<script>window.location="'.__SERVER__.'";</script>';
                  } 
                ?>
              	<form class="frmAction" action="<?php echo __SERVER__; ?>ajax/insertEncuestaAjax.php?>" method="POST" data-form="insert" enctype="multipart/form-data" autocomplete="off">
                  <input type="hidden" id="idsolicitud" name="idsolicitud" value="<?php echo $_GET['id'] ?>">
                <?php
                  $result = $encuesta->consulta_todos_preguntas_business(); 
                  $i = 1;
                  foreach ($result as $row) {
                ?>
                  <div class="form-row">                  
                    <div class="form-group col-md-12">
                      <label>Pregunta <?php echo $i.':'; ?></label>                      
                    </div>
                    <div class="form-group col-md-12">
                      <p><?php echo $row['pregunta']; ?></p>                      
                    </div>
                    <div class="form-group col-md-12 text-center">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pregunta<?php echo $row['idpregunta']; ?>" id="pregunta<?php echo $row['idpregunta']; ?>" value="1">
                        <label class="form-check-label" for="pregunta<?php echo $row['idpregunta']; ?>">1</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pregunta<?php echo $row['idpregunta']; ?>" id="pregunta<?php echo $row['idpregunta']; ?>" value="2">
                        <label class="form-check-label" for="pregunta<?php echo $row['idpregunta']; ?>">2</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pregunta<?php echo $row['idpregunta']; ?>" id="pregunta<?php echo $row['idpregunta']; ?>" value="3">
                        <label class="form-check-label" for="pregunta<?php echo $row['idpregunta']; ?>">3</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pregunta<?php echo $row['idpregunta']; ?>" id="pregunta<?php echo $row['idpregunta']; ?>" value="4">
                        <label class="form-check-label" for="pregunta<?php echo $row['idpregunta']; ?>">4</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="pregunta<?php echo $row['idpregunta']; ?>" id="pregunta<?php echo $row['idpregunta']; ?>" value="5">
                        <label class="form-check-label" for="pregunta<?php echo $row['idpregunta']; ?>">5</label>
                      </div>
                    </div>
                  </div>
                <?php 
                  $i = $i+1;
                } ?>
                  <div class="form-row" style="margin-top: 10px;">                  
                    <div class="form-group col-md-12 text-center">
                      <button type="submit" id="btnEnviar" class="btn btn-md btn-primary"><i class="fas fa-paper-plane"></i> Enviar Encuesta</button> 
                    </div>
                  </div>                
                </form>
                <div id="RespuestaForm"></div>
              </div>
            </div>
          </div>          
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
  <script src="<?php echo __SERVER__.__APP__; ?>encuesta.js"></script> 
  <script src="<?php echo __SERVER__.__APP__; ?>main.js"></script>
</body>
</html>