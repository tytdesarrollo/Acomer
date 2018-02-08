//SE EJECUTA AL INCIAR LA VISTA SABER SI ES UNA MESA YA EN USO O QUE SE VA A USAR 	
	function xVez(){
		//variable que recibe datos get si han de existirlos
		var deMenu = generalPlatos;
		// si hay valores en platos sigue en mesa pidiendo
		if(deMenu != 0){
			//se le asigna el numero de personas que ya se habia seleccionado
			document.getElementById("numPersonas").value = generalTamano;			
			//se carga la mesa
			personasMesa(false);
		}else{
			// estado de la mesa seleccionada
			var estado = '<?=$estadomesa?>';
			//si ya esta ocupada debe crgar la mesa con los puestos seleccionads
			if(estado == 0){
				//se le asigna el numero de personas que ya se habia seleccionado
				document.getElementById("numPersonas").value = generalTamano; 				
				//se carga la mesa
				personasMesa(false);
			}
		}
	}

//CONTROL PARA CREAR AS MESAS DEPEDNDIENDO LA CANTIDAD DE PERSONAS
	function personasMesa(indicador = true){		
		//Se captura el numero de personas que van a ocupar una mesa
		var cantidad = document.getElementById("numPersonas").value;
		//console.log(cantidad);
		var creacion;
		//si las personas superan el limite de 4 pasa a escoger que mesa juntar
		if(cantidad <= 4){
			//ejecuta la creacion de la mesa
			creacion = crearMesa(cantidad);
			//se muestra en el div
			document.getElementById("mesaPuestos4").innerHTML = creacion;
			// oculto el seleccionar puestos
			$(".main-content-select-puestos").removeClass("in");
			$(".main-content-select-puestos").addClass("out");
			//muestro las mesa de 4 puestos 
			$(".main-content-mesa").addClass("in");
			// oculto las mesas con mas o menos puestos que la necesaria
			document.getElementById('mesaPuestos4').style.display = 'block';
			document.getElementById('mesaPuestos6').style.display = 'none';
			document.getElementById('mesaPuestos8').style.display = 'none';
			
		}else{			
			// oculta la seleccion de puesto y muestra la mesa
			$(".main-content-select-puestos").removeClass("in");
			$(".main-content-select-puestos").addClass("out");
			$(".main-content-unir-mesa").addClass("in");
			// si la cantidad varia entre 5 y 6
			if(cantidad >= 5 && cantidad <= 6){
				// oculto las mesas con mas o menos puestos que la necesaria
				document.getElementById('mesaPuestos4').style.display = 'none';
				document.getElementById('mesaPuestos6').style.display = 'block';
				document.getElementById('mesaPuestos8').style.display = 'none';
				// si es verdadero indica que la mesa apenas se va armar
				// de lo contrario ya se ha realizado un pedido y debe cargar la mesa para seguir pidiendo			
				switch(indicador){
					case true:
						$(mesasDisponiblesR());	
						break;
					case false:
						listaOut();
						break;
				}
			}else if(cantidad >= 7 && cantidad <= 8){
				// oculto las mesas con mas o menos puestos que la necesaria
				document.getElementById('mesaPuestos4').style.display = 'none';
				document.getElementById('mesaPuestos6').style.display = 'none';
				document.getElementById('mesaPuestos8').style.display = 'block';
				// si es verdadero indica que la mesa apenas se va armar
				// de lo contrario ya se ha realizado un pedido y debe cargar la mesa para seguir pidiendo			
				switch(indicador){
					case true:
						$(mesasDisponiblesR());	
						break;
					case false:
						listaOut();
						break;
				}
			}
		}
	}	

// DISPONIBILIDAD DE MESAS CUANDO SE VA A UNIR UNA MESA
	function mesasDisponiblesR(){
		$.ajax({
			url: urlUnionMesaDisponible,
			dataType:'json',
			success: function (data) {						
				//cantidad de datos que contiene cada array del json	
				var tamano = Object.keys(data.COD_MESA).length;			
				//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
				var arrayDatos = $.map(data, function(value, index) {
	    			return [value];
				});										
				//almaceno los valores pertenecientes al estado de las mesas
				var estadosMesas = arrayDatos[1];
				
				var mesas = new Array();
				mesas = cargarMesas(estadosMesas);						

				//muestros las mesas en la plaza
				document.getElementById("listaMesas1").innerHTML = mesas[0];
				document.getElementById("listaMesas2").innerHTML = mesas[1];
			}
		});
	}

// CREA LA LISTA DE LAS MESAS QUE ESTAN DISPONIBES PAR UNIR CON OTRA
	function cargarMesas(estado){
		//listado de mesas disponibles del lado izquierdo
		var lista1 = '<ul class="list-mesa__libre text-center">';
		//listado de mesas disponibles del lado derecho 
		var lista2 = '<ul class="list-mesa__libre text-center">';
		//balance de cada lista
		var contador = 0;

		//se crea el listado de las mesas
		for(var i=0 ; i<estado.length ; i++){
			// si estan disponibles se ponen en lista
			if(estado[i] == 1 && (i+1) != generalCodigoM){
				//carga por lado maximo de nueve
				if(contador<9){
					//lista del lado izquierdo 
					lista1 = lista1 + '<li class="mesa__libre" onClick="listaOut('+(i+1)+')">Mesa '+(i+1)+'</li>';
					contador++;
				}else{
					//lista del lado derecho 
					lista2 = lista2 + '<li class="mesa__libre" onClick="listaOut('+(i+1)+')">Mesa '+(i+1)+'</li>';
				}
			}
		}

		lista1 = lista1 + '</ul>';
		lista2 = lista2 + '</ul>';		

		var array = [lista1, lista2];

		return array;
	}

//CREACION DE LAS MESAS CON MAS DE 4 PERSONAS
	function listaOut(codMes,principal = 0){		
		//Se captura el numero de personas que van a ocupar una mesa
		var cantidad = document.getElementById("numPersonas").value;

		if(codMes != undefined){
			$(crearSession(codMes));
		}else{
			//estado de la mesa si ha de tenerlo
			var estado = generalEstadoM;
			//si el estado de la mesa es cero viene de la plaza, si no del menu
			if(estado == 0){
				//identificar con que mesa esta unida 
				codMes = mesasUnidad();
			}else{
				codMes = sessionMesa1;
			}
			
		}

		if(principal == 0){			
			//se crea la mesa
			creacion = crearMesaX(cantidad, codMes);
		}else{			
			//se crea la mesa
			creacion = crearMesaX(cantidad, codMes, principal);			
		}
		
		if(cantidad >= 5 && cantidad <= 6){
			//se muestra en el div
			document.getElementById("mesaPuestos6").innerHTML = creacion;
		}else if (cantidad >= 7 && cantidad <= 8){
			//se muestra en el div
			document.getElementById("mesaPuestos8").innerHTML = creacion;
		}

		$(".main-content-unir-mesa").addClass("out");
		$(".main-content-unir-mesa").removeClass("in");
		$(".main-content-mesa").addClass("in");
	}

//IDENTIFICAR LA MESA SELECCIONADA CON QUE MESA ESTA UNIDA EN CASO DE ESTARLO
	function mesasUnidad(){
		var mesa = generalCodigoM;		
		
		$.ajax({
			url: urlMesasUnidad,
			dataType:'json',
			method: "GET",
			data: {'mesaclick':mesa},
			success: function (data) {						
				//cantidad de datos que contiene cada array del json	
				//var tamano = Object.keys(data.MESCODUNI).length;			
				//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
				var arrayDatos = $.map(data, function(value, index) {
	    			return [value];
				});	
				
				var mesaPrincipal = arrayDatos[1];
				var mesasUnidas = arrayDatos[0];

				// datos de las mesas 
				var arrayDatos2 = $.map(mesasUnidas, function(value, index) {
	    			return [value];
				});
				
				if(generalTamano >= 5 && generalTamano <= 6){
					// mesa ue esta unida para 6 puestos
					var mesaUnida1 = arrayDatos2[0];					
				}

				generalMesaPrinc = mesaPrincipal;

				listaOut(mesaUnida1,mesaPrincipal);


			}
		});		
	}

//CREA A VARIABLE DE SESION PARA GUARGAR LA MESA QUE SE UNIO
	function crearSession(mesaSeleccionada1 = 0, mesaSeleccionada2 = 0){		
		// tamano de la mesa que se carga		
		var tamano = document.getElementById("numPersonas").value;
		var mesa1 = mesaSeleccionada1;
		var mesa2 = mesaSeleccionada2;


		//console.log(mesas[0]);
		$.ajax({
			url: urlSessionMesaUnida,
			method: "GET",
			data: {'tamano':tamano, 'mesa1':mesa1},
			success: function (data) {			
				
			}
		});
	}

//AL SELECCIONAR MAS DE 4 PERSONAS MUESTRA EL DIV DE SELECCION DE OTRA MESA PARA UNIR
	function mesaOut(){
		$(".main-content-unir-mesa").addClass("in");
		$(".main-content-mesa").addClass("out");
	}

//CREA L MESA PARA 4 O MENOS PERSONAS
	function crearMesa(cantidad){
		//varible que contendra los datos de la mesa con los puests que se va a crear
		var crearMesa = '';

		if(cantidad <= 4){
			//se crea la mesa 
			crearMesa = 
				'<div class="content-mesa">'+
					'<img src="img/mesa_4_puestos.svg" alt="Mesa 4 puestos" class="img-responsive">'+					
					'<div class="n-mesa">'+
						'<span>#'+generalCodigoM+'</span>'+
					'</div>'+
				'</div>';

			for (var i=0 ; i<4 ; i++){
				crearMesa = crearMesa +
					'<div class="content__puesto-'+(i+1)+'" id="avatarPuesto'+(i+1)+'">'+							
						'<img src="img/puesto_left.svg" alt="Puesto '+(i+1)+'" class="img-responsive" id="imgPersona+'+(i+1)+'">'+						
						'<div class="puesto-libre" data-toggle="modal" data-target="#personajesModal">'+
							'<div class="cnt"  onClick="seleccionaPersona('+(i+1)+')">'+
								'<span class="txt-puesto">Puesto</br>#'+(i+1)+'</span>'+
							'</div>'+
						'</div>'+
					'</div>';
			}
		}                

		return crearMesa;
	}

// CREA LAS MESAS QUE TIENE MAS DE 4 PERSONAS
	function crearMesaX(cantidad,codMes, principal = generalCodigoM){				
		//varible que contendra los datos de la mesa con los puests que se va a crear
		var crearMesa = '';
		//console.log('<?=$codigomesa?>');
		if(cantidad >= 4 && cantidad <= 6){	
			//
			if(generalEstadoM == 0){
				document.getElementById("tituloMesa61").innerHTML = "Mesa "+principal;
				document.getElementById("tituloMesa62").innerHTML = "Mesa "+codMes;
				generalMesaPrinc = principal;
				if(Array.isArray(codMes)){
					generalMesa1 = codMes[0];
				}else{
					generalMesa1 = codMes;
				}			
				
			}
			// se genera la mesa con los 6 puestos
			crearMesa = 
				'<div class="content-mesa">'+					
					imgMesa6Puestos+			
					'<div class="n-mesa">'+
						'<span>#'+principal+'</span>'+
					'</div>'+
					'<div class="n-mesa">'+
						'<span id="mesaPrincipalSpan">#'+codMes+'</span>'+
					'</div>'+
				'</div>';

			for(var i=0 ; i<6 ; i++){
				crearMesa = crearMesa+
					'<div class="content__puesto-'+(i+1)+'" id="avatarPuesto'+(i+1)+'">'+
						'<img src="img/puesto_left.svg" alt="Puesto '+(i+1)+'" class="img-responsive" id="imgPersona'+(i+1)+'">'+
						'<div class="puesto-libre" data-toggle="modal" data-target="#personajesModal">'+
							'<div class="cnt" onClick="seleccionaPersona('+(i+1)+')">'+
								'<span class="txt-puesto">Puesto</br>#'+(i+1)+'</span>'+
							'</div>'+
						'</div>'+
					'</div>';
			}				
		}else if(cantidad >= 7 && cantidad <= 8){
			crearMesa = 
				'<div class="content-puestos mesax8p">'+
					'<div class="content-scroll-mesa">'+
						'<div class="content-mesa">'+
							imgMesa8Puestos+
							'<div class="n-mesa">'+
								'<span>#1</span>'+
							'</div>'+
							'<div class="n-mesa">'+
								'<span>#2</span>'+
							'</div>'+
							'<div class="n-mesa">'+
								'<span>#3</span>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-1">'+
							imgMesa8PuestoL+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#1</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-2">'+
							imgMesa8PuestoT+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#2</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-3">'+
							imgMesa6PuestoB+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#3</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-4">'+
							imgMesa8PuestoB+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#4</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-5">'+
							imgMesa8PuestoB+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#5</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-6">'+
							imgMesa8PuestoB+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#6</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-7">'+
							imgMesa8PuestoB+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#7</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-8">'+
							imgMesa8PuestoB+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#8</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>';
		}

		return crearMesa;
	}

