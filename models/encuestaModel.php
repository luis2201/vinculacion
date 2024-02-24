<?php
  
  if($peticionAjax){
    require_once '../config/mainModel.php';
  } else{
    require_once '../../config/mainModel.php';
  }  

  class EncuestaModel extends mainModel {        
    
    protected function consulta_solicitud_encuesta_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }
    
    protected function consulta_todos_preguntas_model($procedure){
      $respt = mainModel::consulta_todos($procedure);

      return $respt;
    }

    protected function comprueba_encuesta_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function insert_encuesta_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

  }

?>