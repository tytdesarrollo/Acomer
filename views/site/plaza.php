<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="main">
	<img src="img/plaza.png" alt="" class="img-responsive base">
	<div class="content-mesas">
		<!--DIV DONDE SE CARGAN LAS MESAS-->
		<div id="mesasPlaza">
			
		</div>	

		<!--IDV DONDE SE CARGAN LAS NOTIFICACIONES-->	
		<div>
			<!--empresa con codigo 901.023.461-1-->
			<div class="containers container__1" id="pedidosEmp1">
				
			</div>
	
			<!--empresa con codigo 901.023.461-2-->
			<div class="containers container__2" id="pedidosEmp2">
				
			</div>
			
			<!---->
			<div class="containers container__3" id="pedidosEmp3">
				
			</div>

			<!---->
			<div class="containers container__4" id="pedidosEmp4">
				
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var codigoEmp1 = '<?=$container1?>';
	var codigoEmp2 = '<?=$container2?>';
	var codigoEmp3 = '<?=$container3?>';
	var codigoEmp4 = '<?=$container4?>';
</script>
		
<!--Manejo de mesas y sus notificaciones-->
<script type="text/javascript">
	$(tiempoReal());

	function tiempoReal(){
		$.ajax({
			url:'<?php echo Url::toRoute(['site/jsonmesas']); ?>',
			dataType:'json',
			success: function (data) {						
				//cantidad de datos que contiene cada array del json	
				var tamano = Object.keys(data.COD_MESA).length;			
				//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
				var arrayDatos = $.map(data, function(value, index) {
	    			return [value];
				});				
				//
				//console.log(arrayDatos);
				//almaceno los valores pertenecientes al codigo de las mesas
				var codigosMesas = arrayDatos[0];
				//almaceno los valores pertenecientes al estado de las mesas
				var estadosMesas = arrayDatos[1];
				//almaceno los valores pertenecientes al codigo de la empresa a la que pertenecen las mesas
				var empresaMesas = arrayDatos[2];
				//almaceno los valores pertenecientes la posicion de las mesas
				var posicionesMesas = arrayDatos[3];
				//almaceno los valores pertenecientes al codigo de las mesas
				var puestosMesas = arrayDatos[4];	
				//hora de atencion a la mesa
				var atencionMesas = arrayDatos[6];
				//variable que contiene las mesas que se cargan en la plaza
				var mesas;			
				// ejecutamos la carga de las mesas
				mesas = cargarMesas(tamano, codigosMesas, estadosMesas, empresaMesas, posicionesMesas, puestosMesas, atencionMesas);						

				//muestros las mesas en la plaza
				document.getElementById("mesasPlaza").innerHTML = mesas;
			}
		});
	}setInterval(tiempoReal, 1000);

	// funcion que permite montar las mesas en la plaza
	function cargarMesas(tamano, codigosMesas, estadosMesas, empresaMesas, posicionesMesas, puestosMesas, atencionMesas){
		//formato para mostrar las mesas en la plaza
		var esquemaTotal;
		//tipo de notificacion que va a tener la mesa
		var notificacionMesa;
		//imagen de la mesa que se cargar de la mesa
		var imgMesa;
		//complementa el esquema para mostrar las mesas
		for (var i = 0; i < tamano; i++) {
			// ejecuta la funcion de notificacion de mesa
			notificacionMesa = tipoNotificacion(estadosMesas[i], atencionMesas[i], codigosMesas[i]);			
			//
			imgMesa = useImg(i);
			// mesas que se van a mostrar
			esquemaTemporal = 
				'<div class="mesas '+posicionesMesas[i]+'" onClick="escogerPuestos('+puestosMesas[i]+','+estadosMesas[i]+','+codigosMesas[i]+')">'+
				'<img src="img/mesa.svg" alt="" class="img-responsive">'+
					notificacionMesa+
						'<svg width="50" height="60">'+
							imgMesa+
							'</use>'+
						'</svg>'+
					'</div>'+
				'</div>';
			if(!esquemaTotal){
				esquemaTotal = esquemaTemporal;
			}else{
				esquemaTotal = esquemaTotal + esquemaTemporal;
			}					
			
		}

		return esquemaTotal;		
	}

	// funcion que se ejecuta al clickear la mesa 	
	function escogerPuestos(puesto,estado,codigo){		
		var route = "<?php echo Url::toRoute(['site/mesa'])?>";
		//mensaje de confirmacion si la mesa esta ocupada
		if(estado == 0){
			swal({
				  title: "",
				  text: "La mesa esta ocupada, desea ingresar?",
				  type: "info",
				  showCancelButton: true,
				  confirmButtonColor: "#4caf50",
				  confirmButtonText: "Si, ingresar",
				  cancelButtonColor: "#EC4424",
				  cancelButtonText: "No, volver",
				  closeOnConfirm: false,
				  closeOnCancel: false
				},
				function(isConfirm){
				  if (isConfirm) {
				    //redirecciona a la eleccion de puestos en caso de estar vacia la mes o adicinar pedido si ya se encuentra ocupada
					location.href = route+"&codigoM="+codigo+"&estadoM="+estado+"&tamanoM="+puesto;
				  } else {
				    swal("", "Proceso cancelado..", "error");
				  }
				});			
		}else{
			//redirecciona a la eleccion de puestos en caso de estar vacia la mes o adicinar pedido si ya se encuentra ocupada
			location.href = route+"&codigoM="+codigo;
		}
	}
	
	function tipoNotificacion(estado, atencion, codMesa){
		// 0 OCUPADO
		// 1 DISPONIBLE
		
		if(estado == 1){
			// para las mesas de un solo digito
			if(codMesa <= 9){
				return '<div class="notification text_0-9 null">'
			// para las mesas de dole digito
			}else{
				return '<div class="notification text_10-20 null">'
			}
		}else if(estado == 0){
			// el tiempo para la entrega esta sin retrasos
			if(atencion == 'SIN_RETRASO'){
				// para las mesas de un solo digito
				if(codMesa <= 9){
					return '<div class="notification text_0-9 full">'
				// para las mesas de dole digito
				}else{
					return '<div class="notification text_10-20 full">'
				}
			}else{
				// si supera no supera los 15 minutos
				if(atencion <= 15){
					return '<div class="notification text_10-20 warning" >';
				}else{
					return '<div class="notification text_10-20 danger" >';
				}
			}
			
			
		}		
	}

	function useImg(numero){
		var imagen;
		var contador;

		contador = numero + 1;
		imagen = '<use xlink:href="img/notification_icons.svg#not'+contador+'">'
		return imagen;
	}
