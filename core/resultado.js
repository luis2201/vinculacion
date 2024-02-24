
// chart colors
var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

$(document).ready(function(){	
	grafico1($('#idmes1').val());
	grafico2($('#idmes2').val());
});

$('#idmes1').change(function(){
	grafico1($(this).val());	
});

$('#idmes2').change(function(){
	grafico2($(this).val());	
});

function grafico1(idmes){
	idmes = idmes;	
	var s = 0;
	var p = 0;		       	
	$.ajax({		
		type: 'POST',
		url: '../../ajax/selectResultadoAjax.php',
		data: {idmes : idmes},				
		success: function (result) {						
			var data = jQuery.parseJSON(result);				
			for(var i=0;i<data.length;i++){				
				if(data[i]["estado"]==1){
					s = s + 1;
				} else{
					p = p + 1;
				}				
			} 
			pastel(p, s);			
		},
		error: function() {
			$('#RespuestaForm').html('errpr');
		}
	});				
}                                                                                

function pastel(pendientes, solucionados){	
	var pendientes = pendientes;
	var solucionados = solucionados;			

  /* 3 donut charts */
  var donutOptions = {
    cutoutPercentage: 60, 
    legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
  };

  var chDonutData1 = {
    labels: ['Solucionados', 'pendientes'],
    datasets: [
      {
        backgroundColor: colors.slice(0,2),
        borderWidth: 4,
        data: [solucionados, pendientes]
      }
    ]
  };

  var chDonut1 = document.getElementById("chDonut1");  
  if (chDonut1) {  	  	
    new Chart(chDonut1, {    	
      type: 'pie',
      data: chDonutData1,
      options: donutOptions
    });
  }
}

function grafico2(idmes){	
	idmes = idmes;	
	var r = 0;
	var ep = 0;
	var c = 0;
	var a = 0;
	$.ajax({		
		type: 'POST',
		url: '../../ajax/selectResultado2Ajax.php',
		data: {idmes : idmes},				
		success: function (result) {						
			var data = jQuery.parseJSON(result);					
			for(var i=0;i<data.length;i++){				
				if (data[i]["estado"]==4){
          r = r+1;
        } else if (data[i]["estado"]==3){
          ep = ep + 1;
        } else if (data[i]["estado"]==2){
          c = c + 1;
        } else if (data[i]["estado"]==1){
          a = a + 1;
        }		
			} 
			barras(r, ep, c, a);			
		},
		error: function() {
			$('#RespuestaForm').html('errpr');
		}
	});				
}

function barras(resueltos, enproceso, contactado, asignado){
	var resueltos = resueltos;
  var enproceso = enproceso;
  var contactado = contactado;
  var asignado = asignado;
  /* bar chart */
  var chBar = document.getElementById("chBar");
  if (chBar) {
    new Chart(chBar, {
    type: 'bar',
    data: {
      labels: ["Resueltos", "En Proceso", "Contactado", "Asignado"],
      datasets: [{
        data: [resueltos, enproceso, contactado, asignado],
        backgroundColor: colors.slice(0,4)
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          barPercentage: 0.4,
          categoryPercentage: 2
        }]
      }
    }
    });
  }
}