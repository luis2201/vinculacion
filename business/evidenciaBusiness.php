<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
  if($peticionAjax){
    require_once '../models/evidenciaModel.php';
  } else{
    require_once '../../models/evidenciaModel.php';
  }
  
  class EvidenciaBusiness extends evidenciaModel{

    public function consulta_evidencia_estudiante_business(){
      $cedula = mainModel::limpiar_cadena($_SESSION['usuario_vin']);
      $procedure = 'evidencia_estudiante_todos(?)';   
      $param = array(
        $cedula        
      );      
      $result = evidenciaModel::consulta_evidencia_estudiante_model($procedure, $param);
      
      return $result->fetchAll();
    }

    public function insert_evidencia_business(){      
      $nombre_file = $_FILES['evidencia']['name'];                        
      //$directorio = $_SERVER['DOCUMENT_ROOT'].'/public/file/evidencias/';
      
      $directorio = '/var/www/uploads/';

      $idsolicitud = mainModel::limpiar_cadena($_POST['idsolicitud']);      
      $fecha = date("Y") . "/" . date("m") . "/" . date("d");
      $evidencia = md5(uniqid()).'.pdf';
      $observacion = mainModel::limpiar_cadena($_POST['observacion']);
      
      $procedure = 'evidencia_insert(?,?,?,?)';
      $param = array(
        $idsolicitud,
        $fecha,
        $evidencia,
        $observacion
      );      
      $result = evidenciaModel::insert_evidencia_model($procedure, $param);          
      
      $filename = $directorio.$evidencia;
      move_uploaded_file($_FILES['evidencia']['tmp_name'],$filename);

      if($result->rowCount()>0){           

        $alert = [
          "clase"     => 'limpiar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Evidencia registrada satisfactoriamente',
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

    public function consulta_evidencia_tutor_estudiante_business(){
      $cedula = mainModel::limpiar_cadena($_SESSION['usuario_vin']);
      $procedure = 'evidencia_tutor_estudiante_todos(?)';   
      $param = array(
        $cedula        
      );      
      $result = evidenciaModel::consulta_evidencia_tutor_estudiante_model($procedure, $param);
      
      return $result->fetchAll();
    }

    public function cambio_estado_evidencia_business(){      
      $evidencia = mainModel::limpiar_cadena($_POST['evidencia']);      
      
      $procedure = 'evidencia_cambio_estado(?)';
      $param = array(
        $evidencia
      );
      
      $result = evidenciaModel::cambio_estado_evidencia_model($procedure, $param);                  
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