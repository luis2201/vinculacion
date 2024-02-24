<?php
  
  if($peticionAjax){
    require_once '../config/mainModel.php';
  } else{
    require_once '../../config/mainModel.php';
  }  

  class TipoRequerimientoModel extends mainModel {        
    
    protected function consulta_todos_tiporequerimiento_model($procedure){
      $respt = mainModel::consulta_todos($procedure);

      return $respt;
    }

    protected function comprueba_tiporequerimiento_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function insert_tiporequerimiento_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function view_tiporequerimiento_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }        

    protected function comprueba_update_tiporequerimiento_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function update_tiporequerimiento_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function delete_tiporequerimiento_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }    

    protected function cambio_estado_tiporequerimiento_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

  }

?>