// CARGA DE LOS AVATAR EN LAS MESAS
	function avatarsG(){
		//captura el valor de los avatar
		var avatar = avatarPhp;		
		// varuable donde se van a tener los avatar en array
		var arrayAvatar;
		// si es la rimera vez que abre la mesa
		if(generalEstadoM == 1){
			// si es diferente de cero (si hay un avatar)
			if(avatar != 0){
				//separo los avatar en array
				arrayAvatar = crearArray(avatar);			
				//recorre los avatares por puesto
				for(var i=0 ; i<arrayAvatar.length ; i++){
					// separo el puesto y la imagen 
					var puesto = arrayAvatar[i].substring(arrayAvatar[i].length-1);
					var img = arrayAvatar[i].substring(0,arrayAvatar[i].length-1);
					// creo la imgrn html 
					if(generalTamano <= 4){
						var imgAvatar = '<img src="img/personajes/'+img+'.svg" alt="Puesto '+puesto+'" class="img-responsive" id="imgPersona+'+puesto+'" onClick="hacerPedido('+puesto+')">';
					}else if(generalTamano >= 4 && generalTamano <= 6){
						var imgAvatar = '<img src="img/personajes/'+img+'.svg" alt="Puesto '+puesto+'" class="img-responsive" id="imgPersona+'+puesto+'" onClick="hacerPedidoX('+puesto+','+generalCodigoM+')">';
					}
					// imprimo en pantalla el avatar ya seleccionado 
					document.getElementById("avatarPuesto"+puesto).innerHTML = imgAvatar;				
				}

			}		
		}else{

			if(avatar != 0){
				//separo los avatar en array
				arrayAvatar = crearArray(avatar);			
				//recorre los avatares por puesto
				for(var i=0 ; i<arrayAvatar.length ; i++){					
					// separo el puesto y la imagen 
					var puesto = arrayAvatar[i].substring(arrayAvatar[i].length-1);
					var img = arrayAvatar[i].substring(0,arrayAvatar[i].length-1);
					// creo la imgrn html 
					if(generalTamano <= 4){
						var imgAvatar = '<img src="img/personajes/'+img+'.svg" alt="Puesto '+puesto+'" class="img-responsive" id="imgPersona+'+puesto+'" onClick="hacerPedido('+puesto+')">';
					}else if(generalTamano >= 4 && generalTamano <= 6){
						var imgAvatar = '<img src="img/personajes/'+img+'.svg" alt="Puesto '+puesto+'" class="img-responsive" id="imgPersona+'+puesto+'" onClick="hacerPedidoX('+puesto+','+generalCodigoM+')">';
					}
					// imprimo en pantalla el avatar ya seleccionado 
					document.getElementById("avatarPuesto"+puesto).innerHTML = imgAvatar;				
				}
			}
			
			$.ajax({
				url: urlAvatars,	
				dataType:'json',								
				method: "GET",
				data: {'mesa':generalCodigoM},
				success: function (data) {	
					//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
					var arrayDatos = $.map(data, function(value, index) {
		    			return [value];
					});		
					
					var arrPuestos = arrayDatos[0];
					var arrAvatar = arrayDatos[1];						

					for(var i=0 ; i<arrPuestos.length ; i++){

						if(generalTamano <= 4){
							var imgAvatar = '<img src="img/personajes/'+arrAvatar[i]+'" alt="Puesto '+arrPuestos[i]+'" class="img-responsive" id="imgPersona+'+puesto+'" onClick="hacerPedido('+arrPuestos[i]+')">';	
						}else if(generalTamano >= 4 && generalTamano <= 6){
							var imgAvatar = '<img src="img/personajes/'+arrAvatar[i]+'" alt="Puesto '+arrPuestos[i]+'" class="img-responsive" id="imgPersona+'+puesto+'" onClick="hacerPedidoX('+arrPuestos[i]+','+generalMesaPrinc+')">';
						}
						// imprimo en pantalla el avatar ya seleccionado 
						document.getElementById("avatarPuesto"+arrPuestos[i]).innerHTML = imgAvatar;	
					}
				}
			});			
		}

		generalAvatarsDb = avatar;
	}

//CANCELAR EL AVATAR SELECCIONADO AL MOMENTO DE CANCELAR TODO LO PEDIDO DE UN PUESTO
	function cancelarAvatar(puesto){
		var getNew = crearArray(generalAvatars);
		var puestoAvatar;
		for(var i=0 ; i<getNew.length ; i++){

			puestoAvatar = getNew[i].substr(getNew[i].length-1)

			if(puestoAvatar.localeCompare(puesto) == 0){
				getNew.splice(i,1);
				break;
			}
		}

		if(getNew.length == 0){
			generalAvatars = 0;
		}else{
			console.log(arrayToChar(getNew));
		}


		var nuevoAvatar =
			'<img src="img/puesto_left.svg" alt="Puesto '+puesto+'" class="img-responsive" id="imgPersona+'+puesto+'">'+						
			'<div class="puesto-libre" data-toggle="modal" data-target="#personajesModal">'+
				'<div class="cnt"  onClick="seleccionaPersona('+puesto+')">'+
					'<span class="txt-puesto">Puesto</br>#'+puesto+'</span>'+
				'</div>'+
			'</div>';

		document.getElementById("avatarPuesto"+puesto).innerHTML = nuevoAvatar;	
	}

//RECONFIRMACION DEL AVATAR SELECCIONADO PARA EL PUESTO
	function arrayAvatar(avatar,puesto){
		swal({
			title: '',
			text: 
				'<div class="container">'+
					'<div class="row">'+
						'<div class="col-sm-2"><img src="img/personajes/u'+avatar+'.svg" width="120" height="120"></div>'+
						'<div class="col-sm-3"><br/><h3>Confirmar el avatar seleccionado</h3></div>'+
					'</div>'+
				'<div>',
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
	  		if (inputValue === false) return false;
	  		if (inputValue === true) {	
	  			if(generalAvatars == 0){
					generalAvatars = avatar+puesto;
				}else{
					generalAvatars = generalAvatars+","+avatar+puesto;
				}
				
				if(generalTamano <= 4){
					hacerPedido(puesto);
				}else if(generalTamano >= 5 && generalTamano <= 6){
					if(generalEstadoM == 1){
						hacerPedidoX(puesto,generalCodigoM);
					}else{
						hacerPedidoX(puesto,generalMesaPrinc);
					}
				}
	  		}
		  		
			});
		
	}

// RECUADRO CON LOS POSIBLES AVTARS A SELECCIONAR Y EL CAMIO DEL CLICK DE CADA AVATAR DEPENDIENDO DEL PUESTO DONDE FUE CLICKEADO
	function seleccionaPersona(puesto){
		// muestra los 
		showAvatars();

		$("#pervi1").attr('onclick', 'arrayAvatar("viejo1",'+(puesto)+')');
		$("#perad1").attr('onclick', 'arrayAvatar("adulto1",'+(puesto)+')');
		$("#perni1").attr('onclick', 'arrayAvatar("nino1",'+(puesto)+')');
		$("#pervi2").attr('onclick', 'arrayAvatar("viejo2",'+(puesto)+')');
		$("#perad2").attr('onclick', 'arrayAvatar("adulto2",'+(puesto)+')');
		$("#perni2").attr('onclick', 'arrayAvatar("nino2",'+(puesto)+')');
	}

// FUNCION QUE SE EJECUTA AL CLICKEAR UNO DE LOS PUESTO PARA POSTERIORMNTE HACR UN PEDIDO AL PUESTO SELECCIONADO EN MESA DE 4 PERSONAS
	function hacerPedido(puesto){
		//identificar si es la primera vez que se ordena en mesa
		var pedidoAcumu = generalPlatos;
		//ruta para cargar el menu
		var url = urlMenuNew;
		//cantidad e personas que pueden ordenar
		var tamano = document.getElementById("numPersonas").value;
		// si el pedido acumulado es cero parte como primer pedido a realizar en mesa
		if(pedidoAcumu == 0){			
			location.href = url+"&puesto="+puesto+'&codigoM='+generalCodigoM+'&tamanoM='+tamano+'&estadoM='+'<?=$estadomesa?>'+'&avatars='+generalAvatars;
		}else{
			location.href = url+"&puesto="+puesto+'&codigoM='+generalCodigoM+'&tamanoM='+tamano+'&estadoM='+'<?=$estadomesa?>'+
							    "&platos="+generalPlatos+'&cantidad='+generalCantidad+'&puestos='+generalPuestos+'&avatars='+generalAvatars;
		}
	}

// FUNCION QUE SE EJECUTA AL CLICKEAR UNO DE LOS PUESTO PARA POSTERIORMNTE HACR UN PEDIDO AL PUESTO SELECCIONADO EN MESA DE MAS DE 4 PERSONAS
	function hacerPedidoX(puesto, mesa){
		//tamano de personas que pueden ordernar		
		var tamano = document.getElementById("numPersonas").value;
		//identificar si es la primera vez que se ordena en mesa
		var pedidoAcumu = generalPlatos;
		//ruta para cargar el menu
		var url = urlMenuNew;
		//cantidad e personas que pueden ordenar
		var tamano = document.getElementById("numPersonas").value;
		// si el pedido acumulado es cero parte como primer pedido a realizar en mesa
		if(pedidoAcumu == 0){			
			location.href = url+"&puesto="+puesto+'&codigoM='+mesa+'&tamanoM='+tamano+'&estadoM='+'<?=$estadomesa?>'+'&avatars='+generalAvatars;
		}else{
			location.href = url+"&puesto="+puesto+'&codigoM='+mesa+'&tamanoM='+tamano+'&estadoM='+'<?=$estadomesa?>'+
							    "&platos="+generalPlatos+'&cantidad='+generalCantidad+'&puestos='+generalPuestos+'&avatars='+generalAvatars;
		}		
	}

//REALIZA EL PEDIDO O LO ADICIONA
	function realizarPedido(){
		//datos en texto plano de los platos la cantidad y el puesto
		var platos = generalPlatos;
		var cantidad = generalCantidad;
		var puestos = generalPuestos;
		var mesa = generalCodigoM;
		var estado = generalEstadoM;
		var avatar = generalAvatarsDb;
		//datos en array 
		var arrplatos = crearArray(platos);
		var termino = arrplatos.length;
		//cantidad de personas seleccionadas
		var cantidadPuestos = document.getElementById("numPersonas").value;
		
		// si hay pedidos para confirmar se hace el pedido si no sale error
		if(platos != 0){
			if(cantidadPuestos <= 4){
				if(estado != 0){				
					$.ajax({
						url: urlRealizarPedido,
						dataType:'json',
						method: "GET",
						data: {'puestos':puestos, 'platos':platos , 'cantidad':cantidad, 'termino':termino , 'mesa':mesa, 'avatar':avatar},			
						success: function (data) {						
							
						}
					});
				}else{				
					$.ajax({
						url: urlAdicionarPedido,
						dataType:'json',
						method: "GET",
						data: {'puestos':puestos, 'platos':platos , 'cantidad':cantidad, 'termino':termino , 'mesa':mesa, 'avatar':avatar},			
						success: function (data) {						
							
						}
					});
				}
			}else if(cantidadPuestos >= 5 && cantidadPuestos <= 6){				
				if(estado != 0){				
					if(pedidoMesasPuestas(cantidadPuestos, puestos)){
						$.ajax({
							url: urlRealizarPedidoX,
							dataType:'json',
							method: "GET",
							data: {'puestos1':puestos, 'platos1':platos , 'cantidad1':cantidad, 'termino1':termino , 'mesa1':mesa, 
								   'mesa2':generalMesa1, 'tamano':0, 'avatar':avatar},			
							success: function (data) {						
								
							}
						});
					}else{
						mensajeAlerta(3);
					}
				}else{				
					$.ajax({
						url: urlAdicionarPedidoX,
						dataType:'json',
						method: "GET",
						data: {'puestos1':puestos, 'platos1':platos , 'cantidad1':cantidad, 'termino1':termino , 'mesa1':generalMesaPrinc, 
							   'mesa2':generalMesa1, 'tamano':0},			
						success: function (data) {						
							
						}
					});
				}
				
			}
		}else{
			// mensaje de alerta
			mensajeAlerta(1);
		}
	}

