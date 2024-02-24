<?php
  
  if($peticionAjax){
    require_once '../config/mainModel.php';
  } else{
    require_once '../../config/mainModel.php';
  }  

  class UsuarioModel extends mainModel {
    
    protected function login_usuario_model($procedure, $param){
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }

    protected function logout_usuario_model($param){
      if($param['Usuario']!="" && $param['Token_S']==$param['Token_U']){
        session_destroy();
        session_unset();

        $respuesta = "true";
      } else{
        $respuesta = $param['Usuario'];
      }

      return $respuesta;
    }

    protected function comprueba_usuario_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }
    
    protected function consulta_todos_usuario_model($procedure){
      $respt = mainModel::consulta_todos($procedure);

      return $respt;
    }

    protected function insert_usuario_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function delete_usuario_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }
    
    protected function view_usuario_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }

    protected function comprueba_update_usuario_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function update_usuario_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function cambio_estado_usuario_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

  }

?>