//Enviando los datos del formulario
$('.frmAction').submit(function(event){	
	event.preventDefault();
	
	var x = ($(this).validate());	
	if(x.errorList.length>0){		
		return;
	}
	
	var form = $(this);
	var tipo = form.attr('data-form');
	var accion = form.attr('action');
	var metodo = form.attr('method');
	var respuesta = form.children('.RespuestaForm');
	var msjError="<script>alert('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
	var formdata = new FormData(this);

	var contentAlert;
	if(tipo=="login"){
		contentAlert = "Se procederá procederá a validar la información del usuario en el sistema";
	}else if(tipo=="insert"){
		contentAlert = "Se procederá a guardar la información del usuario en el sistema";
	}else if(tipo=="delete"){
		contentAlert = "Se procederá a eliminar la información del usuario en el sistema";
	}else if(tipo=="update"){
		contentAlert = "Se procederá a actualizar la información del usuario en el sistema";
	}else{
		contentAlert = "Quieres realizar la operación solicitada";
	}

	$.confirm({		
		title   : 'Información del Sistema', 
		icon    : 'fas fa-info-circle',
		content : contentAlert,
		type    : 'blue',
		theme   : 'modern',
		buttons: {
			confirm: {
				text	: 'Continuar',
				action: function () {
					$.ajax({
						type: metodo,
						url: accion,
						data: formdata ? formdata : form.serialize(),
						cache: false,
						contentType: false,
						processData: false,
						success: function (data) {
							$('#RespuestaForm').html(data);							
						},
						error: function() {
							$('#RespuestaForm').html(msjError);
						}
					});					
				}				
			},
			cancel: {				
				text		: 'Cancelar',				
				action	: function () {
					
				}
			}				
		}
	});
});

//Reseteando el formulario
$('#btnCancelar').click(function(event){
	$('.frmAction')[0].reset();
});

//Cerrando sesión y redirigiendo
$('#btnLogout').click(function(event){	
	event.preventDefault();
	var Token = $(this).attr('href');	
	$.confirm({		
		title   : 'Información del Sistema', 
		icon    : 'fas fa-question-circle',
		content : 'Está a punto de salir del sistema. Desea continuar?',
		type    : 'blue',
		theme   : 'modern',
		buttons: {
			confirm: {
				text	: 'Continuar',
				action: function () {
					var loc = window.location;
					var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
					var url = loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));					
						$.ajax({						
						//url: url+'ajax/logoutAjax.php?Token='+Token,						
						url: '../../ajax/logoutAjax.php?Token='+Token,
						success: function (data) {
							console.log(data);
							if(data=="true"){								
								//window.location.href=url+"Login";
								window.location.href = loc;
							} else{
								$.alert({		
									title   : 'Información del Sistema', 
									icon    : 'fas fa-ban',
									content : 'Por el momento no es posible cerrar la sesión. Error! ',
									type    : 'red',
									theme   : 'modern',								
								});
							}							
						},
						error: function() {
							
						}
					});						
				}				
			},
			cancel: {				
				text		: 'Cancelar',				
				action	: function () {
					
				}
			}				
		}
	});
});