//CONTADOR DE PEDIDOS PARA LAS MESAS QUE ESTAN UNIDAS
	function pedidoMesasPuestas(tamanoPuestos, puestosPedido){
		if(tamanoPuestos >= 5 && tamanoPuestos <= 6){
			//
			var puestoValidar = crearArray(puestosPedido);
			var contMesa1 = 0;
			var contMesa2 = 0;

			for (var i = 0; i < puestoValidar.length; i++) {
				if(puestoValidar[i] == "1" || puestoValidar[i] == "2" || puestoValidar[i] == "6"){
					contMesa1++;
				}else if(puestoValidar[i] == "3" || puestoValidar[i] == "4" || puestoValidar[i] == "5"){
					contMesa2++;
				}
			}

			if(contMesa1 == 0 || contMesa2 == 0){
				return false;
			}else{
				return true;
			}

		}
	}

//VER LO QUE SE HA PEDIDO EN LA MESA 
	function verPedido(){		
		// cantidad de personas que estan seleccionadas 
		var cantidad = generalTamano;
		// si es menor o igual que 4
		if(cantidad <= 4){
			listaPedidos();					
		}else if(cantidad >=5 && cantidad <= 6){
			listaPedidosX(cantidad);
		}
	}

//LISTA DE PUESTO QUE HAN HECHO PEDIDOS EN MESA DE MENOS DE 4 PERSONAS QUE ESTAN SIN CONFRIMAR
	function listaPedidos(){
		// array con los puestos sin repetir 
		var puestos = generalarrPuestos;		
		var mesa = generalCodigoM;
		//crea el array con los datos de los puestos
		var puestosArr = new Array();
		puestosArr = crearArray(puestos);		
		// caden que va a mostrar los puestos
		var cadenaPuestos = '';		
		

		if(puestos != 0){	
			// ciclo para mostrar los puestos
			for (var i=0 ; i<puestosArr.length ; i++){
				cadenaPuestos = cadenaPuestos +
						'<div class="full-sub-table" id="puestoDiv'+puestosArr[i]+'">'+
							'<div class="list-item-pedido">'+
								'<dl class="info-wrapper" onclick="verDetallePedido('+puestosArr[i]+','+mesa+')">'+
									'<dt>Pedido</dt>'+
									'<dd>Puesto '+puestosArr[i]+'</dd>'+
								'</dl>'+
								'<div class="pull-right content-btn-clear-pedido" onclick="cancelarPuesto('+puestosArr[i]+')">'+
									'<dl class="info-wrapper view-zoom">'+
										'<div class="cttos-modal-action">'+
											'<a href="#" class="zoom-btn ctt">'+
												'<i class="material-icons">&#xE14C;</i>'+
											'</a>'+
										'</div>'+
									'</dl>'+
								'</div>'+
							'</div>'+
						'</div>';
			}

			document.getElementById("listaPuestos4").innerHTML = cadenaPuestos;	
		}
	}

//LISTA DE PUESTO QUE HAN HECHO PEDIDOS EN MESA DE MAS DE 4 PERSONAS QUE ESTAN SIN CONFIRMAR
	function listaPedidosX(cantidadPuestos){
		// array con los puestos sin repetir 
		var puestos = generalarrPuestos;		
		var mesa = generalCodigoM;
		//crea el array con los datos de los puestos
		var puestosArr = new Array();
		puestosArr = crearArray(puestos);		
		// caden que va a mostrar los puestos
		var cadenaPuestos1 = '';
		var cadenaPuestos2 = '';
		
		if(puestos != 0){
			// pedidos para la unioin de 2 mesas (6 puestos)
			if(cantidadPuestos >= 5 && cantidadPuestos <= 6){
				// mesa que se ha unido 
				var mesaUnida = generalMesa1;
				// contador de pedidos por mesa
				var cont61 = 0;
				var cont62 = 0;
				// ciclo para los pedidos realizados por cada mesa
				for (var i=0 ; i<puestosArr.length ; i++){
					// para la mesa 1
					if(puestosArr[i] == '1' || puestosArr[i] == '2' || puestosArr[i] == '6' ){
						cont61++;
						cadenaPuestos1 = cadenaPuestos1 +
								'<div class="full-sub-table" id="puestoDiv'+puestosArr[i]+'">'+
									'<div class="list-item-pedido">'+
										'<dl class="info-wrapper" onclick="verDetallePedido('+puestosArr[i]+','+mesa+')">'+
											'<dt>Pedido</dt>'+
											'<dd>Puesto '+puestosArr[i]+'</dd>'+
										'</dl>'+
										'<div class="pull-right content-btn-clear-pedido" onclick="cancelarPuesto('+puestosArr[i]+')">'+
											'<dl class="info-wrapper view-zoom">'+
												'<div class="cttos-modal-action">'+
													'<a href="#" class="zoom-btn ctt">'+
														'<i class="material-icons">&#xE14C;</i>'+
													'</a>'+
												'</div>'+
											'</dl>'+
										'</div>'+
									'</div>'+
								'</div>';
					}else{
						cont62++;
						cadenaPuestos2 = cadenaPuestos2 +
								'<div class="full-sub-table" id="puestoDiv'+puestosArr[i]+'">'+
									'<div class="list-item-pedido">'+
										'<dl class="info-wrapper" onclick="verDetallePedido('+puestosArr[i]+','+mesaUnida+')">'+
											'<dt>Pedido</dt>'+
											'<dd>Puesto '+puestosArr[i]+'</dd>'+
										'</dl>'+
										'<div class="pull-right content-btn-clear-pedido" onclick="cancelarPuesto('+puestosArr[i]+')">'+
											'<dl class="info-wrapper view-zoom">'+
												'<div class="cttos-modal-action">'+
													'<a href="#" class="zoom-btn ctt">'+
														'<i class="material-icons">&#xE14C;</i>'+
													'</a>'+
												'</div>'+
											'</dl>'+
										'</div>'+
									'</div>'+
								'</div>';
					}
				}

				// mostrar que no hay pedido si la mesa 1 no lo tiene 
				if(cont61 == 0){
					cadenaPuestos1 = cadenaPuestos1 +
								'<div class="full-sub-table">'+
									'<div class="list-item-pedido">'+
										'<dl class="info-wrapper">'+
											'<dt>Pedido</dt>'+
											'<dd>Mesa sin pedido</dd>'+
										'</dl>'+
										'<div class="pull-right content-btn-clear-pedido">'+
											'<dl class="info-wrapper view-zoom">'+
												'<div class="cttos-modal-action">'+
													'<a href="#" class="zoom-btn ctt">'+
														'<i class="material-icons">&#xE14C;</i>'+
													'</a>'+
												'</div>'+
											'</dl>'+
										'</div>'+
									'</div>'+
								'</div>';
				}

				// mostrar que no hay pedido si la mesa 2 no lo tiene 
				if(cont62 == 0){
					cadenaPuestos2 = cadenaPuestos2 +
								'<div class="full-sub-table">'+
									'<div class="list-item-pedido">'+
										'<dl class="info-wrapper">'+
											'<dt>Pedido</dt>'+
											'<dd>Mesa sin pedido</dd>'+
										'</dl>'+
										'<div class="pull-right content-btn-clear-pedido">'+
											'<dl class="info-wrapper view-zoom">'+
												'<div class="cttos-modal-action">'+
													'<a href="#" class="zoom-btn ctt">'+
														'<i class="material-icons">&#xE14C;</i>'+
													'</a>'+
												'</div>'+
											'</dl>'+
										'</div>'+
									'</div>'+
								'</div>';
				}

				document.getElementById("listaPuestos61").innerHTML = cadenaPuestos1;	
				document.getElementById("listaPuestos62").innerHTML = cadenaPuestos2;

			}
		}		
	}

// PEDIDOS QUE HAY EN L MESA QUE YA ESTAN CONFIRMADOS PARA TODAS A MESAS 
	function pedidosConfirmados(){
		//si ya hay pedidos confirmados
		if(generalConfirmado == '1'){
			// si el tamano de la mesa es 4
			if(generalTamano <= 4){
				var mesa = generalCodigoM;

				$.ajax({
					url: urlConsutaPedido,
					dataType:'json',
					method: "GET",
					data: {'mesa':mesa},		
					success: function (data) {						
						//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
						var arrayDatos = $.map(data, function(value, index) {
			    			return [value];
						});	

						// obtengo los datos del array 
						generalConfirmPlatos= arrayDatos[0];
						generalConfirmCantidad = arrayDatos[1];
						generalConfirmPuestos = arrayDatos[2];				
						generalConfirmPlaCod = arrayDatos[3];
						generalConfirmImagen = arrayDatos[4];
						
						if(generalTamano <= 4){
							mostrarConfirmados(arrayDatos[2]);
						}
					}
				});	
			}else if(generalTamano >= 5 && generalTamano <= 6){
				var mesa = generalCodigoM;

				$.ajax({
					url: urlConsutaPedidoX,
					dataType:'json',
					method: "GET",
					data: {'mesa':mesa},		
					success: function (data) {						
						//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
						var arrayDatos = $.map(data, function(value, index) {
			    			return [value];
						});	

						// obtengo los datos del array 
						generalConfirmPlatos= arrayDatos[0];
						generalConfirmCantidad = arrayDatos[1];
						generalConfirmPuestos = arrayDatos[2];				
						generalConfirmPlaCod = arrayDatos[3];
						generalConfirmImagen = arrayDatos[4];
						generalConfirmMesas = arrayDatos[5];
						
						if(generalTamano >= 5 && generalTamano <= 6){
							mostrarConfirmadosx(arrayDatos[2],arrayDatos[5]);
						}
					}
				});	

			}
			
		}
	}

//MUESTRA LOS PUESTOS POR MESA MENORES O IGUALES A 4 PERSONAS, QUE HAN PEDIDO 
	function mostrarConfirmados(arrayPuestosConf){		
		var arrayPuestos = new Array();
		arrayPuestos = sinRepetirArray(arrayPuestosConf);
		// cadena de puestos a mostrar
		var puestoCadena = '';		
		//construye la cadena con los datos 
		for(var i=0 ; i<arrayPuestos.length; i++){	
			puestoCadena = puestoCadena +
					'<div class="full-sub-table" id="puestoDiv'+arrayPuestos[i]+'">'+
						'<div class="list-item-pedido ">'+
							'<dl class="info-wrapper" onclick="verDetalleConfirmado('+arrayPuestos[i]+')">'+
								'<dt>Pedido</dt>'+
								'<dd>Puesto '+arrayPuestos[i]+'</dd>'+
							'</dl>'+
							'<div class="pull-right content-btn-clear-pedido">'+
								'<dl class="info-wrapper view-zoom">'+
									'<div class="cttos-modal-action">'+
										'<a href="#" class="zoom-btn ctt">'+
											'<i class="material-icons">&#xE877;</i>'+
										'</a>'+
									'</div>'+
								'</dl>'+
							'</div>'+
						'</div>'+
					'</div>';
		}
		
		// se muestran los datos en pantalla
		document.getElementById("listaPuestosC4").innerHTML = puestoCadena;
	}

