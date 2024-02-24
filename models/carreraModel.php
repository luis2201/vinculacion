<?php
  
  if($peticionAjax){
    require_once '../config/mainModel.php';
  } else{
    require_once '../../config/mainModel.php';
  }  

  class CarreraModel extends mainModel {        
    
    protected function consulta_todos_carrera_model($procedure){
      $respt = mainModel::consulta_todos($procedure);

      return $respt;
    }

    protected function comprueba_carrera_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function insert_carrera_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function view_carrera_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }        

    protected function comprueba_update_carrera_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function update_carrera_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function delete_carrera_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }    

    protected function cambio_estado_carrera_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

  }

?>