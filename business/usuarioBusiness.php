<?php

  if($peticionAjax){
    require_once '../models/usuarioModel.php';
  } else{
    require_once '../../models/usuarioModel.php';
  }
  
  class UsuarioBusiness extends usuarioModel{

    public function login_usuario_business(){
      $usuario = mainModel::limpiar_cadena($_POST['usuario']);
      $contrasena = mainModel::limpiar_cadena($_POST['contrasena']);

      $contrasena = mainModel::encryption($contrasena);
    
      $procedure = 'usuario_login(?,?)';      
      $param = array(
        $usuario, 
        $contrasena
      );    
      $result = usuarioModel::login_usuario_model($procedure, $param);
      if($result->rowCount()>0){
          $row = $result->fetch();
  
          session_start(['name' => 'VIN']);
          $_SESSION['usuario_vin'] = $row['usuario'];          
          $_SESSION['nombres_vin'] = $row['nombres'];
          $_SESSION['tipo_vin'] = $row['rol'];
          
          $_SESSION['token_vin'] = md5(uniqid(mt_rand(),true));

          switch ($_SESSION['tipo_vin']) {
            case 'ADMINISTRADOR':
              $url = __SERVER__."web-app/Admin/";
              break;
            case 'TUTOR':
              $url = __SERVER__."web-app/Tutor/";
              break;
            case 'ESTUDIANTE':
              $url = __SERVER__."web-app/Estudiante/";
              break;
          }
          $location = '<script>window.location = "'.$url.'";</script>';
          /*$url = __SERVER__."web-app/Admin/";
          $location = '<script>window.location = "'.$url.'";</script>';*/
          
          return $location;
      } else{
          $alert = [
              "clase"     => 'limpiar',
              "titulo"    => 'Alerta del Sistema', 
              "icono"     => 'fas fa-exclamation-circle',
              "contenido" => 'Usuario y/o contraseña incorrecta. Vuelva a intentar.',
              "tipo"      => 'orange',
              "tema"      => 'modern',
          ];
      }      
      return mainModel::display_alert($alert);
    }

    public function logout_usuario_business(){
      session_start(['name' => 'VIN']);
  
      $token = mainModel::decryption($_GET['Token']);
      $param = [
        "Usuario" => $_SESSION['usuario_vin'],
        "Token_S" => $_SESSION['token_vin'],
        "Token_U" => $token
      ];
  
      return usuarioModel::logout_usuario_model($param);
    }

    public function forzar_logout_usuario_controller(){
      session_destroy();  
      session_unset();  
      
      return header("Location: ".SERVERURL."Login");    
    }    

    public function consulta_todos_usuario_business(){
      $procedure = 'usuario_todos()';      
      $result = usuarioModel::consulta_todos_usuario_model($procedure);            
      
      return $result->fetchAll();
    }

    public function insert_usuario_business(){      
      $nombres = mainModel::limpiar_cadena($_POST['nombres']);
      $usuario = mainModel::limpiar_cadena($_POST['usuario']);
      $contrasena = mainModel::limpiar_cadena($_POST['contrasena']);
      $contrasena = mainModel::encryption($contrasena);
      
      $procedure = 'usuario_comprueba(?)';
      $param = array(
        $usuario
      );
      $result = usuarioModel::comprueba_usuario_model($procedure, $param);            
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
        $procedure = 'usuario_insert(?,?,?)';
        $param = array(
          $nombres,
          $usuario,
          $contrasena
        );
  
        $result = usuarioModel::insert_usuario_model($procedure, $param);        
        if($result->rowCount()>0){              
          $alert = [
            "clase"     => 'limpiar',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-check-circle',
            "contenido" => 'Usuario registrado satisfactoriamente',
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

    public function view_usuario_business(){      
      $idusuario = mainModel::limpiar_cadena($_GET['id']);      
      $idusuario = mainModel::decryption($idusuario);      
      $procedure = 'usuario_view(?)';
      $param = array(
        $idusuario
      );
      $result = usuarioModel::view_usuario_model($procedure, $param);

      return $result->fetchAll();
    }

    public function update_usuario_business(){      
      $idusuario = mainModel::limpiar_cadena($_POST['idusuario']);
      $nombres = mainModel::limpiar_cadena($_POST['nombres']);
      $usuario = mainModel::limpiar_cadena($_POST['usuario']);      
      $idusuario = mainModel::decryption($idusuario);
      
      $procedure = 'usuario_update_comprueba(?,?)';
      $param = array(        
        $idusuario,        
        $usuario
      );
      $result = usuarioModel::comprueba_update_usuario_model($procedure, $param);          
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
        $procedure = 'usuario_update(?,?,?)';
        $param = array(
          $idusuario,
          $nombres,
          $usuario          
        );
  
        $result = usuarioModel::update_usuario_model($procedure, $param);              
        if($result->rowCount()>0){              
          $alert = [
            "clase"     => 'alerta',
            "titulo"    => 'Información del Sistema', 
            "icono"     => 'fas fa-check-circle',
            "contenido" => 'Datos del Usuario actualizados satisfactoriamente',
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

    public function delete_usuario_business(){      
      $idusuario = mainModel::limpiar_cadena($_POST['idusuario']);      
      $idusuario = mainModel::decryption($idusuario);
      
      $procedure = 'usuario_delete(?)';
      $param = array(
        $idusuario
      );
      $result = usuarioModel::delete_usuario_model($procedure, $param);                  
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'recargar',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Usuario eliminado satisfactoriamente',
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
        
    public function cambio_estado_usuario_business(){      
      $idusuario = mainModel::limpiar_cadena($_POST['idusuario']);      
      $idusuario = mainModel::decryption($idusuario);
      
      $procedure = 'usuario_cambio_estado(?)';
      $param = array(
        $idusuario
      );
      $result = usuarioModel::cambio_estado_usuario_model($procedure, $param);                  
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

    public function reset_usuario_business(){      
      $idusuario = mainModel::limpiar_cadena($_POST['idusuario']);      
      $usuario = mainModel::decryption($idusuario);
      $contrasena = $idusuario;
      
      $procedure = 'usuario_reset(?,?)';
      $param = array(
        $usuario,
        $contrasena
      );
      $result = usuarioModel::reset_usuario_model($procedure, $param);            
      if($result->rowCount()>0){              
        $alert = [
          "clase"     => 'alerta',
          "titulo"    => 'Información del Sistema', 
          "icono"     => 'fas fa-check-circle',
          "contenido" => 'Se restableci&oacute; la contrase&ntilde;a del Usuario satisfactoriamente',
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