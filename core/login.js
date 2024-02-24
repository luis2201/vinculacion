var validator = $('.frmAction').validate({	
	onfocusout		: false,
	onkeyup			: false,
	onclick			: false,
	focusInvalid	: true,	
	rules: {
		usuario: {
	      	required	: true,      
	      	minlength	: 4,
	      	maxlength	: 25
		}, 
		contrasena: {
	      required		: true,      
	      minlength		: 6,
	      maxlength		: 25
		}
	},
	messages: {
		usuario: {
	      required	: "Ingrese su usuario",
	      digits	: "El campo usuario sólo admite números",
	      minlength	: "El usuario debe ser una cadena de al menos 4 caracteres",
	      maxlength	: "El usuario debe ser un cadena no mayor a 25 caracteres"
		},
		contrasena: {
	      required	: "Ingrese su contraseña",
	      minlength	: "La contraseña debe ser una cadena de al menos 6 caracteres",
	      maxlength	: "La contraseña debe ser un cadena no mayor a 25 caracteres"
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
				title	: 'Información del Sistema', 
				icon	: 'fas fa-exclamation-circle',
				content	: errorList[0].message,
				type	: 'blue',
				theme	: 'modern'				
			});
		}
		this.defaultShowErrors();  		
	}
});