</script>

<!--Manejo de los container y las notificaciones-->
<script type="text/javascript">
	////////////////////////////////////
	var generalempresas;
	var generaldocumentos;
	var generalPuestos;
    var generalPlatos;
	////////////////////////////////////
	
	$(containerReal());

	function containerReal(){
		$.ajax({
			url:'<?php echo Url::toRoute(['site/jsonpedidos']); ?>',
			dataType:'json',
			success: function (data) {						
				//cantidad de datos que contiene cada array del json	
				var tamano = Object.keys(data.ESTADO).length;			
				//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
				var arrayDatos = $.map(data, function(value, index) {
	    			return [value];
				});				
				//
				
				//almaceno los valores pertenecientes al codigo de las mesas
				var estadoPedido = arrayDatos[0];
				//almaceno los valores pertenecientes al estado de las mesas
				var numeroMesa = arrayDatos[1];
				//almaceno los valores pertenecientes al codigo de la empresa a la que pertenecen las mesas
				var empresaPedido = arrayDatos[2];		
				//almaceno los valores de los pedidos (documento)		
				var documentoPedido = arrayDatos[3];
				// alamcena los valores de los puestos
				var puestosPedido = arrayDatos[4];		
                // almacena los valores de los platos
                var platosPedido= arrayDatos[5];		

				var notificaciones = notificacionContainer(tamano, numeroMesa, empresaPedido, documentoPedido, puestosPedido, platosPedido);	
				
				//muestros las mesas en la plaza
				document.getElementById("pedidosEmp1").innerHTML = notificaciones[0];			
				document.getElementById("pedidosEmp2").innerHTML = notificaciones[1];
				document.getElementById("pedidosEmp3").innerHTML = notificaciones[2];
				document.getElementById("pedidosEmp4").innerHTML = notificaciones[3];
			}
		});
	}setInterval(containerReal, 1000);

	function notificacionContainer(tamano, mesa, empresa, documento, puestos, platos){
		//
		generalempresas = empresa;
		generaldocumentos = documento;
		generalPuestos = puestos;
        generalPlatos = platos;
		// esquemas que se usan para cada container
		var esquemaemp1 = '';
		var esquemaemp2 = '';
		var esquemaemp3 = '';
		var esquemaemp4 = '';
		//posicion de la notificacion sobre el container
		var contadoremp1 = 1;
		var contadoremp2 = 1;		
		var contadoremp3 = 1;		
		var contadoremp4 = 1;		
		//
		var posicionesDisp1 = new Array(0,0,0,0,0);
		var posicionesDisp2 = new Array(0,0,0,0,0);
		var posicionesDisp3 = new Array(0,0,0,0,0);
		var posicionesDisp4 = new Array(0,0,0,0,0);
		// recorrer los datos aarrojados por el cursor 
		for (var i = 0; i < tamano; i++) {			
			// mostrar la notificacion dependiendo a que empresa pertenece el plato a entregar
			switch(empresa[i]){
				case codigoEmp1:					
					// notificacion para las mesas de un digito 
					if(mesa[i] <= 9){	
						// recorrer las cinco notificaciones al tiempo del container y si hay disponibilidad se carga la notificacion	
						for(var j = 0 ; j <posicionesDisp1.length ; j++){
							if(posicionesDisp1[j] != 1){
								esquemaemp1 = esquemaemp1 +
									'<div class="notification text_0-9 not-'+(j+1)+' full" onClick="entregarEnMesa('+i+')">'+
										'<svg width="50" height="60">'+
										  '<use xlink:href="img/notification_icons.svg#not'+mesa[i]+'"></use>'+
										'</svg>'+
									'</div>';
								posicionesDisp1[j] = 1;
								break;
							}
						}										
					// notificacion para las mesas de dos digitos
					}else{
						for(var j = 0 ; j <posicionesDisp1.length ; j++){
							if(posicionesDisp1[j] != 1){
								esquemaemp1 = esquemaemp1 +
									'<div class="notification text_10-20 not-'+(j+1)+' full">'+
										'<svg width="50" height="60">'+
										  '<use xlink:href="img/notification_icons.svg#not'+mesa[i]+'"></use>'+
										'</svg>'+
									'</div>';
								posicionesDisp1[j] = 1;
								break;
							}
						}							
					}
					break;
				case codigoEmp2:
					// notificacion para las mesas de un digito 
					if(mesa[i] <= 9){
						esquemaemp2 = esquemaemp2 +
							'<div class="notification text_0-9 not-'+contadoremp2+' full">'+
								'<svg width="50" height="60">'+
								  '<use xlink:href="img/notification_icons.svg#not'+mesa[i]+'"></use>'+
								'</svg>'+
							'</div>';
						// aumenta 1 mas la posicion de la notificacion
						contadoremp2 = contadoremp2 + 1;
					// notificacion para las mesas de dos digitos
					}else{
						esquemaemp2 = esquemaemp2 +
							'<div class="notification text_10-20 not-'+contadoremp2+' full">'+
								'<svg width="50" height="60">'+
								  '<use xlink:href="img/notification_icons.svg#not'+mesa[i]+'"></use>'+
								'</svg>'+
							'</div>';
						// aumenta 1 mas la posicion de la notificacion
						contadoremp2 = contadoremp2 + 1;
					}
					break;
				case codigoEmp3:
					// notificacion para las mesas de un digito 
					if(mesa[i] <= 9){
						esquemaemp3 = esquemaemp3 +
							'<div class="notification text_0-9 not-'+contadoremp3+' full">'+
								'<svg width="50" height="60">'+
								  '<use xlink:href="img/notification_icons.svg#not'+mesa[i]+'"></use>'+
								'</svg>'+
							'</div>';
						// aumenta 1 mas la posicion de la notificacion
						contadoremp3 = contadoremp3 + 1;
					// notificacion para las mesas de dos digitos
					}else{
						esquemaemp3 = esquemaemp3 +
							'<div class="notification text_10-20 not-'+contadoremp3+' full">'+
								'<svg width="50" height="60">'+
								  '<use xlink:href="img/notification_icons.svg#not'+mesa[i]+'"></use>'+
								'</svg>'+
							'</div>';
						// aumenta 1 mas la posicion de la notificacion
						contadoremp3 = contadoremp3 + 1;
					}
					break;
				case codigoEmp4:
					// notificacion para las mesas de un digito 
					if(mesa[i] <= 9){
						esquemaemp4 = esquemaemp4 +
							'<div class="notification text_0-9 not-'+contadoremp4+' full">'+
								'<svg width="50" height="60">'+
								  '<use xlink:href="img/notification_icons.svg#not'+mesa[i]+'"></use>'+
								'</svg>'+
							'</div>';
						// aumenta 1 mas la posicion de la notificacion
						contadoremp4 = contadoremp4 + 1;
					// notificacion para las mesas de dos digitos
					}else{
						esquemaemp4 = esquemaemp4 +
							'<div class="notification text_10-20 not-'+contadoremp4+' full">'+
								'<svg width="50" height="60">'+
								  '<use xlink:href="img/notification_icons.svg#not'+mesa[i]+'"></use>'+
								'</svg>'+
							'</div>';
						// aumenta 1 mas la posicion de la notificacion
						contadoremp4 = contadoremp4 + 1;
					}
					break;
			}
		}

		// las notificaciones se cargan en un array 
		var array = [esquemaemp1,esquemaemp2,esquemaemp3,esquemaemp4];

		return array;
	}

	function entregarEnMesa(posicion){		
		$.ajax({
			url:'<?php echo Url::toRoute(['site/entregarpedido']); ?>',
			method: "GET",
			data: {'puestos':generalPuestos[posicion],'documento':generaldocumentos[posicion],'empresa':generalempresas[posicion],'platos':generalPlatos[posicion]},	
			success: function (data) {						
				
			}
		});
	}
</script>


<!--http://localhost:8000/Acomer/web/index.php?r=site%2Fmesa&maxpuestos=4&codigo=1-->