<?php

  if($peticionAjax){
    require_once '../models/tiporequerimientoModel.php';
  } else{
    require_once '../../models/tiporequerimientoModel.php';
  }
  
  class TipoRequerimientoBusiness extends tiporequerimientoModel{

    public function consulta_todos_tiporequerimiento_business(){
      $procedure = 'tiporequerimiento_todos()';      
      $result = tiporequerimientoModel::consulta_todos_tiporequerimiento_model($procedure);            
      
      return $result->fetchAll();
    }

    public function insert_tiporequerimiento_business(){      
      $tipo = mainModel::limpiar_cadena($_POST['tipo']);      
      $horas = mainModel::limpiar_cadena($_POST['horas']);
      
      $procedure = 'tiporequerimiento_comprueba(?)';
      $param = array(
        $tipo
      );
      $result = tiporequerimientoModel::comprueba_tiporequerimiento_model($procedure, $param);                  
      if($result->rowCount()>0){      
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-exclamation-circle',
          "contenido" => 'El tipo de requerimiento ya existe',
          "tipo"      => 'orange',
          "tema"      => 'modern'
        ];
      } else{
        $procedure = 'tiporequerimiento_insert(?,?)';
        $param = array(
          $tipo,
          $horas
        );
  
        $result = tiporequerimientoModel::insert_tiporequerimiento_model($procedure, $param);        
        if($result->rowCount()>0){              
          $alert = [
            "clase"     => 'limpiar',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-check-circle',
            "contenido" => 'Tipo de Requerimiento registrado satisfactoriamente',
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
      }
  
      return mainModel::display_alert($alert);
    } 

    public function view_tiporequerimiento_business(){      
      $idtipo = mainModel::limpiar_cadena($_GET['id']);      
      $idtipo = mainModel::decryption($idtipo);      
      $procedure = 'tiporequerimiento_view(?)';
      $param = array(
        $idtipo
      );
      $result = tiporequerimientoModel::view_tiporequerimiento_model($procedure, $param);

      return $result->fetchAll();
    }

    public function update_tiporequerimiento_business(){      
      $idtipo = mainModel::limpiar_cadena($_POST['idtipo']);
      $tipo = mainModel::limpiar_cadena($_POST['tipo']);      
      $horas = mainModel::limpiar_cadena($_POST['horas']);      
      $idtipo = mainModel::decryption($idtipo);
      
      $procedure = 'tiporequerimiento_update_comprueba(?,?)';
      $param = array(
        $idtipo,
        $tipo        
      );
      $result = tiporequerimientoModel::comprueba_update_tiporequerimiento_model($procedure, $param);            
      if($result->rowCount()>0){
        $alert = [
          "clase"     => 'limpiar',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-exclamation-circle',
          "contenido" => 'El nombre Tipo de Requerimiento ya existe',
          "tipo"      => 'orange',
          "tema"      => 'modern'
        ];
      } else{        
        $procedure = 'tiporequerimiento_update(?,?,?)';
        $param = array(
          $idtipo,
          $tipo,
          $horas          
        );
  
        $result = tiporequerimientoModel::update_tiporequerimiento_model($procedure, $param);         
        if($result->rowCount()>0){              
          $alert = [
            "clase"     => 'alerta',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-check-circle',
            "contenido" => 'Datos del Tipo de Requerimiento actualizados satisfactoriamente',
            "tipo"      => 'blue',
            "tema"      => 'modern'
          ];
        }else{
          $alert = [
            "clase"     => 'alerta',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-ban',
            "contenido" => 'No se realizaron cambios en los datos de la Carrera seleccionada',
            "tipo"      => 'blue',
            "tema"      => 'modern'
          ];
        }
      }
  
      return mainModel::display_alert($alert);
    }          

    public function delete_tiporequerimiento_business(){      
      $idtipo = mainModel::limpiar_cadena($_POST['idtipo']);      
      $idtipo = mainModel::decryption($idtipo);
      
      $procedure = 'tiporequerimiento_delete(?)';
      $param = array(
        $idtipo
      );
      $result = tiporequerimientoModel::delete_tiporequerimiento_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Tipo de Requerimiento eliminado satisfactoriamente',
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
        
    public function cambio_estado_tiporequerimiento_business(){      
      $idtipo = mainModel::limpiar_cadena($_POST['idtipo']);      
      $idtipo = mainModel::decryption($idtipo);
      
      $procedure = 'tiporequerimiento_cambio_estado(?)';
      $param = array(
        $idtipo
      );
      $result = tiporequerimientoModel::cambio_estado_tiporequerimiento_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Se cambió el estado del Tipo de Requerimiento satisfactoriamente',
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