//MUESTRA OS PUESTO UE HAN PEDIDO POR MESA (MAYORES A 4)
	function mostrarConfirmadosx(arrayPuestosConf, arrayMesasConf){
		var arrayPuestos = new Array();
		arrayPuestos = sinRepetirArray(arrayPuestosConf);
		// mesa secundaria
		var mesaSecund = generalMesa1;			
		// cadena de puestos a mostrar en mesa 1 y 2
		var puestoCadena1 = '';		
		var puestoCadena2 = '';		
		//construye la cadena con los datos 
		for(var i=0 ; i<arrayPuestos.length; i++){	

			if(arrayPuestos[i] == 1 || arrayPuestos[i] == 2 || arrayPuestos[i] == 6){
				puestoCadena1 = puestoCadena1 +
						'<div class="full-sub-table" id="puestoDiv'+arrayPuestos[i]+'">'+
							'<div class="list-item-pedido ">'+
								'<dl class="info-wrapper" onclick="verDetalleConfirmado('+arrayPuestos[i]+')">'+
									'<dt>Pedido</dt>'+
									'<dd>Puesto '+arrayPuestos[i]+'</dd>'+
								'</dl>'+
								'<div class="pull-right content-btn-clear-pedido">'+
									'<dl class="info-wrapper view-zoom">'+
										'<div class="cttos-modal-action">'+
											'<a href="#" class="zoom-btn ctt">'+
												'<i class="material-icons">&#xE877;</i>'+
											'</a>'+
										'</div>'+
									'</dl>'+
								'</div>'+
							'</div>'+
						'</div>';
			}else{
				puestoCadena2 = puestoCadena2 +
						'<div class="full-sub-table" id="puestoDiv'+arrayPuestos[i]+'">'+
							'<div class="list-item-pedido ">'+
								'<dl class="info-wrapper" onclick="verDetalleConfirmado('+arrayPuestos[i]+')">'+
									'<dt>Pedido</dt>'+
									'<dd>Puesto '+arrayPuestos[i]+'</dd>'+
								'</dl>'+
								'<div class="pull-right content-btn-clear-pedido">'+
									'<dl class="info-wrapper view-zoom">'+
										'<div class="cttos-modal-action">'+
											'<a href="#" class="zoom-btn ctt">'+
												'<i class="material-icons">&#xE877;</i>'+
											'</a>'+
										'</div>'+
									'</dl>'+
								'</div>'+
							'</div>'+
						'</div>';
			}			
		}

		// si alguna de las mesas na de tener ni un pedido de puesto
		if(puestoCadena1 == ""){
			puestoCadena1 = puestoCadena1 +
					'<div class="full-sub-table">'+
						'<div class="list-item-pedido ">'+
							'<dl class="info-wrapper")">'+
								'<dt>Pedido</dt>'+
								'<dd>Mesa sin pedido</dd>'+
							'</dl>'+
							'<div class="pull-right content-btn-clear-pedido">'+
								'<dl class="info-wrapper view-zoom">'+
									'<div class="cttos-modal-action">'+
										'<a href="#" class="zoom-btn ctt">'+
											'<i class="material-icons">&#xE877;</i>'+
										'</a>'+
									'</div>'+
								'</dl>'+
							'</div>'+
						'</div>'+
					'</div>';
		}else if(puestoCadena2 == ""){
			puestoCadena2 = puestoCadena2 +
					'<div class="full-sub-table">'+
						'<div class="list-item-pedido ">'+
							'<dl class="info-wrapper")">'+
								'<dt>Pedido</dt>'+
								'<dd>Mesa sin pedido</dd>'+
							'</dl>'+
							'<div class="pull-right content-btn-clear-pedido">'+
								'<dl class="info-wrapper view-zoom">'+
									'<div class="cttos-modal-action">'+
										'<a href="#" class="zoom-btn ctt">'+
											'<i class="material-icons">&#xE877;</i>'+
										'</a>'+
									'</div>'+
								'</dl>'+
							'</div>'+
						'</div>'+
					'</div>';
		}

		
		
		// se muestran los datos en pantalla
		document.getElementById("listaPuestosC61").innerHTML = puestoCadena1;
		document.getElementById("listaPuestosC62").innerHTML = puestoCadena2;
	}

//MUESTRA E DETALLE DE LOS PEDIDOS QUE HAN EN LAS MESAS
	function verDetallePedidoMesa(){		
		//datos en texto plano de los platos la cantidad y el puesto
		var platos = generalPlatos;
		var cantidad = generalCantidad;
		var puestos = generalPuestos;	

		// acomodan los textos planos en array
		var arrPlatos = generalNombrePlatos;		
		var arrCantidad = crearArray(cantidad);
		var arrPuestos = crearArray(puestos);
		var arrImagen = generalNombreImages;
		//contenido del pedido
		var contenidoPedido = '';

		if(generalTamano <= 4){

			if(arrPlatos.length > 0){
				for(var i=0 ; i<arrPlatos.length ; i++){
					contenidoPedido = contenidoPedido +
						'<tr>'+
							'<td class="icn">'+
								'<img src="img/categorias/'+arrImagen[i]+'" class="img-item">'+							
							'</td>'+
							'<td class="desc">'+
								'<div class="nom-item">'+
									'<p>'+arrPlatos[i]+'</p>'+
								'</div>'+
								'<div class="val-item">'+
									'<p></p>'+
								'</div>'+
							'</td>'+
							'<td class="cant"><p>x'+arrCantidad[i]+'</p></td>'+
							'<td class="cant"><p><i class="material-icons icon-btn">&#xe876;</i></p></td>'+					
						'</tr>';
				}
			}	

			if(generalConfirmPlatos.length > 0){
				for(var i=0 ; i<generalConfirmPlatos.length ; i++){
					contenidoPedido = contenidoPedido +
						'<tr>'+
							'<td class="icn">'+
								'<img src="img/categorias/'+generalConfirmImagen[i]+'" class="img-item">'+							
							'</td>'+
							'<td class="desc">'+
								'<div class="nom-item">'+
									'<p>'+generalConfirmPlatos[i]+'</p>'+
								'</div>'+
								'<div class="val-item">'+
									'<p></p>'+
								'</div>'+
							'</td>'+
							'<td class="cant"><p>x'+generalConfirmCantidad[i]+'</p></td>'+
							'<td class="cant"><p><i class="material-icons icon-btn">&#xe877;</i></p></td>'+					
						'</tr>';
				}
			}
		}

		document.getElementById("mesaDetalle").innerHTML = '<h5 class="text-right txt__light-70">Mesa '+generalCodigoM+'</h5>';
		document.getElementById("platosDetalle").innerHTML = contenidoPedido;
	}

//MOSTRAR EL DETALLE DEL PEDIDO POR PUESTO
	function verDetalleConfirmado(puesto){
		//candena conla estructura 
		var contenidoPedido = '';
		// recorro los datos de los array
		for(var i=0 ; i<generalConfirmPuestos.length ; i++){
			// si el puesto seleccionado es igual al leido relleno los datos
			if(generalConfirmPuestos[i] == puesto){
				contenidoPedido = contenidoPedido +
					'<tr>'+
						'<td class="icn">'+
							'<img src="img/categorias/'+generalConfirmImagen[i]+'" class="img-item">'+							
						'</td>'+
						'<td class="desc">'+
							'<div class="nom-item">'+
								'<p>'+generalConfirmPlatos[i]+'</p>'+
							'</div>'+
							'<div class="val-item">'+
								'<p></p>'+
							'</div>'+
						'</td>'+
						'<td class="cant"><p>x'+generalConfirmCantidad[i]+'</p></td>'+						
						'<td class="cant"><p><i class="material-icons icon-btn" onClick="cancelarConfirmado('+generalConfirmCantidad[i]+','+i+')">&#xE14C;</i></p></td>'+					
					'</tr>';
			}			
		}

		document.getElementById("puestoDetalle").innerHTML = '<span class="txt__lightorange">Puesto '+puesto+'</span>';	
		document.getElementById("mesaDetalle").innerHTML = '<h5 class="text-right txt__light-70">Mesa '+generalCodigoM+'</h5>';
		document.getElementById("platosDetalle").innerHTML = contenidoPedido;
	}

//VER DETALLE DEL PEDIDO QUE HAY EN MESA OR PUESTO
	function verDetallePedido(puesto, mesa){
		//datos en texto plano de los platos la cantidad y el puesto
		var platos = generalPlatos;
		var cantidad = generalCantidad;
		var puestos = generalPuestos;	

		// acomodan los textos planos en array
		var arrPlatos = generalNombrePlatos;		
		var arrCantidad = crearArray(cantidad);
		var arrPuestos = crearArray(puestos);
		var arrImagen = generalNombreImages;

		/*console.log(arrPlatos);
		console.log(arrCantidad);
		console.log(arrPuestos);*/
		// contenido del pedido 
		var contenidoPedido = '';

		for(var i=0 ; i<arrPuestos.length ; i++){
			if(arrPuestos[i] == puesto){
				
				contenidoPedido = contenidoPedido +
					'<tr>'+
						'<td class="icn">'+
							'<img src="img/categorias/'+arrImagen[i]+'" alt="" class="img-item">'+							
						'</td>'+
						'<td class="desc">'+
							'<div class="nom-item">'+
								'<p>'+arrPlatos[i]+'</p>'+
							'</div>'+
							'<div class="val-item">'+
								'<p></p>'+
							'</div>'+
						'</td>'+
						'<td class="cant"><p>x'+arrCantidad[i]+'</p></td>'+												
					'</tr>';
			}
		}
		
		document.getElementById("puestoDetalle").innerHTML = '<span class="txt__lightorange">Puesto '+puesto+'</span>';	
		document.getElementById("mesaDetalle").innerHTML = '<h5 class="text-right txt__light-70">Mesa '+mesa+'</h5>';
		document.getElementById("platosDetalle").innerHTML = contenidoPedido;
			

	}

//
	function nombrePlatos(){	
		// datos de los platos seleccionados	
		var platos = generalPlatos;	

		if(platos != 0){
			$.ajax({
				url: urlConsultaNomPlato,	
				dataType:'json',								
				method: "GET",
				data: {'plato':platos},
				success: function (data) {	
					//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
					var arrayDatos = $.map(data, function(value, index) {
		    			return [value];
					});		
					
					generalNombrePlatos = arrayDatos[0];
					generalNombreImages = arrayDatos[1];
				}
			});	
		}
	}

//HABILITAR LOS BOTONES DEPENDIENDO DE AS CONCIDIONES INDICADAS
	function habilitarBotones(){
		// habilitar el boton de la facturacion
		if(generalEstadoM == 1){
			document.getElementById("facturarPedidoBtn").style.display = 'none';			
		}

		//habilir el boton de visualizar el pedido 
		if(generalPlatos == 0 && generalEstadoM == 1){						
			document.getElementById("visualizarPedidoBtn").style.display = 'none';			
		}

		//habilitar el boton de cerrar factura
		document.getElementById("cerrarFacturar").style.display = 'none';			
		
	}

//FUNCIONALIDAD DEL BOTON RETROCEDER 
	function retrocederMesa(){
		var tamano =  document.getElementById("numPersonas").value;
		var estado = estadoMesa;

		switch (estado){
			case '1':
				//console.log(estado);
				if(tamano <= 4){
					//$(".main-content-mesa").addClass("out");
					$(".main-content-mesa").removeClass("in");
					$(".main-content-select-puestos").removeClass("out");
					$(".main-content-select-puestos").addClass("in");
					//$(".main-content-unir-mesa").addClass("in");				
					//$(".main-content-unir-mesa").removeClass("out");
				}else{
					//$(".main-content-mesa").addClass("out");
					$(".main-content-mesa").removeClass("in");
					//$(".main-content-select-puestos").removeClass("out");
					//$(".main-content-select-puestos").addClass("in");
					$(".main-content-unir-mesa").addClass("in");				
					$(".main-content-unir-mesa").removeClass("out");			
				}
				break;
			case '0':
				var urlPlaza = urlSitePlaza;
				location.href = urlPlaza;
				break;
		}
				
	}

//FUNCION QUE SE EJECUTAR AL CLICKEAR FACTURAR
	function verFactura(){
		// cantidad de personas que estan seleccionadas 
		var cantidad = generalTamano;
		// si es menor o igual que 4 solo es una mesa
		if(cantidad <= 4){
			listaFactura();
		}else if(cantidad >= 5 && cantidad <= 6){
			listaFacturaX();
		}
	}

