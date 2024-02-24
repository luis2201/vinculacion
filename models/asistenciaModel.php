<?php
  
  if($peticionAjax){
    require_once '../config/mainModel.php';    
  } else{
    require_once '../../config/mainModel.php';    
  }  

  class AsistenciaModel extends mainModel {        
    
    protected function consulta_todos_asistencia_model($procedure){
      $respt = mainModel::consulta_todos($procedure);
      
      return $respt;
    }    

    protected function insert_asistencia_model($procedure, $param){                
      $respt = mainModel::transaccion($procedure, $param);       

      return $respt;
    }

    protected function view_asistencia_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }        

    protected function select_tutor_carrera_asistencia_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function select_estudiante_carrera_asistencia_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function insert_asistencia_estudiante_model($procedure, $param){            
      $respt = mainModel::transaccion($procedure, $param);

      return $respt;
    }

    protected function correo_coordinador_asistencia_model($cliente, $telefono, $correo, $requerimiento){           
      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );
      $from = "Vinculación ITSUP<vinculacion@itsup.edu.ec>";
      $to = "lupin2201@gmail.com";
      $subject = "Solicitud de Soporte";
      
      $message = "Se ha registrado una solicitud de Soporte con los siguientes datos:
      Cliente  : " .$cliente."
      Teléfono : " .$telefono. "
      Correo   : " .$correo. "
      Detalle  : " .$requerimiento;
      
      $headers = "From:" . $from;
      mail($to,$subject,$message, $headers);
      echo "Solicitud procesada satisfactoriamente";
    }

    protected function correo_cliente_asistencia_model($correo){           
      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );
      $from = "Vinculación ITSUP<vinculacion@itsup.edu.ec>";
      $to = $correo;
      $subject = "Solicitud de Soporte";
      
      $message = "Tu solicitud está siendo procesada. Un representante del equipo de Vinculación se pondrá en contacto contigo.";
      
      $headers = "From:" . $from;
      mail($to,$subject,$message, $headers);
      echo "Solicitud procesada satisfactoriamente";
    }

    protected function asistencia_tutor_estudiante_correo_model($procedure, $param){      
      $respt = mainModel::consulta_algunos($procedure, $param);
      
      return $respt;      
    }

    protected function correo_tutor_asistencia_model($numero, $cliente, $telefono, $correo, $requerimiento, $tutor, $correotutor, $estudiante){
      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );
      $from = "Vinculación ITSUP<vinculacion@itsup.edu.ec>";
      $to = $correotutor;
      $subject = "Solicitud de Soporte";
      
      $message = "Se ha registrado una solicitud de Soporte con los siguientes datos:
      Cliente    : " .$cliente."
      Teléfono   : " .$telefono. "
      Correo     : " .$correo. "
      Detalle    : " .$requerimiento. "
      Tutor      : " .$tutor. "
      Estudiante : " .$estudiante;
      
      $headers = "From:" . $from;
      mail($to,$subject,$message, $headers);
      echo "Solicitud procesada satisfactoriamente";
    }

    protected function correo_estudiante_asistencia_model($numero, $cliente, $telefono, $correo, $requerimiento, $tutor, $estudiante, $correoestudiante){
      ini_set( 'display_errors', 1 );
      error_reporting( E_ALL );
      $from = "Vinculación ITSUP<vinculacion@itsup.edu.ec>";
      $to = $correoestudiante;
      $subject = "Solicitud de Soporte";
      
      $message = "Se ha registrado una solicitud de Soporte con los siguientes datos:
      Cliente    : " .$cliente."
      Teléfono   : " .$telefono. "
      Correo     : " .$correo. "
      Detalle    : " .$requerimiento. "
      Tutor      : " .$tutor. "
      Estudiante : " .$estudiante;
      
      $headers = "From:" . $from;
      mail($to,$subject,$message, $headers);
      echo "Solicitud procesada satisfactoriamente";
    }

    protected function consulta_todos_asistencia_mes_model($procedure, $param){            
      $respt = mainModel::consulta_algunos($procedure, $param);

      return $respt;
    }


  }

?>