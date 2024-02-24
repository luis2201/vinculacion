
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