//MUESTRA LOS PUESTO QUE HAN REALIZADO PEDIDOS Y LOS LISTA ARA FACTURAR MESAS DE 4 PERSONAS
	function listaFactura(){
		// array con los puestos sin repetir 
		var puestos = generalarrPuestos;
		var mesa = generalCodigoM;
		var tamano = generalTamano;
		//crea el array con los datos de los puestos
		var puestosArr = new Array();
		puestosArr = crearArray(puestos);		
		// caden que va a mostrar los puestos
		var cadenaPuestos = '';
		//nombre del id del puesto
		var nombreDiv = 'facturaPuesto';	


		$.ajax({
			url: urlListaPuestoFactura,
			dataType:'json',
			method: "GET",
			data: {'mesa':mesa},		
			success: function (data) {						
				//cantidad de datos que contiene cada array del json	
				var tamano = Object.keys(data.CCOCOD).length;			
				//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
				var arrayDatos = $.map(data, function(value, index) {
	    			return [value];
				});						

				var puestosFac = arrayDatos[0];

				generalFacturaPuestos = puestosFac;

				if(puestosFac.length != 0) {
					//titulo de la mesa a facturar
					document.getElementById("tituloMesaFac").innerHTML = 'Mesa '+mesa;			

					// contador de repeticioines
					var contador = 0;
					//recorre los puestos disponibles
					for (var i=1 ; i<=6 ; i++){		
						// recorre el array que tiene los puestos disponibles 
						for (var j=0 ; j<puestosFac.length ; j++){
							// si el puesto i esta en el array suma 		
							if(i == puestosFac[j]){								
								contador++;
							}
						}	
						// si la repeticion es menor a 1 se oculta
						if(contador < 1){							
							// se muestran los puestos que estan habilitados
							//document.getElementById(nombreDiv+i).style.display = 'none';		
							var nombre ="#"+nombreDiv+i;
							$(nombre).remove();	
						}
						// se reinicia el contador
						contador = 0;
					}		
				}else{
					document.getElementById("tituloMesaFac").innerHTML = 'Mesa sin pedidos';
					document.getElementById("checkAll").style.display = 'none';
					//no se muestran los puestos  y se muestra mensaje
					for(var k=1 ; k<=6 ; k++){
						document.getElementById(nombreDiv+k).style.display = 'none';					
					}
				}
			}
		});	
	}

//MUESTRA LOS PUESTO QUE HAN REALIZADO PEDIDOS Y LOS LISTA ARA FACTURAR MESAS CON MAS DE 4 PERSONAS
	function listaFacturaX(){
		// array con los puestos sin repetir 
		var puestos = generalarrPuestos;
		var mesa = generalCodigoM;
		var tamano = generalTamano;
		//crea el array con los datos de los puestos
		var puestosArr = new Array();
		puestosArr = crearArray(puestos);		
		// caden que va a mostrar los puestos
		var cadenaPuestos = '';
		//nombre del id del puesto
		var nombreDiv = 'facturaPuesto';	


		$.ajax({
			url: urlListaPuestoFacturax,
			dataType:'json',
			method: "GET",
			data: {'mesa1':generalMesaPrinc, 'mesa2':generalMesa1},		
			success: function (data) {										
				//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
				var arrayDatos = $.map(data, function(value, index) {
	    			return [value];
				});						

				if(generalTamano >= 5 && generalTamano <= 6){
					// puestos con pedidos en la mesa 1
					var puestosFac1 = arrayDatos[0].CCOCOD;
					// puestos con pedidos en la mesa 2
					var puestosFac2 = arrayDatos[1].CCOCOD;				
					// array con todos los puestos
					var puestosFacG = puestosFac1.concat(puestosFac2);

					// mostrar los puestos que se pueden facturar de la mesa principal 
					if(puestosFacG.length != 0) {
						generalMesa1 = $("#mesaPrincipalSpan").text().substring(1);
						//titulo de la mesa a facturar
						document.getElementById("tituloMesaFac").innerHTML = 'Mesa '+generalMesaPrinc+' - Mesa '+generalMesa1;			

						// contador de repeticioines
						var contador = 0;
						//recorre los puestos disponibles
						for (var i=1 ; i<=6 ; i++){		
							// recorre el array que tiene los puestos disponibles 
							for (var j=0 ; j<puestosFacG.length ; j++){
								// si el puesto i esta en el array suma						
								if(i == puestosFacG[j]){								
									contador++;
								}
							}	
							// si la repeticion es menor a 1 se oculta
							if(contador < 1){							
								// se muestran los puestos que estan habilitados
								//document.getElementById(nombreDiv+i).style.display = 'none';		
								var nombre ="#"+nombreDiv+i;
								$(nombre).remove();	
							}else{
								// nombre de los div que contienen los puestos a seleccionar
								var nombre = "tituloPuestoFac"+i;
								// indicativo de la mesa a la que pertenece el puesto
								var complemento;

								if(i == 1 || i == 2 || i == 6){
									complemento = "<font size=1>   M-"+generalMesaPrinc+"</font>";
								}else{
									complemento = "<font size=1>   M-"+generalMesa1+"</font>"
								}

								document.getElementById(nombre).innerHTML = 'Pedido puesto '+i+complemento;			
							}
							// se reinicia el contador
							contador = 0;
						}		
					}else{
						document.getElementById("tituloMesaFac").innerHTML = 'Mesa sin pedidos';
						document.getElementById("checkAll").style.display = 'none';
						//no se muestran los puestos  y se muestra mensaje
						for(var k=1 ; k<=6 ; k++){
							document.getElementById(nombreDiv+k).style.display = 'none';					
						}
					}
				}
			}
		});	
		 
		
	}

//VISUALIZAR LA FACTURA DE LOS PUESTOS SELECCIONADOS PARA CUALQUIER MESA
	function visualizaFactura(){	
		
		if(generalTamano <= 4){
			$.ajax({
				url: urlVisualizarFactura,
				dataType:'json',
				method: "GET",
				data: {'puestos':generalCheksPulsados, 'mesa':generalCodigoM},	// full para saber si es por puestos o toda la mesa		
				success: function (data) {										
					// platos pedidos por los puestos
					var arrayDatos = $.map(data, function(value, index) {
		    			return [value];
					});		

					var arrayDetalle = arrayDatos[0];
					var arrayFecha = arrayDatos[1];

					var totalFac = 0;								
					var subtotalFac = 0;
					var ivaFac = 0;

					// lista de productos
					var nombreProducto = arrayDetalle.PRODUCTO;
					var unidadProducto = arrayDetalle.UNIDAD;
					var valorProducto = arrayDetalle.VALOR;
					var valorIvaPro = arrayDetalle.VALOR_IVA;

					var listaProductos = '';

					for(var i=0 ; i<nombreProducto.length ; i++){
						listaProductos = listaProductos +
							'<tr>'+
								'<td>'+nombreProducto[i]+'</td>'+
								'<td>'+unidadProducto[i]+'</td>'+
								'<td>$'+formatoMoneda(valorProducto[i])+'</td>'+
							'</tr>';

						subtotalFac = subtotalFac + parseFloat(valorProducto[i]);
						ivaFac = ivaFac + parseFloat(valorIvaPro[i]);
					}

					totalFac = subtotalFac + ivaFac;					

					document.getElementById("numeroFactura").innerHTML = '####';
					document.getElementById("fechaFactura").innerHTML = arrayFecha;				
					document.getElementById("totalFactura").innerHTML = '$'+formatoMoneda(totalFac.toString());
					document.getElementById("listadoFactura").innerHTML = listaProductos;
					document.getElementById("valorIva").innerHTML = '$'+formatoMoneda(ivaFac.toString());
					document.getElementById("valorSubtotal").innerHTML = '$'+formatoMoneda(subtotalFac.toString());

					document.getElementById("cerrarFacturar").style.display = 'block';
					
				}
			});
		}else if(generalTamano >= 5 && generalTamano <= 6){
			$.ajax({
				url:urlVisualizarFacturaX,
				dataType:'json',
				method: "GET",
				data: {'tamano':generalTamano, 'puestos':generalCheksPulsados, 'mesa1':generalMesaPrinc, 'mesa2':generalMesa1},	
				success: function (data) {										
					var arrayDatos = $.map(data, function(value, index) {
		    			return [value];
					});	

					var arrayDetalle = arrayDatos[0];
					var arrayFecha = arrayDatos[1];

					var totalFac = 0;								
					var subtotalFac = 0;
					var ivaFac = 0;

					// lista de productos
					var nombreProducto = arrayDetalle.PRODUCTO;
					var unidadProducto = arrayDetalle.UNIDAD;
					var valorProducto = arrayDetalle.VALOR;
					var valorIvaPro = arrayDetalle.VALOR_IVA;

					var listaProductos = '';

					for(var i=0 ; i<nombreProducto.length ; i++){
						listaProductos = listaProductos +
							'<tr>'+
								'<td>'+nombreProducto[i]+'</td>'+
								'<td>'+unidadProducto[i]+'</td>'+
								'<td>$'+formatoMoneda(valorProducto[i])+'</td>'+
							'</tr>';

						subtotalFac = subtotalFac + parseFloat(valorProducto[i]);
						ivaFac = ivaFac + parseFloat(valorIvaPro[i]);
					}

					totalFac = subtotalFac + ivaFac;

					document.getElementById("numeroFactura").innerHTML = '####';
					document.getElementById("fechaFactura").innerHTML = arrayFecha;				
					document.getElementById("totalFactura").innerHTML = '$'+formatoMoneda(totalFac.toString());
					document.getElementById("listadoFactura").innerHTML = listaProductos;
					document.getElementById("valorIva").innerHTML = '$'+formatoMoneda(ivaFac.toString());
					document.getElementById("valorSubtotal").innerHTML = '$'+formatoMoneda(subtotalFac.toString());

					document.getElementById("cerrarFacturar").style.display = 'block';
				}
			});
		}
	}

//FUNCION QUE SE EJCUTA UNA VEZ SE GENERA LA FACTURA
	function opcionFacturar(){
		// se oculta el boton de cerrar la vista de la factura
		document.getElementById("cerrarFacturar").style.display = 'none';			

		visualizaFactura();		
		//se oculta el boton de salir (futuro a imprimir)
		document.getElementById("labelImprimir").innerHTML = 'Facturar';											
		//se muestra la opcion para cerrar la visualizacion
		document.getElementById("cerrarFacturar").style.display = 'block';	
		//cambio el onclick del boton
		$(document).ready(function(){					    
		    // clears onclick then sets click using jQuery
		    $("#labelImprimir").attr('onclick', 'generarFactura()');
		});	
		
	}	

//VALIDACIONES QUE SI REALMENTE DESEA GENERAR LA FACTURA
	function generarFactura(){
		//mensaje de confirmacion de facturar los puestos
		var mensajePuestos = ''		

		for(var i=0 ; i<generalCheksPulsados.length ; i++){
			if(generalCheksPulsados[i] != 0){
				// anida el puesto que ha seleccionado 
				mensajePuestos = mensajePuestos + generalCheksPulsados[i];					
				// si es el ultimo en agregar no le pone la coma a l final
				if((i+1) != generalCheksPulsados.length){
					mensajePuestos = mensajePuestos + ",";
				}
			}
		}

		mensajePuestos = "Seguro desea facturar los pedidos de los puestos " + mensajePuestos + "?";
		
		swal({
			title: '¿Facturar?',						
			type: "info",
			text: mensajePuestos,
			showCancelButton: true,
			confirmButtonColor: "#5cb85c",
			cancelButtonColor: "#EC4424",
			confirmButtonText: "Si, facturar",
			cancelButtonText: "No, cancelar",
			closeOnConfirm: false,
			closeOnCancel: false
		},
			function(isConfirm){
				if (isConfirm) {
					//ejecuta la factura en bd
					//mostrarFactura(true);
					var codigoCliente = document.getElementById("cltRCc").value;

					if(("".localeCompare(codigoCliente) == 0)){
						swal({
							title: 'Cliente no ingresado!',						
							type: "info",
							text: 'Desea generar la facturar con cliente nulo?',
							showCancelButton: true,
							confirmButtonColor: "#5cb85c",
							cancelButtonColor: "#EC4424",
							confirmButtonText: "Si, facturar",
							cancelButtonText: "No, cancelar",
							closeOnConfirm: false,
							closeOnCancel: false
						},
							function(isConfirm){
								if (isConfirm) {
									//cambio el onclick del boton
									$(document).ready(function(){					    
									    // clears onclick then sets click using jQuery
									    $("#labelImprimir").attr('onclick', 'opcionesReciboFac()');
									});	
									//muestra el boton de salir (futuro a imprimir )
									document.getElementById("labelImprimir").innerHTML = 'Continuar';
									//se oculta el boton cliente
									document.getElementById("btnRegistroC").style.display = "none";
									//se oculata las opciones de cambio de porcentaje de propina
									document.getElementById("opcionesPropina").style.display = "none";		
									document.getElementById("nombreClientefac").innerHTML = "N/A";		
									document.getElementById("idClientefac").innerHTML = "N/A";		
									//ejecuta la factura en bd
									mostrarFactura(true);
									// muestra el mensaje de terminado
									swal("","Factura generada correctamente","success");
								}else{
									swal("","Operacion cancelada","error");
								}
						});		
					}else{
						//cambio el onclick del boton
						$(document).ready(function(){					    
						    // clears onclick then sets click using jQuery
						    $("#labelImprimir").attr('onclick', 'opcionesReciboFac()');
						});	
						//muestra el boton de salir (futuro a imprimir )
						document.getElementById("labelImprimir").innerHTML = 'Continuar';
						//se oculta el boton cliente
						document.getElementById("btnRegistroC").style.display = "none";
						//se oculata las opciones de cambio de porcentaje de propina
						document.getElementById("opcionesPropina").style.display = "none";									
						//ejecuta la factura en bd
						mostrarFactura(true);
						// muestra el mensaje de terminado
						swal("","Factura generada correctamente","success");
					}
					// muestra el mensaje de terminado
					//swal("","Factura generada correctamente","success")
				}else{
					// cierra el modal de la factura 
					$("#cerrarFacturar").click();
					// muestra el mensaje de cancelado
					swal("","Operacion cancelada","error");
				}
		});		
	}

