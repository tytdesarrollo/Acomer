//fecha de la ultima vez que tuvo una acciom
var fecha1 = new Date();

$(document).ready(function() {
	//cada vez que hay movimiento de mouse o un click (touch)
	$(document).mousemove(function(event) {
		//actualiza la fecha de cada accion
		fecha1 = new Date();		
	});	
});

function tiempoSession(){
	//fecha actual
	var fecha2 = new Date();
	//si la hora tiene doble digito
	if(fecha1.getHours() < 10){
		var date1 = '0'+fecha1.getHours()+':'+fecha1.getMinutes();
	}else{
		var date1 = fecha1.getHours()+':'+fecha1.getMinutes();
	}
	//
	if(fecha2.getHours() < 10){
		var date2 = '0'+fecha2.getHours()+':'+fecha2.getMinutes();
	}else{
		var date2 = fecha2.getHours()+':'+fecha2.getMinutes();
	}
	// calcula las horas y minutos que han transcurrido 
	var tiempos = calcularTiempo(date1,date2);
	// si transcurren mas de 30 min de inactivida la session se cierra 
	if(tiempos[1] >= 30){
		swal({
		  	title: "",
			text: "La sesion ha caducado! ",
			type: "error",
			showCancelButton: false,
			confirmButtonColor: "#4caf50",
			confirmButtonText: "Volver acceder a la aplicación",
			cancelButtonColor: "#EC4424",
			cancelButtonText: "",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){
		  	if (isConfirm) {
			   //url actual
		  		var urlActual = window.location.href;
		  		//posicion  de la vista
		  		var posView = urlActual.search("%2F");
		  		//parametros de la url
		  		var urlParams = urlActual.substring(0,posView+3);

		      	location.href = urlParams+"salida";
		  	}
		});			
      	
				
		
    }

}setInterval(tiempoSession,9000);


function calcularTiempo(horaInicio, horaFin){
	// se declaran las horas de inico y de fin
	inicio = horaInicio; 
	fin = horaFin; 

	//alert(inicio+'|||'+fin);

	// se convierten los datos en enteros y separando las horas de los minutos de la hora inicial
	inicioMinutos = parseInt(inicio.substr(3,2)); 
	inicioHoras = parseInt(inicio.substr(0,2)); 

	// se convierten los datos en enteros y separando las horas de los minutos de la hora final
	finMinutos = parseInt(fin.substr(3,2));  
	finHoras = parseInt(fin.substr(0,2)); 

	//console.log(inicioHoras+' / '+inicioMinutos+'*****'+finHoras+' / '+finMinutos);

	// de restan las diferencias de las horas y minutos por aparte
	transcurridoMinutos = finMinutos - inicioMinutos; 
	transcurridoHoras = finHoras - inicioHoras; 


	if (transcurridoMinutos < 0) {
		transcurridoHoras--;
		transcurridoMinutos = 60 + transcurridoMinutos;
	}


	horas = transcurridoHoras.toString();
	minutos = transcurridoMinutos.toString();

	if (horas.length < 2) {
		horas = "0"+horas;
	}

	if (horas.length < 2) {
		horas = "0"+horas;
	}

	var array = [horas,minutos];

	return array;
}