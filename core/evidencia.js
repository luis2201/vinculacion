jQuery.validator.addMethod("letter", function(value, element) {
  return this.optional(element) || /^[a-zA-záéíóúÁÉÍÓÚñÑ ]+$/i.test(value);
}, "Solo letras");

jQuery.validator.addMethod("numeric", function(value, element) {
  return this.optional(element) || /^[0-9]+$/i.test(value);
}, "Solo números");

jQuery.validator.addMethod("alphanumeric", function(value, element) {
  return this.optional(element) || /^[a-z0-9]+$/i.test(value);
}, "Alfanumérico");

jQuery.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');

var validator = $('.frmAction').validate({	
	onfocusout		: false,
	onkeyup			: false,
	onclick			: false,
	focusInvalid	: true,	
	rules: {
	    idsolicitud: {
	      required	: true,
	      numeric	: true     	      
		},
		evidencia: {	      
	      required	: true,
	      accept	: "application/pdf*",
	      filesize	: 2097152
		},
		observacion: {
	      required	: true,
	      letter	: true	      
		}
	},
	messages: {
	    idsolicitud: {
	      required	: "Seleccione un n&uacute;mero de Solicitud",
	      numeric	: "El capo N&uacute;mero de Solicitud es num&eacute;rico"
		},
		evidencia: {
	      required	: "Debe seleccionar las evidencias que se guardar&aacute;n en el sistema",
          accept 	: "Debe seleccionar un archivo .pdf como evidencia",
	      filesize 	: "El archivo no debe superar los 2 MB",
		},
		observacion: {
	      required	: "Ingrese una Observaci&oacute;n del trabajo realizado",
	      letter	: "El campo Observaci&oacute;n es de solo texto"
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