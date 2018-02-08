<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<script src="/Acomer/web/js/jquery.min.js"></script>
<script src="/Acomer/web/js/sweetalert2.all.min.js"></script>
<script src="/Acomer/web/js/ciclosession.js"></script>

<div class="main">
	<img src="img/plaza.png" alt="" class="img-responsive base">
	<div class="content-mesas">
		<!--DIV DONDE SE CARGAN LAS MESAS-->
		<div id="mesasPlaza">
			
		</div>	

		<!--IDV DONDE SE CARGAN LAS NOTIFICACIONES-->	
		<div>
			<div id="sideOpen">
				
			</div>
			<!--empresa con codigo 901.023.461-1-->
			<div class="containers container__1">
				<div class="notification text_0-9 not-1 full">		
					<div class="menu-trigge">
						<div id="pedidosEmp1">										
						</div>	
					</div>
					<div class="ripple-container">
					</div>			
				</div>
			</div>
	
			<!--empresa con codigo 901.023.461-2-->
			<div class="containers container__2">
				<div class="notification text_0-9 not-1 full">			
					<div class="menu-trigge">
						<div id="pedidosEmp2" >													
						</div>	
					</div>
					<div class="ripple-container">
					</div>				
				</div>
			</div>
			
			<!---->
			<div class="containers container__3">
				<div class="notification text_0-9 not-1 full">			
					<div class="menu-trigge">
						<div id="pedidosEmp3" >													
						</div>	
					</div>
					<div class="ripple-container">
					</div>					
				</div>
			</div>

			<!---->
			<div class="containers container__4">
				<div class="notification text_0-9 not-1 full">			
					<div class="menu-trigge">
						<div id="pedidosEmp4" >													
						</div>	
					</div>
					<div class="ripple-container">
					</div>				
				</div>
			</div>
		</div>
	</div>
</div>
<!--<script>
	$(function sideClose(){
		$(".side-notifications").removeClass("side-visible");
	});
</script>-->
<script type="text/javascript">
	$(document).ready(function() {	    	
    	document.getElementById("idUsuario").innerHTML = "CC."+"<?=Yii::$app->session['cedula']?>";
    	document.getElementById("idPerfil").innerHTML = "<?=ucwords(strtolower($rol))?>";
    });
