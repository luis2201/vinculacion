<?php
  
  if($peticionAjax){
    require_once '../config/mainModel.php';
  } else{
    require_once '../../config/mainModel.php';
  }  

  class PreguntaModel extends mainModel {        
    
    protected function consulta_todos_pregunta_model($procedure){
      $respt = mainModel::consulta_todos($procedure);

      return $respt;
    }

    protected function comprueba_pregunta_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function insert_pregunta_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function view_pregunta_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }        

    protected function comprueba_update_pregunta_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function update_pregunta_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function cambio_estado_pregunta_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function delete_pregunta_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }        

  }

?>