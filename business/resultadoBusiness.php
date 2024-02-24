<?php

  if($peticionAjax){
    require_once '../models/resultadoModel.php';
  } else{
    require_once '../../models/resultadoModel.php';
  }
  
  class ResultadoBusiness extends resultadoModel{

    public function consulta_resultado_promedio_business(){
      $procedure = 'resultado_promedio()';      
      $result = resultadoModel::consulta_resultado_promedio_model($procedure);            
      
      return $result->fetchAll();
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

  }

?>