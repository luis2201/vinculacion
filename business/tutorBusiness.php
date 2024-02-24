<?php

  if($peticionAjax){
    require_once '../models/tutorModel.php';
  } else{
    require_once '../../models/tutorModel.php';
  }
  
  class TutorBusiness extends tutorModel{

    public function consulta_todos_tutor_business(){
      $procedure = 'tutor_todos()';      
      $result = tutorModel::consulta_todos_tutor_model($procedure);            
      
      return $result->fetchAll();
    }

    public function insert_tutor_business(){         
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
      $result = tutorModel::comprueba_cedula_model($procedure, $param); 
      if($result->rowCount()>0){
        $c = $c+1;
      } 

      $procedure = 'estudiante_comprueba_cedula(?)';
      $param = array(
        $cedula
      );
      $result = tutorModel::comprueba_cedula_model($procedure, $param); 
      if($result->rowCount()>0){
        $c = $c+1;
      }      

      $procedure = 'tutor_comprueba_correo(?)';
      $param = array(
        $correo
      );
      $result = tutorModel::comprueba_correo_model($procedure, $param); 
      if($result->rowCount()>0){
        $r = $r+1;
      } 

      $procedure = 'estudiante_comprueba_correo(?)';
      $param = array(
        $correo
      );
      $result = tutorModel::comprueba_correo_model($procedure, $param); 
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
        $procedure = 'tutor_insert(?,?,?,?,?,?)';
        $param = array(
          $idcarrera,
          $cedula,
          $nombres,
          $apellidos,
          $correo,
          $telefono
        );
  
        $result = tutorModel::insert_tutor_model($procedure, $param);        
        if($result->rowCount()>0){     

          //Creamos la cuenta del usuario
          $procedure = 'usuario_insert(?,?,?,?,?)';
          $nombres = $nombres.' '.$apellidos;
          $usuario = $cedula;
          $contrasena = mainModel::encryption($cedula);
          $fecha_registro =  date("Y") . "/" . date("m") . "/" . date("d");
          $rol = 'TUTOR';
          
          $param = array(            
            $nombres,
            $usuario,
            $contrasena,
            $fecha_registro,
            $rol            
          );        
          $result = tutorModel::insert_usuario_model($procedure, $param);
          //Fin de la creación del usuario

          $alert = [
            "clase"     => 'limpiar',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-check-circle',
            "contenido" => 'Datos del Tutor registrados satisfactoriamente',
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

    public function view_tutor_business(){      
      $idtutor = mainModel::limpiar_cadena($_GET['id']);      
      $idtutor = mainModel::decryption($idtutor);      
      $procedure = 'tutor_view(?)';
      $param = array(
        $idtutor
      );
      $result = tutorModel::view_tutor_model($procedure, $param);

      return $result->fetchAll();
    }

    public function update_tutor_business(){      
      $idtutor = mainModel::limpiar_cadena($_POST['idtutor']);
      $idcarrera = mainModel::limpiar_cadena($_POST['idcarrera']);
      $nombres = mainModel::limpiar_cadena($_POST['nombres']);
      $apellidos = mainModel::limpiar_cadena($_POST['apellidos']);
      $telefono = mainModel::limpiar_cadena($_POST['telefono']);
      $idtutor = mainModel::decryption($idtutor);
      $idcarrera = mainModel::decryption($idcarrera);
      
      $procedure = 'tutor_update(?,?,?,?,?)';
      $param = array(        
        $idtutor,
        $idcarrera,
        $nombres,
        $apellidos,
        $telefono
      );                  
      $result = tutorModel::update_tutor_model($procedure, $param);
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Datos del Tutor actualizados satisfactoriamente',
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

    public function delete_tutor_business(){      
      $idtutor = mainModel::limpiar_cadena($_POST['idtutor']);      
      $idtutor = mainModel::decryption($idtutor);
      
      $procedure = 'tutor_delete(?)';
      $param = array(
        $idtutor
      );
      $result = tutorModel::delete_tutor_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Tutor eliminado satisfactoriamente',
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
        
    public function cambio_estado_tutor_business(){      
      $idtutor = mainModel::limpiar_cadena($_POST['idtutor']);      
      $idtutor = mainModel::decryption($idtutor);
      
      $procedure = 'tutor_cambio_estado(?)';
      $param = array(
        $idtutor
      );
      $result = tutorModel::cambio_estado_tutor_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Se cambi&oacute; el estado del Tutor satisfactoriamente',
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

    public function tutor_estudiante_requerimiento_pendiente_business(){      
      $idtutor = mainModel::limpiar_cadena($_SESSION['usuario_vin']);        
      $procedure = 'tutor_estudiante_requerimiento_pendiente(?)';
      $param = array(
        $idtutor
      );
      $result = tutorModel::tutor_estudiante_requerimiento_pendiente_model($procedure, $param);

      return $result->fetchAll();
    }

    public function tutor_estudiante_requerimiento_solucionado_business(){      
      $idtutor = mainModel::limpiar_cadena($_SESSION['usuario_vin']);        
      $procedure = 'tutor_estudiante_requerimiento_solucionado(?)';
      $param = array(
        $idtutor
      );
      $result = tutorModel::tutor_estudiante_requerimiento_solucionado_model($procedure, $param);

      return $result->fetchAll();
    }

  }

?>