//GENERA LA FACTURA Y LA MUESTRA EN PANTALLA
	function mostrarFactura(full = false){
		//toma el valor de la propina
		var propina = $('input:radio[name=optionsRadiosPropina]:checked').val();
		propina = propina.replace(",", ".");
		propina = propina.substring(0,propina.indexOf(".")+4);
		//codigo del cliente
		var codigoClienteFactura = document.getElementById("cltRCc").value;
		//cuando el tamano de la mesa es de 4 personas
		if(generalTamano <= 4){
			$.ajax({
				url: urlFacturarPedido,
				dataType:'json',
				method: "GET",
				data: {'puestos':generalCheksPulsados, 'mesa':generalCodigoM, 'full':full, 'propina':propina, 'codCli':codigoClienteFactura},	// full para saber si es por puestos o toda la mesa		
				success: function (data) {						
					//cantidad de datos que contiene cada array del json	
					/*var tamano = Object.keys(data.foo).length;			
					//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
					var arrayDatos = $.map(data, function(value, index) {
		    			return [value];
					});	*/
					//cabecera de la factura
					var cabFactura = data[0];
					//detalle de la factura
					var detFactura = data[1];

					// cabecera de la factura
					var arrayDatosCF = $.map(cabFactura, function(value, index) {
		    			return [value];
					});	
					// detalle de la factura
					var arrayDatosDF = $.map(detFactura, function(value, index) {
		    			return [value];
					});	

					// lista de productos
					var nombreProducto = arrayDatosDF[0];
					var unidadProducto = arrayDatosDF[1];
					var valorProducto = arrayDatosDF[2];
					
					//etiquetas html 
					var listaProductos = '';
					
					for(var i=0 ; i<nombreProducto.length ; i++){
						listaProductos = listaProductos +
							'<tr>'+
								'<td>'+nombreProducto[i]+'</td>'+
								'<td>'+unidadProducto[i]+'</td>'+
								'<td>$'+formatoMoneda(valorProducto[i])+'</td>'+
							'</tr>';
					}

					// muestran los datos en la factura 				
					document.getElementById("numeroFactura").innerHTML = arrayDatosCF[0];
					document.getElementById("fechaFactura").innerHTML = arrayDatosCF[1];				
					document.getElementById("valorSubtotal").innerHTML = '$'+formatoMoneda(arrayDatosCF[2].toString());	
					document.getElementById("valorIva").innerHTML = '$'+formatoMoneda(arrayDatosCF[3].toString());	
					document.getElementById("totalFactura").innerHTML = '$'+formatoMoneda(arrayDatosCF[4].toString());
					document.getElementById("valorPropina").innerHTML = '$'+formatoMoneda(arrayDatosCF[5].toString());	
					document.getElementById("listadoFactura").innerHTML = listaProductos;

					generalRever = data[2];
					generalFactura = arrayDatosCF[0];
					estadoMesaFac();
				}
			});
		}else if(generalTamano >= 5 && generalTamano <= 6){
			$.ajax({
				url: urlFacturarPedidox,
				dataType:'json',
				method: "GET",
				data: {'puestos':generalCheksPulsados, 'mesa1':generalMesaPrinc, 'mesa2':generalMesa1, 'full':full, 'propina':propina, 'codCli':codigoClienteFactura},		
				success: function (data) {							
					
					//cabecera de la factura									
					var cabFactura = data[0];
					//detalle de la factura
					var detFactura = data[1];				
					// cabecera de la factura
					var arrayDatosCF = $.map(cabFactura, function(value, index) {
		    			return [value];
					});						
					// detalle de la factura
					var arrayDatosDF = $.map(detFactura, function(value, index) {
		    			return [value];
					});	
					
					// lista de productos
					var nombreProducto = arrayDatosDF[0]['PRODES'];
					var unidadProducto = arrayDatosDF[0]['PEDUNI'];
					var valorProducto = arrayDatosDF[0]['PEDVALTUN'];	

					//etiquetas html 
					var listaProductos = '';					
					for (clave in nombreProducto){
						listaProductos = listaProductos +
							'<tr>'+
								'<td>'+nombreProducto[clave]+'</td>'+
								'<td>'+unidadProducto[clave]+'</td>'+
								'<td>$'+formatoMoneda(valorProducto[clave])+'</td>'+
							'</tr>';
					}				

					// muestran los datos en la factura 				
					document.getElementById("numeroFactura").innerHTML = arrayDatosCF[0];
					document.getElementById("fechaFactura").innerHTML = arrayDatosCF[1];	
					document.getElementById("valorSubtotal").innerHTML = '$'+formatoMoneda(arrayDatosCF[2].toString());	
					document.getElementById("valorIva").innerHTML = '$'+formatoMoneda(arrayDatosCF[3].toString());				
					document.getElementById("totalFactura").innerHTML = '$'+formatoMoneda(arrayDatosCF[4].toString());
					document.getElementById("valorPropina").innerHTML = '$'+formatoMoneda(arrayDatosCF[5].toString());
					document.getElementById("listadoFactura").innerHTML = listaProductos;

					generalRever = data[2];
					generalFactura = arrayDatosCF[0];
					estadoMesaFac();
				}
			});
		}		

	}

//OPCIONES QUE DAN DE SEGUIR FACTURAR O VOLVER A MESA UNA VES SEGENERE UNA FACTURA 
	function opcionesReciboFac(){

		swal({
			title: "",
		  	text: "Faltan platos por facturar, desea continuar en la mesa o salir a la plaza?",		  
			html: true, // add this if you want to show HTM		  
			showCancelButton: true,
			closeOnConfirm: false,
			closeOnCancel: false,
			confirmButtonColor: "#5cb85c",
			cancelButtonColor: "#EC4424",
			confirmButtonText: "Volver a mesa",
			cancelButtonText: "Salir",
	  
		},function (isConfirm) {
	  		//url donde sera redireccionado
			var urlDestino;				
			// retornar a la mesa
			if (isConfirm == true) {					
				urlDestino = urlSiteMesa;
				location.href = urlDestino+"&codigoM="+generalCodigoM+"&estadoM="+generalEstadoM+"&tamanoM="+generalTamano;
			//retornar a la plaza
			} else {					
				urlDestino = urlSitePlaza;
				location.href = urlDestino;	
			}
	  		
		});
	}

//AL MEMOENTO DE GEENRAR UNA FACTURA TENGA LA POSIBILIDAD DE REVERSARLA 
	function reversarFac(numeroRever,numeroFactura){
		swal({
			title: '¿Seguro desea reversar la factura?',
			text: "La factura "+numeroFactura+" sera cancelada!",
			type: 'warning',			
			showCancelButton: true,			
			closeOnCancel: false,
			confirmButtonColor: "#5cb85c",
			cancelButtonColor: "#EC4424",
			confirmButtonText: "Si, reversar",
			cancelButtonText: "No, cancelar",
		},function(isConfirm){			
			// retornar a la mesa
			if (isConfirm == true) {									
				$.ajax({
					url: urlRefersarFactura,					
					method: "GET",
					data: {'rever':numeroRever,'factura':numeroFactura},
					success: function (data) {										
						urlDestino = urlSiteMesa;
						location.href = urlDestino+"&codigoM="+generalCodigoM+"&estadoM="+generalEstadoM+"&tamanoM="+generalTamano;			
					}
				});			
			}

		});		
	}

//ESTADO DE LA MESA UNA VEZ GENERADA UNA DACTURA 
	function estadoMesaFac(){		
		$.ajax({
			url: urlEstadoMesaFactura,
			method: "GET",
			data: {'mesa':generalCodigoM},	// full para saber si es por puestos o toda la mesa		
			success: function (data) {										
				if(data == 1){
					$(document).ready(function(){					    
					    // clears onclick then sets click using jQuery
					    $("#labelImprimir").attr('onclick', 'imprimirRecibo()');
					});	

					//muestra el boton de salir (futuro a imprimir )
					document.getElementById("labelImprimir").innerHTML = 'Salir';			

					document.getElementById("cerrarFacturar").style.display = 'none';		
				}

				document.getElementById("cerrarFacturar").style.display = 'none';
			}
		});
	}	

//OPVION DE IMPRIMIR RECIBO (TEMPORALMETNE SOO RETORNA A LA PLAZA)
	function imprimirRecibo(){
		swal({
			title: '¿Salir o reversar factura?',						
			type: "info",
			text: '*Reversar en caso de que la factura tenga algún error',
			showCancelButton: true,
			confirmButtonColor: "#5cb85c",
			cancelButtonColor: "#EC4424",
			confirmButtonText: "Salir",
			cancelButtonText: "Reversar Factura",
			closeOnConfirm: false,
			closeOnCancel: false
		},
			function(isConfirm){
				if (isConfirm) {
					var urlPlaza = urlSitePlaza;
					location.href = urlPlaza;
				}else{
					reversarFac(generalRever,generalFactura);
				}
			}
		);			
		
	}

//VALIDA QUE UN CHECK ESTE ACTIVO PARA MOSTRAR EL BOTON DE FACTURACION
	function validarCheck(){
		//saber cuantos checks estan activos 
		var contador = 0;
		//array con los nombres de los checks seleccionados
		var nombreChecks = new Array();
		//nombre del chek
		var nombre;
		// para cada check box 
		$("input[type=checkbox]").each(function(){
			if($(this).is(":checked")){				

				nombre = $(this)[0].id;

				if(nombre.substring(nombre.length-1,nombre.length).localeCompare("r") != 0){					
					//aumenta contador en uno
					contador++;
					//almacena el nombre 
					nombreChecks.push(nombre.substring(nombre.length-1,nombre.length));
				}							
			}
		});		

		// si el contador es cero no se muestra el bton de facturar
		if(contador == 0){			
			document.getElementById('btn-fact').style.display = 'none';			
			//console.log("clickeados"+contador);
		}else{
			document.getElementById('btn-fact').style.display = 'block';		
		}

		generalCheksPulsados = nombreChecks;
		
	}setInterval(validarCheck, 1000);

//CONSULTA SI EL CLIENTE YA SE ENCUENTRA REGISTRADO O NO 
	function consultarCliente(){
		var idCliente = document.getElementById("cltRCc").value;

		if(("".localeCompare(idCliente) == 0)){
			mensajeAlerta(5);
		}else{
			//consulta el nombre del cliente si ya se encuentra registrado
			$.ajax({
				url: urlConsultarCliente,
				method: "GET",
				data: {'codigocliente':idCliente},	// full para saber si es por puestos o toda la mesa		
				success: function (data) {										
					if(("SIN_REGISTRO".localeCompare(data) == 0)){
						//mensaje de alerta
						mensajeAlerta(4);
					}else{
						mensajeAlerta(6,data);
						document.getElementById("nombreClientefac").innerHTML = data;
						document.getElementById("idClientefac").innerHTML = idCliente;
						$("#closeModClt").attr('onclick', 'cerrarModalCliente(1)');
						$('#closeModClt').click();
					}
				}
			});
		}
			
	}

