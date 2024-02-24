<?php

  if($peticionAjax){
    require_once '../models/estudianteModel.php';
  } else{
    require_once '../../models/estudianteModel.php';
  }
  
  class EstudianteBusiness extends estudianteModel{

    public function consulta_todos_estudiante_business(){
      $procedure = 'estudiante_todos()';      
      $result = estudianteModel::consulta_todos_estudiante_model($procedure);            
      
      return $result->fetchAll();
    }

    public function insert_estudiante_business(){         
      $idcarrera = mainModel::limpiar_cadena($_POST['idcarrera']);
      $cedula = mainModel::limpiar_cadena($_POST['cedula']);
      $nombres = mainModel::limpiar_cadena($_POST['nombres']);
      $apellidos = mainModel::limpiar_cadena($_POST['apellidos']);
      $correo = mainModel::limpiar_cadena($_POST['correo']);
      $telefono = mainModel::limpiar_cadena($_POST['telefono']);      
      
      $idcarrera = mainModel::decryption($idcarrera);
      $c = 0;
      $r = 0;
      

      $procedure = 'tutor_comprueba_cedula(?)';
      $param = array(
        $cedula
      );
      $result = estudianteModel::comprueba_cedula_model($procedure, $param); 
      if($result->rowCount()>0){
        $c = $c+1;
      } 

      $procedure = 'estudiante_comprueba_cedula(?)';
      $param = array(
        $cedula
      );
      $result = estudianteModel::comprueba_cedula_model($procedure, $param); 
      if($result->rowCount()>0){
        $c = $c+1;
      }

      $procedure = 'tutor_comprueba_correo(?)';
      $param = array(
        $correo
      );
      $result = estudianteModel::comprueba_correo_model($procedure, $param); 
      if($result->rowCount()>0){
        $r = $r+1;
      } 

      $procedure = 'estudiante_comprueba_correo(?)';
      $param = array(
        $correo
      );
      $result = estudianteModel::comprueba_correo_model($procedure, $param); 
      if($result->rowCount()>0){
        $r = $r+1;
      }

      if($c>0){      
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-exclamation-circle',
          "contenido" => 'El n&uacute;mero de c&eacute;dula ya est&aacute; en uso',
          "tipo"      => 'orange',
          "tema"      => 'modern'
        ];
      } else if($r>0){
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-exclamation-circle',
          "contenido" => 'El correo electr&oacute;nico ya est&aacute; en uso',
          "tipo"      => 'orange',
          "tema"      => 'modern'
        ];
      } else{
        $procedure = 'estudiante_insert(?,?,?,?,?,?)';
        $param = array(
          $idcarrera,
          $cedula,
          $nombres,
          $apellidos,
          $correo,
          $telefono
        );
  
        $result = estudianteModel::insert_estudiante_model($procedure, $param);        
        if($result->rowCount()>0){  
          //Creamos la cuenta del usuario
          $procedure = 'usuario_insert(?,?,?,?,?)';
          $nombres = $nombres.' '.$apellidos;
          $usuario = $cedula;
          $contrasena = mainModel::encryption($cedula);
          $fecha_registro =  date("Y") . "/" . date("m") . "/" . date("d");
          $rol = 'ESTUDIANTE';
          
          $param = array(            
            $nombres,
            $usuario,
            $contrasena,
            $fecha_registro,
            $rol            
          );        
          $result = estudianteModel::insert_usuario_model($procedure, $param);
          //Fin de la creación del usuario
          $alert = [
            "clase"     => 'limpiar',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-check-circle',
            "contenido" => 'Datos del Estudiante registrados satisfactoriamente',
            "tipo"      => 'blue',
            "tema"      => 'modern'
          ];
        }else{
          $alert = [
            "clase"     => 'alerta',
            "titulo"    => 'Alerta del Sistema', 
            "icono"     => 'fas fa-ban',
            "contenido" => 'Ocurrió un error inesperado. No es posible realizar la operaci&oacute;n solicitada',
            "tipo"      => 'red',
            "tema"      => 'modern'
          ];
        }        
      }
  
      return mainModel::display_alert($alert);
    } 

    public function view_estudiante_business(){      
      $idestudiante = mainModel::limpiar_cadena($_GET['id']);      
      $idestudiante = mainModel::decryption($idestudiante);      
      $procedure = 'estudiante_view(?)';
      $param = array(
        $idestudiante
      );
      $result = estudianteModel::view_estudiante_model($procedure, $param);

      return $result->fetchAll();
    }

    public function update_estudiante_business(){      
      $idestudiante = mainModel::limpiar_cadena($_POST['idestudiante']);
      $idcarrera = mainModel::limpiar_cadena($_POST['idcarrera']);
      $nombres = mainModel::limpiar_cadena($_POST['nombres']);
      $apellidos = mainModel::limpiar_cadena($_POST['apellidos']);
      $telefono = mainModel::limpiar_cadena($_POST['telefono']);
      $idestudiante = mainModel::decryption($idestudiante);
      $idcarrera = mainModel::decryption($idcarrera);
      
      $procedure = 'estudiante_update(?,?,?,?,?)';
      $param = array(        
        $idestudiante,
        $idcarrera,
        $nombres,
        $apellidos,
        $telefono
      );                  
      $result = estudianteModel::update_estudiante_model($procedure, $param);
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Datos del Estudiante actualizados satisfactoriamente',
          "tipo"      => 'blue',
          "tema"      => 'modern'
        ];
      }else{
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-ban',
          "contenido" => 'No se realizaron cambios en los datos del Estudiante',
          "tipo"      => 'blue',
          "tema"      => 'modern'
        ];
      }
  
      return mainModel::display_alert($alert);
    }          

    public function delete_estudiante_business(){      
      $idestudiante = mainModel::limpiar_cadena($_POST['idestudiante']);      
      $idestudiante = mainModel::decryption($idestudiante);
      
      $procedure = 'estudiante_delete(?)';
      $param = array(
        $idestudiante
      );
      $result = estudianteModel::delete_estudiante_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Estudiante eliminado satisfactoriamente',
          "tipo"      => 'blue',
          "tema"      => 'modern'
        ];
      }else{
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-ban',
          "contenido" => 'Ocurri&oacute; un error inesperado. No es posible realizar la operación solicitada',
          "tipo"      => 'red',
          "tema"      => 'modern'
        ];
      }
      
      return mainModel::display_alert($alert);
    }
        
    public function cambio_estado_estudiante_business(){      
      $idestudiante = mainModel::limpiar_cadena($_POST['idestudiante']);      
      $idestudiante = mainModel::decryption($idestudiante);
      
      $procedure = 'estudiante_cambio_estado(?)';
      $param = array(
        $idestudiante
      );
      $result = estudianteModel::cambio_estado_estudiante_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Se cambi&oacute; el estado del Estudiante satisfactoriamente',
          "tipo"      => 'blue',
          "tema"      => 'modern'
        ];
      }else{
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Alerta del Sistema', 
          "icono"     => 'fas fa-ban',
          "contenido" => 'Ocurri&oacute; un error inesperado. No es posible realizar la operaci&oacute;n solicitada',
          "tipo"      => 'red',
          "tema"      => 'modern'
        ];
      }

      return mainModel::display_alert($alert);
    }

    public function horas_estudiante_business(){      
      $cedula = mainModel::limpiar_cadena($_SESSION['usuario_vin']);      
      
      $procedure = 'estudiante_horas(?)';
      $param = array(
        $cedula
      );
      $result = estudianteModel::view_estudiante_model($procedure, $param);

      return $result->fetchAll();
    }

    public function consulta_todos_estudiante_tutor_business(){
      $tutor = $_SESSION['usuario_vin'];

      $procedure = 'estudiante_tutor_todos(?)';  
      $param = array(
        $tutor
      );
    
      $result = estudianteModel::consulta_todos_estudiante_tutor_model($procedure, $param);            
      
      return $result->fetchAll();
    }


  }

?>