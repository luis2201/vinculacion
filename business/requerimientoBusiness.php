<?php

  if($peticionAjax){
    require_once '../models/requerimientoModel.php';
  } else{
    require_once '../../models/requerimientoModel.php';
  }
  
  class RequerimientoBusiness extends requerimientoModel{    

    public function comprueba_solicitud_requerimiento_business($idsolicitud){
      $idsolicitud = mainModel::limpiar_cadena($idsolicitud);      
      $idsolicitud = mainModel::decryption($idsolicitud);

      $procedure = 'requerimiento_solicitud_comprueba(?)';      
      $param = array(
        $idsolicitud        
      );
      $result = requerimientoModel::comprueba_solicitud_requerimiento_model($procedure, $param);            
      
      return $result->fetchAll();
    }

    public function consulta_todos_requerimiento_business(){
      $procedure = 'requerimiento_todos()';      
      $result = requerimientoModel::consulta_todos_requerimiento_model($procedure);            
      
      return $result->fetchAll();
    }

    public function consulta_pendiente_requerimiento_estudiante_business(){          
      $cedula = mainModel::limpiar_cadena($_SESSION['usuario_vin']);            

      $procedure = 'requerimiento_estudiante_pendiente(?)';      
      $param = array(
        $cedula
      );
      $result = requerimientoModel::consulta_pendiente_requerimiento_estudiante_model($procedure, $param);            
      
      return $result->fetchAll();
    } 

    public function consulta_solucionado_requerimiento_estudiante_business(){          
      $cedula = mainModel::limpiar_cadena($_SESSION['usuario_vin']);            

      $procedure = 'requerimiento_estudiante_solucionado(?)';      
      $param = array(
        $cedula
      );
      $result = requerimientoModel::consulta_solucionado_requerimiento_estudiante_model($procedure, $param);            
      
      return $result->fetchAll();
    }    

    public function view_pendiente_business(){      
      $idrequerimiento = mainModel::limpiar_cadena($_GET['id']);      
      $idrequerimiento = mainModel::decryption($idrequerimiento);      
      $procedure = 'requerimiento_pendiente_view(?)';
      $param = array(
        $idrequerimiento
      );
      $result = requerimientoModel::view_pendiente_model($procedure, $param);

      return $result->fetchAll();
    }

    public function view_solucionado_business(){      
      $idrequerimiento = mainModel::limpiar_cadena($_GET['id']);      
      $idrequerimiento = mainModel::decryption($idrequerimiento);      
      $procedure = 'requerimiento_resuelto_view(?)';
      $param = array(
        $idrequerimiento
      );
      $result = requerimientoModel::view_solucionado_model($procedure, $param);

      return $result->fetchAll();
    }
    
    public function consulta_todos_evidencia_estudiante_business(){          
      $cedula = mainModel::limpiar_cadena($_SESSION['usuario_vin']);            

      $procedure = 'requerimiento_estudiante_pendiente(?)';      
      $param = array(
        $cedula
      );
      $result = requerimientoModel::consulta_todos_evidencia_estudiante_model($procedure, $param);            
      
      return $result->fetchAll();
    } 

    public function cambio_estado_requerimiento_business(){      
      $idrequerimiento = mainModel::limpiar_cadena($_POST['idrequerimiento']);      
      $idrequerimiento = mainModel::decryption($idrequerimiento);
      
      $procedure = 'requerimiento_cambio_estado(?)';
      $param = array(
        $idrequerimiento
      );

      $result = requerimientoModel::cambio_estado_requerimiento_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'El estado del Requerimiento fue actualizado satisfactoriamente',
          "tipo"      => 'blue',
          "tema"      => 'modern'
        ];
      }else{
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-ban',
          "contenido" => 'Ocurrió un error inesperado. No es posible realizar la operación solicitada',
          "tipo"      => 'red',
          "tema"      => 'modern'
        ];
      }

      return mainModel::display_alert($alert);
    }

    public function consulta_estado_requerimiento_business($numero){          
      $numero = mainModel::limpiar_cadena($numero);            

      $procedure = 'requerimiento_cosulta_estado(?)';      
      $param = array(
        $numero
      );
      $result = requerimientoModel::consulta_estado_requerimiento_model($procedure, $param);            
      
      return $result->fetchAll();
    }

    public function consulta_todos_requerimiento_mes_business(){
      $idmes = mainModel::limpiar_cadena($_POST['idmes']);            

      $procedure = 'requerimiento_todos_mes(?)';      
      $param = array(
        $idmes        
      );
      $result = requerimientoModel::consulta_todos_requerimiento_mes_model($procedure, $param);            
      
      return $result->fetchAll();
    }

    public function delete_requerimiento_business(){      
      $idsolicitud = mainModel::limpiar_cadena($_POST['idsolicitud']);      
      $idsolicitud = mainModel::decryption($idsolicitud);
      
      $procedure = 'solicitud_delete(?)';
      $param = array(
        $idsolicitud
      );
      $result = requerimientoModel::delete_requerimiento_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Solicitud eliminada satisfactoriamente',
          "tipo"      => 'blue',
          "tema"      => 'modern'
        ];
      }else{
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-ban',
          "contenido" => 'Ocurrió un error inesperado. No es posible realizar la operación solicitada',
          "tipo"      => 'red',
          "tema"      => 'modern'
        ];
      }
      
      return mainModel::display_alert($alert);
    }
}

?>