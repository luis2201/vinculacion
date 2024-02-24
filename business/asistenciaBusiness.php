<?php

  if($peticionAjax){
    require_once '../models/asistenciaModel.php';
  } else{
    require_once '../../models/asistenciaModel.php';
  }
  
  class AsistenciaBusiness extends asistenciaModel{

    public function consulta_todos_asistencia_business(){
      $procedure = 'solicitud_todos()';      
      $result = asistenciaModel::consulta_todos_asistencia_model($procedure);            
      
      return $result->fetchAll();
    }

    public function insert_asistencia_business(){      
      $fecha =  date("Y") . "/" . date("m") . "/" . date("d");
      $cliente = mainModel::limpiar_cadena($_POST['cliente']);
      $telefono = mainModel::limpiar_cadena($_POST['telefono']);
      $correo = mainModel::limpiar_cadena($_POST['correo']);
      $requerimiento = mainModel::limpiar_cadena($_POST['requerimiento']);
      
      $procedure = 'solicitud_insert(?,?,?,?,?)';
      $param = array(
        $fecha,
        $cliente,
        $telefono,
        $correo,
        $requerimiento
      );
      
      $result = asistenciaModel::insert_asistencia_model($procedure, $param);        
      if($result->rowCount()>0){  
        $mail = new AsistenciaModel();
        $mail->correo_coordinador_asistencia_model($cliente, $telefono, $correo, $requerimiento);           
        $mail->correo_cliente_asistencia_model($correo);
        $alert = [
          "clase"     => 'limpiar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Solcitud de asistencia registrada satisfactoriamente',
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

    public function view_asistencia_business(){      
      $idsolicitud = mainModel::limpiar_cadena($_GET['id']);      
      $idsolicitud = mainModel::decryption($idsolicitud);      
      $procedure = 'solicitud_view(?)';
      $param = array(
        $idsolicitud
      );
      $result = asistenciaModel::view_asistencia_model($procedure, $param);

      return $result->fetchAll();
    }        

    public function select_tutor_carrera_asistencia_business(){
      $idcarrera = mainModel::limpiar_cadena($_POST['idcarrera']);      
      $idcarrera = mainModel::decryption($idcarrera);
      
      $procedure = 'asistencia_tutor_carrera(?)';
      $param = array(
        $idcarrera
      );          
      $result = asistenciaModel::select_tutor_carrera_asistencia_model($procedure, $param);            
      
      return $result->fetchAll();
    } 

    public function select_estudiante_carrera_asistencia_business(){
      $idcarrera = mainModel::limpiar_cadena($_POST['idcarrera']);      
      $idcarrera = mainModel::decryption($idcarrera);
      
      $procedure = 'asistencia_estudiante_carrera(?)';
      $param = array(
        $idcarrera
      );          
      $result = asistenciaModel::select_estudiante_carrera_asistencia_model($procedure, $param);            
      
      return $result->fetchAll();
    }  

    public function insert_asistencia_estudiante_business(){    
      $idsolicitud = mainModel::limpiar_cadena($_POST['idsolicitud']);  
      $idcarrera = mainModel::limpiar_cadena($_POST['idcarrera']);
      $idtipo = mainModel::limpiar_cadena($_POST['idtipo']);
      $idtutor = mainModel::limpiar_cadena($_POST['idtutor']);
      $idestudiante = mainModel::limpiar_cadena($_POST['idestudiante']);
      $fecha =  date("Y") . "/" . date("m") . "/" . date("d");

      $idsolicitud = mainModel::decryption($idsolicitud);
      $idcarrera = mainModel::decryption($idcarrera);
      $idtipo = mainModel::decryption($idtipo);
      $idtutor = mainModel::decryption($idtutor);
      $idestudiante = mainModel::decryption($idestudiante);
      
      $procedure = 'solicitud_estudiante_insert(?,?,?,?,?,?)';
      $param = array(
        $idsolicitud,
        $idcarrera,
        $idtipo,
        $idtutor,
        $idestudiante,
        $fecha
      );

      $result = asistenciaModel::insert_asistencia_estudiante_model($procedure, $param);        
      if($result->rowCount()>0){
        $procedure = 'asistencia_tutor_estudiante_correo(?)';
        $param = array(
          $idsolicitud
        );
        $result = asistenciaModel::asistencia_tutor_estudiante_correo_model($procedure, $param);

        foreach ($result as $row) {          
          $numero = $row['numero'];
          $cliente = $row['cliente'];
          $telefono = $row['telefono'];
          $correo = $row['correo'];
          $requerimiento = $row['requerimiento'];
          $tutor = $row['tutor'];
          $correotutor = $row['correotutor'];
          $estudiante = $row['estudiante'];
          $correoestudiante = $row['correoestudiante'];
        }        
        $mail = new AsistenciaModel();
        $mail->correo_tutor_asistencia_model($numero, $cliente, $telefono, $correo, $requerimiento, $tutor, $correotutor, $estudiante); 
        $mail->correo_estudiante_asistencia_model($numero, $cliente, $telefono, $correo, $requerimiento, $tutor, $estudiante, $correoestudiante); 
        $alert = [
          "clase"     => 'limpiar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Solcitud de asistencia registrada satisfactoriamente',
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

    public function consulta_todos_asistencia_mes_business(){      
      $idmes = mainModel::limpiar_cadena($_POST['idmes']);        
      $procedure = 'solicitud_todos_mes(?)';
      $param = array(
        $idmes
      );
      $result = asistenciaModel::consulta_todos_asistencia_mes_model($procedure, $param);  
      
      return $result->fetchAll();
    }

  }

?>