// REGISTRO DEL CLEINTE
	function registrarCliente(){
		// captura los datos ingresados
		var nombreCliente = document.getElementById("cltNombre").value;
		var codigoCliente = document.getElementById("cltNCc").value;
		var ciudadCliente = document.getElementById("clCdd").value;
		var direccionCliente = document.getElementById("cltDir").value;
		var correoCliente = document.getElementById("cltMail").value;
		var telefonoCliente = document.getElementById("cltTel").value;

		// comprobar que se ingresaron los datos basicos
		if((nombreCliente.length*codigoCliente.length*correoCliente.length*ciudadCliente) != 0){
			// comprobar que sea un correo valido
			if(comprobarEmail(correoCliente) == 0){
				// comprobar que sea telefono fijo o celular
				if(((telefonoCliente.length) == 0) || ((telefonoCliente.length) == 7) || ((telefonoCliente.length) == 10)){
					$.ajax({
						url: urlRegistroCliente,
						method: "GET",
						data: {'codCli':codigoCliente,'nomCli':nombreCliente,'dirCli':direccionCliente,'corCli':correoCliente,'telCli':telefonoCliente, 'ciuCli':ciudadCliente},
						success: function (data) {										
							//O: Cliente Ya Se Encuentra Registrado En La Base De Datos 
							//1: Registro Completado
							//2: Registro Erroneo
							
							if(data == 0){
								mensajeAlerta(10);
							}else if(data == 1){
								// se cierran los modales de registro 								
								$("#cerrarRegistro").click();
								$("#closeModClt").click();
								// pone el codigo del cliente en el campo donde se valida su existencia
								document.getElementById("cltRCc").value = codigoCliente;
								$("#addIdClt").click();
								// muestra mensaje 
								mensajeAlerta(9, nombreCliente);
							}
						}
					});
				}else{
					mensajeAlerta(11);
				}
			}else{
				mensajeAlerta(8, correoCliente);
			}
		}else{
			mensajeAlerta(7);
		}
	}

//VALIDA QUE EN EL REGISTRO DEL CLIENTE EL CORREO SEA UNO VALIDO
	function comprobarEmail (email){
		//formato que debe terne un email
		re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
		// si cumple con el formato retorna 0 si no 1
		if(!re.exec(email)){
			return 1;
		}
		else {
			return 0;
		}
	}

//INICIA EL MODAL DE INGRESO DE CIENTE A LA FACTURA
	function iniciaModalCliente(){
		 $("#closeModClt").attr('onclick', 'cerrarModalCliente()');
	}

//CIERRA LA VENTANA DE INGRESO DEL CLEINTE A LA FACTURA
	function cerrarModalCliente(opcion = 0){
		//cambia el codigo del cliente a vacio
		if(opcion == 0){
			document.getElementById("cltRCc").value = "";
			document.getElementById("nombreClientefac").innerHTML = "Nombre del cliente";
			document.getElementById("idClientefac").innerHTML = "Codigo del cliente";
		}

		console.log(opcion);
	}

//
	function arrastrarCodigo(){
		var codigoIngresado = document.getElementById("cltRCc").value;
		
		if(("".localeCompare(codigoIngresado) != 0)){
			document.getElementById("cltNCc").value = codigoIngresado;
		}
		
	}

//CACULA EL PROCENTAJE DE LA PROPINA EN CASO DE HABER SIDO INGRESA CON UN VALOR X
	function calcularPorcentajePropina(valor,subtotal){
		var porcentaje = (valor*100)/subtotal;

		$("#optionsRadiosPropina5").attr('value', porcentaje);		
	}

//AL CLICKEAR OTRO COMO PROPINA 
	function habilitarPropina(){
		$("#propinax").prop("disabled",false);
		$("#propinax").focus();		
		document.getElementById("valorPropina").innerHTML = "$0";
	}

//CALCULA LA PROPINA DEPENDIENDO DEL PORCENTAJE DATO Y EL NUEVO SALDO DE LA FACTURA
	function calcularPropina(porcentaje){		
		document.getElementById("propinax").value = "";
		// valor del subtotal
		var subtotalFactura = formatoNumerico($('#valorSubtotal').html());	
		subtotalFactura = subtotalFactura.substring(1);
		// calcula el porcentaje sobre el subtotal
		var valorPorcentaje = subtotalFactura*(porcentaje/100);
		//
		var valorIvaFatura  = formatoNumerico($('#valorIva').html());	
		valorIvaFatura = valorIvaFatura.substring(1);
		//
		var valorTotalFactura = parseFloat(valorIvaFatura) + parseFloat(valorPorcentaje) + parseFloat(subtotalFactura);

		document.getElementById("valorPropina").innerHTML = '$'+formatoMoneda(valorPorcentaje.toString());	
		document.getElementById("totalFactura").innerHTML = '$'+formatoMoneda(valorTotalFactura.toString());		
	}	

//AUMENTRA LA CANTIDAD DE PEDIDOS A CANCELAR 	
	function aumentarCantidad(){
		var valorCantidad = document.getElementById("cantidadSweet").innerHTML;
		var resultado = 1;

		if(valorCantidad != 1){
			resultado = valorCantidad - 1;
		}

		document.getElementById("cantidadSweet").innerHTML = resultado;

	}

// REDUCE A CANTIDAD DE EDIDOS A CANCELAR
	function reducirCantidad(cantidad){
		var valorCantidad = parseInt(document.getElementById("cantidadSweet").innerHTML);
		var resultado = document.getElementById("cantidadSweet").innerHTML;

		if(valorCantidad != cantidad){
			resultado = valorCantidad + 1;
		}

		document.getElementById("cantidadSweet").innerHTML = resultado;

	}

// FUNCION PARA CANCELAR LOS PEDIDOS YA CONFIRMADOS
	function cancelarConfirmado(cantidad, posicionArray){			

		if(generalTamano <= 4){
			//mensaje de confirmacion
			swal({
				title: "¿Cantidad a cancelar?",
			  	text: 	'<div class="row center">'+		
			  				'<div class="col-sm-12">'+	
			  					'<div class="col-sm-3"> </div>'+		  								
			  					'<div class="col-sm-2">'+
									'<span class="glyphicon glyphicon-minus" onclick="aumentarCantidad()"></span>'+
								'</div>'+
								'<div class="col-sm-2">'+
									'<div id="cantidadSweet">1</div>'+
								'</div>'+							
								'<div class="col-sm-2">'+
									  '<span class="glyphicon glyphicon-plus" onclick="reducirCantidad('+cantidad+')"></span>'+
								'</div>'+
								'<div class="col-sm-3"> </div>'+	
			  				'</div>'+	
						'</div>',		  
				html: true, // add this if you want to show HTM		  
				showCancelButton: true,
				closeOnConfirm: false,
				confirmButtonColor: "#ff9045",
				confirmButtonText: "Aceptar",
				cancelButtonText: "Volver",
		  
			},function (inputValue) {
		  		if (inputValue === false) return false;
		  		if (inputValue === true) {	
		  			// la cantidad ingresada a cancelar	
					var cantidadCancelar = document.getElementById("cantidadSweet").innerHTML;	    		
					//
		    		$.ajax({
						url: urlCancelarPedido,						
						method: "GET",
						data: {'mesa':generalCodigoM,'plato':generalConfirmPlaCod[posicionArray],
							   'cantidad':cantidadCancelar,'puesto':'0'+generalConfirmPuestos[posicionArray]},		
						success: function (data) {
							// mensaje a mostrar
							var mensaje;
							// si la respuesta es cero, fue correcta la ejecucion
							if(data == 0){
								// mensaje que se muestra al realiza la operacion cancelar plato
								mensaje = "Se ha cancelado "+cantidadCancelar+" "+generalConfirmPlatos[posicionArray];
								// alerta en pantalla
								swal("Cancelado!", mensaje, "success");
								// el detalle de pedido cambia a vacio
								document.getElementById("puestoDetalle").innerHTML = '<span class="txt__lightorange">Puesto</span>';	
								document.getElementById("mesaDetalle").innerHTML = '<h5 class="text-right txt__light-70">Mesa</h5>';
								document.getElementById("platosDetalle").innerHTML = '';
								// se vuelven a cargar los platos que estan confirmados
								pedidosConfirmados();
							}else if(data == 1){
								// mensaje que se muestra al realiza la operacion cancelar plato
								mensaje = "Los pedidos ya entregados no pueden ser cancelados!";
								// alerta en pantalla
								swal("Error!", mensaje, "error");
							}
						}		
					});	
		  		}
		  		
			});
		}else if(generalTamano >= 5 && generalTamano <= 6){
			// varible que almacena la mesa a la que pertence el puesto 
			var mesaPuesto;
			// dependiendo del puesto se le asigna el numero de la mesa correspondiente
			if(generalConfirmPuestos[posicionArray] == 1 || generalConfirmPuestos[posicionArray] == 2 || generalConfirmPuestos[posicionArray] == 6){
				mesaPuesto = generalMesaPrinc;
			}else{
				mesaPuesto = generalMesa1;
			}

			//mensaje de confirmacion
			swal({
				title: "¿Cantidad a cancelar?",
			  	text: 	'<div class="row center">'+		
			  				'<div class="col-sm-12">'+	
			  					'<div class="col-sm-3"> </div>'+		  								
			  					'<div class="col-sm-2">'+
									'<span class="glyphicon glyphicon-minus" onclick="aumentarCantidad()"></span>'+
								'</div>'+
								'<div class="col-sm-2">'+
									'<div id="cantidadSweet">1</div>'+
								'</div>'+							
								'<div class="col-sm-2">'+
									  '<span class="glyphicon glyphicon-plus" onclick="reducirCantidad('+cantidad+')"></span>'+
								'</div>'+
								'<div class="col-sm-3"> </div>'+	
			  				'</div>'+	
						'</div>',		  
				html: true, // add this if you want to show HTM		  
				showCancelButton: true,
				closeOnConfirm: false,
				confirmButtonColor: "#ff9045",
				confirmButtonText: "Aceptar",
				cancelButtonText: "Volver",
		  
			},function (inputValue) {
		  		if (inputValue === false) return false;
		  		if (inputValue === true) {	
		  			// la cantidad ingresada a cancelar	
					var cantidadCancelar = document.getElementById("cantidadSweet").innerHTML;	    		
					//
		    		$.ajax({
						url: urlCancelarPedido,						
						method: "GET",
						data: {'mesa':mesaPuesto,'plato':generalConfirmPlaCod[posicionArray],
							   'cantidad':cantidadCancelar,'puesto':'0'+generalConfirmPuestos[posicionArray]},		
						success: function (data) {
							// mensaje a mostrar
							var mensaje;
							// si la respuesta es cero, fue correcta la ejecucion
							if(data == 0){
								// mensaje que se muestra al realiza la operacion cancelar plato
								mensaje = "Se ha cancelado "+cantidadCancelar+" "+generalConfirmPlatos[posicionArray];
								// alerta en pantalla
								swal("Cancelado!", mensaje, "success");
								// el detalle de pedido cambia a vacio
								document.getElementById("puestoDetalle").innerHTML = '<span class="txt__lightorange">Puesto</span>';	
								document.getElementById("mesaDetalle").innerHTML = '<h5 class="text-right txt__light-70">Mesa</h5>';
								document.getElementById("platosDetalle").innerHTML = '';
								// se vuelven a cargar los platos que estan confirmados
								pedidosConfirmados();
							}else if(data == 1){
								// mensaje que se muestra al realiza la operacion cancelar plato
								mensaje = "Los pedidos ya entregados no pueden ser cancelados!";
								// alerta en pantalla
								swal("Error!", mensaje, "error");
							}
						}		
					});	
		  		}
		  		
			});
		}		
		
	}

