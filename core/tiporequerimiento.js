jQuery.validator.addMethod("letter", function(value, element) {
  return this.optional(element) || /^[a-zA-záéíóúÁÉÍÓÚñÑ ]+$/i.test(value);
}, "Solo letras");

jQuery.validator.addMethod("numeric", function(value, element) {
  return this.optional(element) || /^[0-9]+$/i.test(value);
}, "Solo Números");

var validator = $('.frmAction').validate({	
	onfocusout		: false,
	onkeyup			: false,
	onclick			: false,
	focusInvalid	: true,	
	rules: {
	    tipo: {
	      required	: true,
	      letter	: true, 
	      maxlength	: 500
		},
		horas: {
	      required	: true,
	      numeric	: true	      
		}
	},
	messages: {
	    tipo: {
	      required	: "Ingrese el Tipo de Requerimiento",
	      letter	: "El campo Requerimiento es de solo texto",
	      maxlength	: "El campo Requerimiento admite 500 caracteres"
		},
		horas: {
	      required	: "Ingrese el n&uacute;mero de Horas",
	      numeric	: "El campo Horas es de solo n&uacute;meros"	      
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