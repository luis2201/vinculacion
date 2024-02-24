<?php

  if($peticionAjax){
    require_once '../models/encuestaModel.php';
  } else{
    require_once '../../models/encuestaModel.php';
  }
  
  class EncuestaBusiness extends encuestaModel{

  	public function consulta_solicitud_encuesta_business(){      
      $idsolicitud = mainModel::limpiar_cadena($_GET['id']);      
      $idsolicitud = mainModel::decryption($idsolicitud);   

      $procedure = 'encuesta_consulta_solicitud(?)';
      $param = array(
        $idsolicitud
      );
      $result = encuestaModel::consulta_solicitud_encuesta_model($procedure, $param);

      return $result->fetchAll();
    }

    public function consulta_todos_preguntas_business(){
      $procedure = 'preguntas_todos()';      
      $result = encuestaModel::consulta_todos_preguntas_model($procedure);            
      
      return $result->fetchAll();
    }

    public function insert_encuesta_business(){ 
      $fecha = date("Y") . "/" . date("m") . "/" . date("d");    
      $idsolicitud = mainModel::limpiar_cadena($_POST['idsolicitud']);
      $pregunta1 = mainModel::limpiar_cadena($_POST['pregunta1']);  
      $pregunta2 = mainModel::limpiar_cadena($_POST['pregunta2']);  
      $pregunta3 = mainModel::limpiar_cadena($_POST['pregunta3']);  
      $pregunta4 = mainModel::limpiar_cadena($_POST['pregunta4']);    
      $pregunta5 = mainModel::limpiar_cadena($_POST['pregunta5']); 

      $idsolicitud = mainModel::decryption($idsolicitud);

      $procedure = 'encuesta_comprueba(?)';
      $param = array(
        $idsolicitud
      );
      $result = encuestaModel::comprueba_encuesta_model($procedure, $param);    
      if($result->rowCount()>0){      
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-exclamation-circle',
          "contenido" => 'Ud ya ha llenado la encuesta con anterioridad',
          "tipo"      => 'orange',
          "tema"      => 'modern'
        ];
      } else{
        $procedure = 'encuesta_insert(?,?,?,?,?,?,?)';
        $param = array(
          $fecha,
          $idsolicitud,
          $pregunta1,
          $pregunta2,
          $pregunta3,
          $pregunta4,
          $pregunta5,
        );
  
        $result = encuestaModel::insert_encuesta_model($procedure, $param);        
        if($result->rowCount()>0){              
          $alert = [
            "clase"     => 'limpiar',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-check-circle',
            "contenido" => 'Encuesta registrada satisfactoriamente',
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

  }

?>