//CANCELAR TODOS LOS PEDISO DE LA MESA TANTO CONFIRMADOS COMO POR CONFIRMAR
	function cancelarTodo(){
		swal({
			title: "Esta seguro?",
			text: "Usted cancelara todo el pedido, incluidos los confirmados!",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#4caf50",
			confirmButtonText: "Si, Cancelar",
			cancelButtonText: "No, Volver",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){
		  	if (isConfirm) {
		  		
		  		var urlDestino = urlSitePlaza;
				
		  		if(generalTamano <= 4){
		  			$.ajax({
						url: urlCancelarTodo,	
						method: "GET",
						data: {'mesa':generalCodigoM, 'tamano':generalTamano},											
						success: function (data) {										
							//swal("", "Error al cancelar el pedido", "error");
							if(data == 1){
								cancelarRestoPedido();
							}else{								
								swal("", "Platos cancelados", "success");
								location.href = urlDestino;	
							}
						}
					});			  			
				}else if(generalTamano >= 5 && generalTamano <= 6){					
					$.ajax({
						url: urlCancelarTodo,	
						method: "GET",
						data: {'mesa1':generalMesaPrinc,'mesa2':generalMesa1,'tamano':generalTamano},									
						success: function (data) {		
							if(data == 1){
								cancelarRestoPedido();
							}else{								
								swal("", "Platos cancelados", "success");
								location.href = urlDestino;	
							}
							
						}
					});		
				}

				    
		  	} else {
			    swal("", "Proceso cancelado..", "error");
			}
		});
	}

//CANCELAR TODO EL PEDIDO MENOS LOS QUE YA HAN SIDO ENTREGADOS
	function cancelarRestoPedido(){
		swal({
			title: "Mesas con pedidos entregados!",
			text: "Algunos pedidos han sido entregados y no pueden ser cancelados, desea cancelar el resto?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#4caf50",
			confirmButtonText: "Si, Cancelar",
			cancelButtonText: "No, Volver",
			closeOnConfirm: false,
			closeOnCancel: false
		},
		function(isConfirm){
		  	if (isConfirm) {
		  		
		  		if(generalTamano <= 4){
		  			$.ajax({
						url: urlCancelarResto,	
						method: "GET",
						data: {'mesa':generalCodigoM, 'tamano':generalTamano},
						success: function (data) {		
							mensajeAlerta(12);							
						}
					});		
				}else if(generalTamano >= 5 && generalTamano <= 6){					
					$.ajax({
						url: urlCancelarResto,	
						method: "GET",
						data: {'mesa1':generalMesaPrinc,'mesa2':generalMesa1,'tamano':generalTamano},								
						success: function (data) {		
							mensajeAlerta(12);
						}
					});		
				}

				    
		  	} else {
			    swal("", "Proceso cancelado..", "error");
			}
		});
	}

//CANCEA TODO EL PEDIDO DE UN UESTO QUE TODAVIA NO ESTA CONFIRMADO
	function cancelarPuesto(puesto){
		//nombre del div que posee el puesto mostrado
		var nombre = '#puestoDiv'+puesto;		
		//datos en texto plano de los platos la cantidad y el puesto
		var platos = generalPlatos;
		var cantidad = generalCantidad;
		var puestos = generalPuestos;
		// acomodan los textos planos en array
		var arrPlatos = crearArray(platos);
		var arrCantidad = crearArray(cantidad);
		var arrPuestos = crearArray(puestos);

		//array con los pedidos nuevos
		var arrPlatosNew = Array();
		var arrCantidadNew = Array();
		var arrPuestosNew = Array();
		var contador = 0; // rellenar los array new

		//recorre los array de los pedidos
		for(var j=0 ; j<arrPuestos.length ; j++){
			//
			if(arrPuestos[j] != puesto){				
				arrPlatosNew[contador] = arrPlatos[j];
				arrCantidadNew[contador] = arrCantidad[j];
				arrPuestosNew[contador] = arrPuestos[j];

				contador++;
			}			
		}

		//si es el ultimo o unico puesto que se esta eliminando los valores toman cero y no null
		if(arrPlatosNew[0] == null){
			arrPlatosNew[0] = 0;
			arrCantidadNew[0] = 0;
			arrPuestosNew[0] = 0;
		}

		//elimina el dis que esta mostrando el puesto 
		$(nombre).remove();
		
		//convierto los array en texto plato
		var platosTxt = arrayToChar(arrPlatosNew);
		var cantidadTxt = arrayToChar(arrCantidadNew);
		var puestoTxt = arrayToChar(arrPuestosNew);

		//cambio el valor de las variables que manejan los pedidos 
		generalPlatos = platosTxt;
		generalCantidad = cantidadTxt;
		generalPuestos = puestoTxt;		

		// array con los puestos que hay sin repetir
		var arrayPuestosSinRep = crearArray(generalarrPuestos);		
		// se elimina el puesto del array
		var arrPuestosSinRepNew = quitarPuesto(arrayPuestosSinRep, puesto);
		// cambio el valor de los puestos que han pedido
		if(arrPuestos[0] != ''){
			generalarrPuestos = arrayToChar(arrPuestosSinRepNew);
		}else{
			generalarrPuestos = 0;			
		}

		//vuelve a cargar los puestos con pedidos
		verPedido();
		cancelarAvatar(puesto);
	}

//QUITAR E PUESTO DEL ARRAY DE LOS PEDIDOS
	function quitarPuesto(array, puesto){
		//Array que se va a retornar
		var arrayNew = new Array();
		//llenado del array
		for (var i=0 ; i<array.length ; i++) {
			// se rellena el array menos el puesto a eliminar			
			if(array[i] != puesto){				
				arrayNew.push(array[i]);	
			}			
		}

		if(arrayNew.length == 0){
			arrayNew.push(0);
		}
		//retorna el array
		return arrayNew;
	}

//FUNCION PARA GENERAR UN ARRAY CON UNA CADENA DE DATOS SEPARADOS POR UNA COMA
	function crearArray(datos){
		//array que se retorna
		var arrayRetornar = new Array();
		//cadena que entra y se va a estar modificando
		var cadena = datos+',';
		//posicion de la coma
		var posComa = cadena.indexOf(",");
		//valor que se estara insertando en el array
		var valorCadena;

		while(posComa != -1){			
			// el valor va desde el primer caracter hasta el ultimo antes de la coma
			valorCadena = cadena.substr(0,posComa);			
			// si la posicion de la coma es dferente de -1 llena el cursor
			if(posComa != -1){				
				arrayRetornar.push(valorCadena);
			}
			//se borra los datos que hay detras de la primer coma junto con ella 
			cadena = cadena.substr(posComa+1);
			// se busca la posicion de la siguiente coma 
			posComa = cadena.indexOf(",");
		}

		return arrayRetornar;
	}

//CONVERTIR UN ARRAY A UNA CADENA SEPARADAS POR COMAS
	function arrayToChar(array){
		//cadena que va tener los datos del array
		var char = '';
		// ciclo para rellenar la variable char
		for (var i=0 ; i<array.length ; i++) {
			//anida con los datos nuevos
			char = char + array[i] + ",";
		}
		//elimina la ultima coma
		char = char.substr(0, char.length-1);
		//retorna el valor 
		return char;

	}

//ADICIONAR LOS DATOS DE UN ARRAY A OTRO ARRAY 
	function adicionarArray(arrayFijo, arrayAdicion){
		//array que se va a retornar
		var arrayRetornar = arrayFijo;		
		//saber si ya esta repetido
		var cont = 0;
		//recorro el array fijo
		for (var j=0 ; j<arrayAdicion.length ; j++){
			//recorro el array que se va adicionar
			for (var k=0 ; k<arrayFijo.length ; k++){
				//si se repite aumenta el contador				
				if(arrayAdicion[j].localeCompare(arrayFijo[k]) == 1){
					cont++;
					
				}
			}

			if(cont == 0){
				arrayRetornar.push(arrayAdicion[j]);
			}

			cont = 0;
		}	

		return arrayFijo;
	}

//FILTRAR LOS DATOS DE UN ARRAY DEJANDO SIN REPETIR
	function sinRepetirArray(array){
		// array con los datos repetidos
		var arrayConRepetidos = array;
		//array que se retorna con los valor sin repetir
		var arraySinRepetidos = [];
		// funcion jquery para quitar repetidos
		$.each(arrayConRepetidos, function(i, el){
	    	if($.inArray(el, arraySinRepetidos) === -1) arraySinRepetidos.push(el);
		});	
		// retorna el array sin repetidos
		return arraySinRepetidos;

	}

// DAR FORMATO DE MONEDA A UNA CADENA
	function formatoMoneda(valorIn){
		if(valorIn.indexOf(".") != -1){
			var decimal = ","+valorIn.substring(valorIn.indexOf(".")+1,valorIn.length);
			var valor = valorIn.substring(0,valorIn.indexOf("."));
		}else{
			var decimal = "";
			var valor = valorIn;
		}
		//valor que se retorna
		var valorFinal1 = '';
		var valorFinal2 = '';

		//
		var contadorPos = 1;

		for(var i=valor.length-1 ; i>=0 ; i--){						
			if(contadorPos == 3 && i != 0){
				valorFinal1 = valorFinal1 + valor.charAt(i) + '.';
				contadorPos = 1;
			}else{
				valorFinal1 = valorFinal1 + valor.charAt(i);
				contadorPos++;
			}			
		}		

		for(var i=valorFinal1.length ; i>=0 ; i--){
			valorFinal2 = valorFinal2 + valorFinal1.charAt(i);
		}

		return (valorFinal2+decimal);
	}

//FORMATO NUMERICO QUE SE DA A UN VALOR
	function formatoNumerico(valor){
		var caracter;
		//valor que se retorna
		var valorFinal = '';

		for(var i=0 ; i<valor.length ; i++){						
			
			caracter = valor.charAt(i);

			if(caracter != "."){
				valorFinal = valorFinal + caracter;
			}
			
		}		

		return valorFinal;
	}

////MENSAJE DE ALERTA SEGUNDA LA CAUSA
	function mensajeAlerta(tipoAlerta, mensajeAdd = ''){
		switch(tipoAlerta){
			case 1:
				swal("Mesa sin pedido", "Tome el pedido antes de confirmarlo!", "error");
				break;
			case 2:
				
				break;
			case 3:
				swal("Hay una mesa sin pedido!", "Ambas mesas deben de tener por lo menos un pedido cada una, de lo contrario reduzca su tamaño a 4!", "error");
				break;
			case 4:
				swal("Usuario no registrado!", "Verifique el código ingresado o realice el debido registro!", "error");
				break;
			case 5:
				swal("Campo vacío!", "Ingrese un código en el campo indicado!", "error");
				break;
			case 6:
				swal("Usuario validado!", mensajeAdd, "success");
				break;
			case 7:
				swal("Campos vacios!", "Llene los campos para completar el registro! ", "error");
				break;
			case 8:
				swal("Correo electrónico no valido!", "Ingrese un correo electronico valido!", "error");
				break;
			case 9:
				swal("Registro completado!", "Se ha registrado el cliente "+mensajeAdd, "success");
				break;
			case 10:
				swal("Error al registrar!", "Ya existe un usuario registrado con el código "+mensajeAdd, "error");
				break;
			case 11:
				swal("Numero de teléfono no valido!", "Ingresa un número de teléfono fijo o celular!", "error");
				break;
			case 12:			
				swal({
					title: "Proceso completado!",
					text: "Los platos no entregados y no confirmados han sido cancelados!",
					type: "warning",
					showCancelButton: false,
					confirmButtonColor: "#4caf50",
					confirmButtonText: "OK",
					cancelButtonText: "No, Volver",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
				  	if (isConfirm) {				  		
				  		if(generalTamano <= 4){				  			

							urlDestino = urlSiteMesa;
							location.href = urlDestino+"&codigoM="+generalCodigoM+"&estadoM="+generalEstadoM+"&tamanoM="+generalTamano;	
								
						}else if(generalTamano >= 5 && generalTamano <= 6){												

							urlDestino = urlSiteMesa;
							location.href = urlDestino+"&codigoM="+generalMesaPrinc+"&estadoM="+generalEstadoM+"&tamanoM="+generalTamano;
								
						}

						    
				  	} else {
					    swal("", "Proceso cancelado..", "error");
					}
				});
				break;

		}
	}