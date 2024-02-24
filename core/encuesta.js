var validator = $('.frmAction').validate({	
	onfocusout		: false,
	onkeyup			: false,
	onclick			: false,
	focusInvalid	: true,	
	rules: {
	    pregunta1: {
	      required	: true
		},
		pregunta2: {
	      required	: true
		},
		pregunta3: {
	      required	: true
		},
		pregunta4: {
	      required	: true
		},
		pregunta5: {
	      required	: true
		}
	},
	messages: {
	    pregunta1: {
	      required	: "Seleccione una respuesta para la Pregunta 1"
		},
		pregunta2: {
	      required	: "Seleccione una respuesta para la Pregunta 2"
		},
		pregunta3: {
	      required	: "Seleccione una respuesta para la Pregunta 3"
		},
		pregunta4: {
	      required	: "Seleccione una respuesta para la Pregunta 4"
		},
		pregunta5: {
	      required	: "Seleccione una respuesta para la Pregunta 5"
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