</script>

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
	var generalMesas;
	var generalempresas;
	var generaldocumentos;
	var generalPuestos;
    var generalPlatos;
    var generalCantidad;
    var generalNombre;
    var generalClickEntregar;
    //
    var array1;
	var array2;
	var array3;
	var array4;
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
                // almacena la cantidad a entregar
                var cantidadPedido = arrayDatos[6];
                // almacena el nombre del plato
                var nombrePedido = arrayDatos[7];

				var notificaciones = notificacionContainer(tamano, numeroMesa, empresaPedido, documentoPedido, puestosPedido, platosPedido, cantidadPedido, nombrePedido);	
				
				//muestros las mesas en la plaza				
				document.getElementById("pedidosEmp1").innerHTML = notificaciones[0]; console.log(notificaciones[0]);
				document.getElementById("pedidosEmp2").innerHTML = notificaciones[1]; console.log(notificaciones[1]);
				document.getElementById("pedidosEmp3").innerHTML = notificaciones[2]; console.log(notificaciones[2]);
				document.getElementById("pedidosEmp4").innerHTML = notificaciones[3]; console.log(notificaciones[3]);
				
				if(estadoPedido[0] == "NO"){					
					$("div.btn-side-close").attr("onClick","platosEntregar(5)");
				}else{
					$("div.btn-side-close").attr("onClick","platosEntregar(0)");
				}
			}
		});
	}setInterval(containerReal, 1000);

	function notificacionContainer(tamano, mesa, empresa, documento, puestos, platos, cantidad, nombre){		
		//
		generalMesas = mesa;
		generalempresas = empresa;
		generaldocumentos = documento;
		generalPuestos = puestos;
        generalPlatos = platos;
        generalCantidad = cantidad;
        generalNombre = nombre;
		//posicion de la notificacion sobre el container
		var contadoremp1 = 0;
		var contadoremp2 = 0;		
		var contadoremp3 = 0;		
		var contadoremp4 = 0;
		// esquemas que se usan para cada container	
		var esquemaemp1 = '';
		var esquemaemp2 = '';
		var esquemaemp3 = '';
		var esquemaemp4 = '';	
		// recorrer los datos aarrojados por el cursor 
		for (var i = 0; i < tamano; i++) {			
			// mostrar la notificacion dependiendo a que empresa pertenece el plato a entregar
			switch(empresa[i]){
				case codigoEmp1:					
					contadoremp1++;
					break;
				case codigoEmp2:
					contadoremp2++;
					break;
				case codigoEmp3:
					contadoremp4++;
					break;
				case codigoEmp4:
					contadoremp4++;
					break;
			}
		}

		// las notificaciones se cargan en un array 
		var array = [contadoremp1,contadoremp2,contadoremp3,contadoremp4];		
		var arrayF = new Array();
		var cantidadNotifi = 0;

		for (var i = 0; i < array.length; i++) {	
			// si el container tiene notificacion
			if(array[i] > 0){
				arrayF[i] = '<img class="img-responsive" src="/Acomer/web/img/notrest.svg" alt="avatar">';
				$("#pedidosEmp"+(i+1)).attr('onclick','platosEntregar('+(i+1)+')');
				cantidadNotifi++;
			}else{
				arrayF[i] = '';
			}
		}		

		if(cantidadNotifi > 0){

			if(!$('#notificacionesDivModal').hasClass('side-visible')){			

				$('#sideClose').addClass('start');
			}else{
				$('#sideClose').removeClass('start');
			}
		}else{
			$('#sideClose').removeClass('start');
		}

		return arrayF;
	}

	function platosEntregar(codigoRestaurantes = 0){	

		console.log(codigoRestaurantes);

		var esquemaEntrega = '';
		
		$('#sideClose').removeClass('start');				

		switch (codigoRestaurantes){
			case 0:
				generalClickEntregar = 0;
				esquemaEntrega = armarEsquema(0);
				break;
			case 1:
				generalClickEntregar = 1;
				esquemaEntrega = armarEsquema(1);
				break;
			case 2:
				generalClickEntregar = 2;
				esquemaEntrega = armarEsquema(2);
				break;
			case 3:
				generalClickEntregar = 3;
				esquemaEntrega = armarEsquema(3);
				break;
			case 4:
				generalClickEntregar = 4;
				esquemaEntrega = armarEsquema(4);
				break;
			case 5:
				generalClickEntregar = 5;				
				break;
		}


		document.getElementById("listaEntrega").innerHTML = esquemaEntrega;
	}

	function armarEsquema(empresa){		
		var esquemaEntrega = '';
		var codEmp;			

		switch (empresa){
			case 0:		
				if($('#notificacionesDivModal').hasClass('side-visible')){					
					codEmp='full';	
				}else{
					pedidosEnlistdos();
					codEmp = '';				
				}	
				break;
			case 1:				
				$('#sideOpen').click();
				codEmp=codigoEmp1;
				break;
			case 2:
				$('#sideOpen').click();
				codEmp=codigoEmp2;
				break;
			case 3:
				$('#sideOpen').click();
				codEmp=codigoEmp3;
				break;
			case 4:
				$('#sideOpen').click();
				codEmp=codigoEmp4;
				break;
		}

		for(var i=0 ; i<generalMesas.length ; i++){

			if((codEmp.localeCompare(generalempresas[i]) == 0) || codEmp == 'full'){

				esquemaEntrega = esquemaEntrega+
					'<div class="list-group-item" id="lgi'+i+'">'+
						'<div class="row-picture" onClick="rowPicture('+i+')">'+
							'<div class="item-icon-pl">'+
								'<div class="not-item-icon"></div>'+
							'</div>'+
							'<div class="item-icon-pe">'+
								'<svg version="1.1" id="iconCheck'+i+'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" style="" xml:space="preserve" class="icon-check">'+

										'<path id="circle" class="circle xokfQlnb_0" d="M36.337,4.991C32.991,3.091,29.124,2,25,2C12.297,2,2,12.297,2,25c0,12.703,10.297,23,23,23'+
										's23-10.297,23-23c0-3.274-0.688-6.385-1.921-9.204"></path>'+

										'<path id="check" class="check xokfQlnb_1" d="M47.599,6.084L26.945,35.449c-0.26,0.37-0.773,0.459-1.144,0.199L11.528,25.609'+
										'c-1.203-0.846-1.493-2.513-0.647-3.716c0.423-0.602,1.051-0.975,1.724-1.092c0.673-0.117,1.39,0.022,1.992,0.445l8.526,5.997'+
										'c0.549,0.386,1.216,0.536,1.878,0.42c0.662-0.115,1.239-0.481,1.625-1.031L43.236,3.015c0.846-1.203,2.513-1.493,3.716-0.647'+
										'C48.154,3.214,48.445,4.881,47.599,6.084z"></path>'+
								'</svg>'+
							'</div>'+
						'</div>'+
						'<div class="row-content" id="rc'+i+'">'+
							'<div class="item-desc">'+
								'<h4 class="list-group-item-heading fnt__Medium">Mesa #'+generalMesas[i]+'</h4>'+
								'<div class="list-group-item-desc">'+
									'<p class="list-group-item-text dis-inline-block">'+generalNombre[i]+'</p>'+
									'<p class="list-group-item-text dis-inline-block pull-right">x'+generalCantidad[i]+'</p>'+
								'</div>'+
							'</div>'+
							'<div class="item-confirm-pe text-center">'+
								'<h4 class="item-confirm-heading fnt__Medium">¿Confirmar entrega?</h4>'+
								'<a href="#" class="btn btn-danger btn-radius btn-inline cancelPe" onClick="cancelPe('+i+')">'+
									'<i class="material-icons">&#xE14C;</i>'+
								'</a>'+
								'<a href="#" class="btn btn-success btn-radius btn-inline aceptPe" onClick="aceptPe('+i+')">'+
									'<i class="material-icons">&#xE876;</i>'+
								'</a>'+
							'</div>'+
						'</div>'+
					'</div>';
			}
		}

		return esquemaEntrega;
	}

	function pedidosEnlistdos(){
		var lista =  ($('div.list-group').children('div'));		
		var arrayConfirm = new Array();

		for(var i=0 ; i<lista.length ; i++){
			if($(lista[i]).hasClass('ok')){
				arrayConfirm.push(lista[i].id.substring(lista[i].id.length-1));
			}
		}

		//====================================================		
		var lista = '';		
		array1 = new Array();
		array2 = new Array();
		array3 = new Array();
		array4 = new Array();

		for(var i=0 ; i<arrayConfirm.length ; i++){
			lista = lista+'<li class="list-group-item" onClick="quitarConfirm('+i+')" id="listConf'+i+'">'+generalNombre[i]+' <font size=2><i>M-'+generalMesas[i]+'</i></font></li>';
			array1.push(generalPuestos[i]);
			array2.push(generalPlatos[i]);
			array3.push(generaldocumentos[i]);
			array4.push(generalempresas[i]);
		}

		if(array1.length > 0){
			swal({
				title: '¿Confirmar platos a entregar?',
				text: 
					'<div>'+
						'<ul class="list-group">'+
							lista+
						'</ul>'+
						'<h4>*NOTA: click sobre plato si desea cancelar esa entrega</h4>'+
					'</div>',
				type: '',
				html:true,
				showCancelButton: true,
				confirmButtonColor: "#5cb85c",
				cancelButtonColor: "#EC4424",
				confirmButtonText: "Si",
				cancelButtonText: "No",
				confirmButtonClass: 'btn btn-success',
				cancelButtonClass: 'btn btn-danger',
				buttonsStyling: false,
				reverseButtons: true
			},function (inputValue) {
		  		if (inputValue === false) {		  			
		  			return false;
		  		}
		  		if (inputValue === true) {	
		  			entregarEnMesa(array1,array2,array3,array4);
		  		}
			  		
				});
			
		}

	}

	function entregarEnMesa(array1,array2,array3,array4){		
		$.ajax({
			url:'<?php echo Url::toRoute(['site/entregarpedido']); ?>',
			method: "GET",
			data: {'puestos':array1,'platos':array2, 'documento':array3,'empresa':array4},	
			success: function (data) {						
				
			}
		});
	}

	function realEntregar(){		
		
		if($('#notificacionesDivModal').hasClass('side-visible')){
			platosEntregar(generalClickEntregar);	
		}

	}

	function quitarConfirm(posicion){

		if(array1.length == 1){			
			$("button.cancel").click();
		}else{
			array1.splice(posicion,1);
			array2.splice(posicion,1);
			array3.splice(posicion,1);
			array4.splice(posicion,1);
			
			document.getElementById("listConf"+posicion).remove();
		}


	}


	var delayInMilliseconds = 3000; //1 second

	setTimeout(function() {
		clickPruebaaaa();
	}, delayInMilliseconds);

	
	function clickPruebaaaa()	{
		$("#pedidosEmp1").click();
	}
</script>


<!--http://localhost:8000/Acomer/web/index.php?r=site%2Fmesa&maxpuestos=4&codigo=1-->