<?php
  
  if($peticionAjax){
    require_once '../config/mainModel.php';
  } else{
    require_once '../../config/mainModel.php';
  }  

  class EvidenciaModel extends mainModel {        
    
    protected function consulta_evidencia_estudiante_model($procedure, $param){
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }    

    protected function insert_evidencia_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function consulta_evidencia_tutor_estudiante_model($procedure, $param){
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }

    protected function cambio_estado_evidencia_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

  }

?>