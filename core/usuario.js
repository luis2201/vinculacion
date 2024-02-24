jQuery.validator.addMethod("letter", function(value, element) {
  return this.optional(element) || /^[a-zA-záéíóúÁÉÍÓÚñÑ ]+$/i.test(value);
}, "Solo letras");

jQuery.validator.addMethod("alphanumeric", function(value, element) {
  return this.optional(element) || /^[a-z0-9]+$/i.test(value);
}, "Alfanumérico");

var validator = $('.frmAction').validate({	
	onfocusout		: false,
	onkeyup				: false,
	onclick				: false,
	focusInvalid	: true,	
	rules: {
	    nombres: {
	      required	: true,
	      letter: true, 
	      maxlength: 255
		},
		usuario: {
	      required	: true, 
	      alphanumeric: true,     
	      minlength: 6,
	      maxlength: 25
		}, 
		contrasena: {
	      required	: true,      
	      minlength: 6,
	      maxlength: 25
	    },
	    confcontrasena: {
	      required	: true,      
	      equalTo: "#contrasena"
		}
	},
	messages: {
	    nombres: {
	      required: "Ingrese nombres",
	      letter: "El campo nombres es de solo texto",
	      maxlength: "El campo nombres admite 255 caracteres"
		},
		usuario: {
	      required: "Ingrese su usuario",
	      alphanumeric: "El campo usuario no admite espacios, tildes, ni caracteres especiales",
	      minlength: "El usuario debe ser una cadena de al menos 6 caracteres",
		  maxlength: "El usuario debe ser un cadena no mayor a 25 caracteres"
		},
		contrasena: {
		  required: "Ingrese su contrase&ntilde;a",
		  minlength: "La contrase&ntilde;a debe ser una cadena de al menos 6 caracteres",
		  maxlength: "La contrase&ntilde;a debe ser un cadena no mayor a 25 caracteres"
	    },
	    confcontrasena: {
	      required: "Ingrese su contrase&ntilde;a",
	      equalTo: "La contrase&ntilde;as debe ser iguales"
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
				title: 'Informaci&oacute;n del Sistema', 
				icon: 'fas fa-exclamation-circle',
				content: errorList[0].message,
				type: 'blue',
			theme: 'modern'				
			});
		}
		this.defaultShowErrors();  		
	}
});

//Aplicando estilo para DataTable
$(document).ready(function() {			
	$('#tbLista').DataTable({			
		language: {
			processing:     "Procesando informaci&oacute;n",
			search:         "Buscar:",
			lengthMenu:     "Mostrando _MENU_ elementos",
			info:           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
			infoEmpty:      "Visualizaci&oacute;n del elemento 0 a 0 en 0 elementos",
			infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
			infoPostFix:    "",
			loadingRecords: "Carga en curso...",
			zeroRecords:    "No hay elementos para mostrar",
			emptyTable:     "No existe informaci&oacute;n disponible para mostrar",
			paginate: {
					first:      "Primero",
					previous:   "Anterior",
					next:       "Siguiente",
					last:       "&Uacute;ltimo"
			},	
		},		
	});
});