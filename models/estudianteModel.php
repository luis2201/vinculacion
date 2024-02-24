<?php
  
  if($peticionAjax){
    require_once '../config/mainModel.php';
  } else{
    require_once '../../config/mainModel.php';
  }  

  class EstudianteModel extends mainModel {        
    
    protected function consulta_todos_estudiante_model($procedure){
      $respt = mainModel::consulta_todos($procedure);

      return $respt;
    }

    protected function comprueba_cedula_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function comprueba_correo_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function insert_estudiante_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function insert_usuario_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function view_estudiante_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }            

    protected function update_estudiante_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function delete_estudiante_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }    

    protected function cambio_estado_estudiante_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function horas_estudiante_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function consulta_todos_estudiante_tutor_model($procedure, $param){
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }

  }

?>