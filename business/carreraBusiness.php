<?php

  if($peticionAjax){
    require_once '../models/carreraModel.php';
  } else{
    require_once '../../models/carreraModel.php';
  }
  
  class CarreraBusiness extends carreraModel{

    public function consulta_todos_carrera_business(){
      $procedure = 'carrera_todos()';      
      $result = carreraModel::consulta_todos_carrera_model($procedure);            
      
      return $result->fetchAll();
    }

    public function insert_carrera_business(){      
      $carrera = mainModel::limpiar_cadena($_POST['carrera']);      
      
      $procedure = 'carrera_comprueba(?)';
      $param = array(
        $carrera
      );
      $result = carreraModel::comprueba_carrera_model($procedure, $param);                  
      if($result->rowCount()>0){      
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-exclamation-circle',
          "contenido" => 'El nombre de usuario ya está en uso',
          "tipo"      => 'orange',
          "tema"      => 'modern'
        ];
      } else{
        $procedure = 'carrera_insert(?)';
        $param = array(
          $carrera
        );
  
        $result = carreraModel::insert_carrera_model($procedure, $param);        
        if($result->rowCount()>0){              
          $alert = [
            "clase"     => 'limpiar',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-check-circle',
            "contenido" => 'Carrera registrada satisfactoriamente',
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

    public function view_carrera_business(){      
      $idcarrera = mainModel::limpiar_cadena($_GET['id']);      
      $idcarrera = mainModel::decryption($idcarrera);      
      $procedure = 'carrera_view(?)';
      $param = array(
        $idcarrera
      );
      $result = carreraModel::view_carrera_model($procedure, $param);

      return $result->fetchAll();
    }

    public function update_carrera_business(){      
      $idcarrera = mainModel::limpiar_cadena($_POST['idcarrera']);
      $carrera = mainModel::limpiar_cadena($_POST['carrera']);      
      $idcarrera = mainModel::decryption($idcarrera);
      
      $procedure = 'carrera_update_comprueba(?,?)';
      $param = array(        
        $idcarrera,
        $carrera
      );
      $result = carreraModel::comprueba_update_carrera_model($procedure, $param);            
      if($result->rowCount()>0){
        $alert = [
          "clase"     => 'limpiar',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-exclamation-circle',
          "contenido" => 'El nombre de la carrera ya está en uso',
          "tipo"      => 'orange',
          "tema"      => 'modern'
        ];
      } else{        
        $procedure = 'carrera_update(?,?)';
        $param = array(
          $idcarrera,
          $carrera          
        );
  
        $result = carreraModel::update_carrera_model($procedure, $param);         
        if($result->rowCount()>0){              
          $alert = [
            "clase"     => 'alerta',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-check-circle',
            "contenido" => 'Datos de la Carrera actualizados satisfactoriamente',
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

    public function delete_carrera_business(){      
      $idcarrera = mainModel::limpiar_cadena($_POST['idcarrera']);      
      $idcarrera = mainModel::decryption($idcarrera);
      
      $procedure = 'carrera_delete(?)';
      $param = array(
        $idcarrera
      );
      $result = carreraModel::delete_carrera_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Carrera eliminada satisfactoriamente',
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
        
    public function cambio_estado_carrera_business(){      
      $idcarrera = mainModel::limpiar_cadena($_POST['idcarrera']);      
      $idcarrera = mainModel::decryption($idcarrera);
      
      $procedure = 'carrera_cambio_estado(?)';
      $param = array(
        $idcarrera
      );
      $result = carreraModel::cambio_estado_carrera_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Se cambió el estado del Usuario satisfactoriamente',
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