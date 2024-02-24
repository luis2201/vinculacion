jQuery.validator.addMethod("letter", function(value, element) {
  return this.optional(element) || /^[a-zA-záéíóúÁÉÍÓÚñÑ ]+$/i.test(value);
}, "Solo letras");

jQuery.validator.addMethod("alphanumeric", function(value, element) {
  return this.optional(element) || /^[a-z0-9]+$/i.test(value);
}, "Alfanumérico");

var validator = $('.frmAction').validate({	
	onfocusout		: false,
	onkeyup			: false,
	onclick			: false,
	focusInvalid	: true,	
	rules: {
	    idcarrera: {
	      required	: true	      
		},
		idtipo: {
	      required	: true	      
		},
		idtutor: {
	      required	: true	      
		},
		idestudiante: {
	      required	: true	      
		}
	},
	messages: {
	    idcarrera: {
	      required	: "Seleccione Carrera"	      
		},
		idtipo: {
	      required	: "Seleccione el Tipo de Requerimiento"	      
		},
		idtutor: {
	      required	: "Seleccione Tutor"
		},
		idestudiante: {
	      required	: "Debe seleccionar una Carrera y un Tutor para que se asigne un estudiante en forma aleatoria"
		}
	},	
	errorPlacement: function(error,element){ 
			//error.insertAfter(element);           
	},
	showErrors: function(errorMap, errorList){ 
		var errors = validator.numberOfInvalids();
			if (errors) {
			validator.focusInvalid();
			$.alert({ 
				title	: 'Informaci&oacute;n del Sistema', 
				icon	: 'fas fa-exclamation-circle',
				content	: errorList[0].message,
				type	: 'blue',
				theme	: 'modern'				
			});
		}
		this.defaultShowErrors();  		
	}
});

//Aplicando estilo para DataTable
$(document).ready(function() {			
	$('#tbLista').DataTable({			
		language: {
			processing		: "Procesando informaci&oacute;n",
			search			: "Buscar:",
			lengthMenu		: "Mostrando _MENU_ elementos",
			info 			: "Mostrando _START_ a _END_ de _TOTAL_ elementos",
			infoEmpty		: "Visualizaci&oacute;n del elemento 0 a 0 en 0 elementos",
			infoFiltered 	: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
			infoPostFix 	: "",
			loadingRecords 	: "Carga en curso...",
			zeroRecords 	: "No hay elementos para mostrar",
			emptyTable 		: "No existe informaci&oacute;n disponible para mostrar",
			paginate: {
					first 	: "Primero",
					previous: "Anterior",
					next 	: "Siguiente",
					last 	: "&Uacute;ltimo"
			},	
		},		
	});
});

$('#idcarrera').change(function(){
	idcarrera = $(this).val();
	$("#idtutor option").remove();	
	$("#idestudiante option").remove();	
	$.ajax({		
		type: 'POST',
		url: '../../ajax/selectTutorAjax.php',
		data: {idcarrera : idcarrera},				
		success: function (data) {
			$('#idtutor').html(data);							
		},
		error: function() {
			$('#RespuestaForm').html('errpr');
		}
	});				
});

$('#idtutor').change(function(){
	idcarrera = $('#idcarrera').val();
	$.ajax({		
		type: 'POST',
		url: '../../ajax/selectEstudianteAjax.php',
		data: {idcarrera : idcarrera},				
		success: function (data) {
			$('#idestudiante').html(data);							
		},
		error: function() {
			$('#RespuestaForm').html('errpr');
		}
	});				
});