jQuery.validator.addMethod("letter", function(value, element) {
  return this.optional(element) || /^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/i.test(value);
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
		cedula: {
	     	required	: true,
	     	number		: true,
	     	minlength	: 4, 
	      	maxlength	: 50
		},
	    nombres: {
	     	required	: true,
	     	letter		: true, 
	     	minlength	: 2, 
	      	maxlength	: 255
		},
		apellidos: {
	     	required	: true,
	     	letter		: true, 
	     	minlength	: 2, 
	      	maxlength	: 255
		},
		correo: {
	     	required	: true,
	     	email		: true,	     		     
	      	maxlength	: 300
		},
		telefono: {
	     	required	: true,
	     	number		: true, 
	     	minlength	: 7, 
	      	maxlength	: 10
		}
	},
	messages: {
	    idcarrera: {
	      required	: "Seleccione una Carrera",	      
		},
	    cedula: {
	      required	: "Ingrese el n&uacute;mero de c&eacute;dula",
	      number	: "El campo C&eacute;dula es de solo n&uacute;meros",
	      minlength	: "El campo C&eacute;dula admite m&iacute;nimo 4 caracteres",
	      maxlength	: "El campo C&eacute;dula admite m&aacuteMximo 50 caracteres"
		},
		nombres: {
	      required	: "Ingrese Nombres",
	      letter	: "El campo Nombres es de solo texto",
	      maxlength	: "El campo Nombres admite m&iacute;nimo 2 caracteres",
	      maxlength	: "El campo Nombres admite m&aacute;ximo 100 caracteres"
		},
		apellidos: {
	      required	: "Ingrese Apellidos",
	      letter	: "El campo Apellidos es de solo texto",
	      maxlength	: "El campo Apellidos admite m&iacute;nimo 2 caracteres",
	      maxlength	: "El campo Apellidos admite m&aacute;ximo 100 caracteres"
		},
		correo: {
	      required	: "Ingrese Correo",
	      email		: "Ingrese un correo electr&oacute;nico v&aacute;lido",
	      maxlength	: "El campo Correo admite m&aacute;ximo 300 caracteres"
		},
		telefono: {
	      required	: "Ingrese Tel&eacute;fono",
	      number	: "El campo Tel&eacute;fono es de solo n&uacute;meros",
	      minlength	: "El campo Tel&eacute;fono admite m&iacute;nimo 7 caracteres",
	      maxlength	: "El campo Tel&eacute;fono admite m&aacute;ximo 10 caracteres"
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
			processing 		: "Procesando informaci&oacute;n",
			search 			: "Buscar:",
			lengthMenu 		: "Mostrando _MENU_ elementos",
			info 			: "Mostrando _START_ a _END_ de _TOTAL_ elementos",
			infoEmpty 		: "Visualizaci&oacute;n del elemento 0 a 0 en 0 elementos",
			infoFiltered 	: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
			infoPostFix 	: "",
			loadingRecords	: "Carga en curso...",
			zeroRecords 	: "No hay elementos para mostrar",
			emptyTable 		: "No existe informaci&oacute;n disponible para mostrar",
			paginate: {
				first 		: "Primero",
				previous 	: "Anterior",
				next 		: "Siguiente",
				last 		: "&Uacute;ltimo"
			},	
		},		
	});
});