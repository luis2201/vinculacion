<?php

  if($peticionAjax){
    require_once '../models/preguntaModel.php';
  } else{
    require_once '../../models/preguntaModel.php';
  }
  
  class PreguntaBusiness extends preguntaModel{

    public function consulta_todos_pregunta_business(){
      $procedure = 'pregunta_todos()';      
      $result = preguntaModel::consulta_todos_pregunta_model($procedure);            
      
      return $result->fetchAll();
    }

    public function insert_pregunta_business(){      
      $pregunta = mainModel::limpiar_cadena($_POST['pregunta']);      
      
      $procedure = 'pregunta_comprueba(?)';
      $param = array(
        $pregunta
      );
      $result = preguntaModel::comprueba_pregunta_model($procedure, $param);                  
      if($result->rowCount()>0){      
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-exclamation-circle',
          "contenido" => 'La pregunta ya fue registrada con anterioridad',
          "tipo"      => 'orange',
          "tema"      => 'modern'
        ];
      } else{
        $procedure = 'pregunta_insert(?)';
        $param = array(
          $pregunta
        );
  
        $result = preguntaModel::insert_pregunta_model($procedure, $param);        
        if($result->rowCount()>0){              
          $alert = [
            "clase"     => 'limpiar',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-check-circle',
            "contenido" => 'Pregunta registrada satisfactoriamente',
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

    public function view_pregunta_business(){      
      $idpregunta = mainModel::limpiar_cadena($_GET['id']);      
      $idpregunta = mainModel::decryption($idpregunta);      
      $procedure = 'pregunta_view(?)';
      $param = array(
        $idpregunta
      );
      $result = preguntaModel::view_pregunta_model($procedure, $param);

      return $result->fetchAll();
    }

    public function update_pregunta_business(){      
      $idpregunta = mainModel::limpiar_cadena($_POST['idpregunta']);
      $pregunta = mainModel::limpiar_cadena($_POST['pregunta']);      
      $idpregunta = mainModel::decryption($idpregunta);
      
      $procedure = 'pregunta_update_comprueba(?,?)';
      $param = array(        
        $idpregunta,
        $pregunta
      );
      $result = preguntaModel::comprueba_update_pregunta_model($procedure, $param);            
      if($result->rowCount()>0){
        $alert = [
          "clase"     => 'limpiar',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-exclamation-circle',
          "contenido" => 'El texto de la pregunta ya está en uso',
          "tipo"      => 'orange',
          "tema"      => 'modern'
        ];
      } else{        
        $procedure = 'pregunta_update(?,?)';
        $param = array(
          $idpregunta,
          $pregunta          
        );
  
        $result = preguntaModel::update_pregunta_model($procedure, $param);         
        if($result->rowCount()>0){              
          $alert = [
            "clase"     => 'alerta',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-check-circle',
            "contenido" => 'Texto de la Pregunta actualizados satisfactoriamente',
            "tipo"      => 'blue',
            "tema"      => 'modern'
          ];
        }else{
          $alert = [
            "clase"     => 'alerta',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-ban',
            "contenido" => 'No se realizaron cambios en el texto de la Pregunta seleccionada',
            "tipo"      => 'blue',
            "tema"      => 'modern'
          ];
        }
      }
  
      return mainModel::display_alert($alert);
    }      

    public function cambio_estado_pregunta_business(){      
      $idpregunta = mainModel::limpiar_cadena($_POST['idpregunta']);      
      $idpregunta = mainModel::decryption($idpregunta);
      
      $procedure = 'pregunta_cambio_estado(?)';
      $param = array(
        $idpregunta
      );
      $result = preguntaModel::cambio_estado_pregunta_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Se cambió el estado de la Pregunta satisfactoriamente',
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

    public function delete_pregunta_business(){      
      $idpregunta = mainModel::limpiar_cadena($_POST['idpregunta']);      
      $idpregunta = mainModel::decryption($idpregunta);
      
      $procedure = 'pregunta_delete(?)';
      $param = array(
        $idpregunta
      );
      $result = preguntaModel::delete_pregunta_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Pregunta eliminada satisfactoriamente',
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

    public function view_pregunta_texto_business($idpregunta){      
      $idpregunta = mainModel::limpiar_cadena($idpregunta);          
      $procedure = 'pregunta_view(?)';
      $param = array(
        $idpregunta
      );
      $result = preguntaModel::view_pregunta_model($procedure, $param);

      return $result->fetchAll();
    }

  }

?>