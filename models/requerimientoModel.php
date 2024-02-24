<?php
  
  if($peticionAjax){
    require_once '../config/mainModel.php';
  } else{
    require_once '../../config/mainModel.php';
  }  

  class RequerimientoModel extends mainModel {        
    
    protected function comprueba_solicitud_requerimiento_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }

    protected function consulta_todos_requerimiento_model($procedure){
      $respt = mainModel::consulta_todos($procedure);

      return $respt;
    }    

    protected function consulta_pendiente_requerimiento_estudiante_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }

    protected function consulta_solucionado_requerimiento_estudiante_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }

    protected function view_pendiente_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }  

    protected function view_solucionado_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }

    protected function consulta_todos_evidencia_estudiante_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }

    protected function cambio_estado_requerimiento_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function consulta_estado_requerimiento_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }

    protected function consulta_todos_requerimiento_mes_model($procedure, $param){
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }

    protected function delete_requerimiento_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    } 

  }

?>