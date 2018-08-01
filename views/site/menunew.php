<?php
	use yii\helpers\Html;
	use app\assets\AppAsset;
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
	use yii\helpers\Url;

	AppAsset::register($this);

	$this->title = 'Acomer';

	$request = Yii::$app->request;

?>

<?php 
	$this->beginPage() 
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="no-js">
	<head>
	    <meta charset="<?= Yii::$app->charset ?>">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <?= Html::csrfMetaTags() ?>
	    <title><?= Html::encode($this->title) ?></title>
	    <?php $this->head() ?>
		<!--<script src="js/modernizr-custom.js"></script>-->
		<?= Html::jsFile('@web/js/modernizr-custom.js') ?>
		<?= Html::jsFile('@web/js/jquery.min.js') ?>
		<?= Html::jsFile('@web/js/ciclosession.js') ?>	
		<?= Html::cssFile('@web/css/multi.min.css') ?>
		<?= Html::jsFile('@web/js/multi.min.js') ?>	

		<style type="text/css">
			someinput::-ms-clear {
			    display: none;
			}
		</style>	
	</head>
	<body class='bg-acomer'>
	<?php $this->beginBody() ?>
	<!--DIV DONDE VAN LO QUE SE AGREGA A PEDIDO -->
		<div class="compare-basket" id="listaPedidos">
			<button class="actions action--button action--compare" onclick="tomapedido()"><i class="fa fa-check"></i><span class="action__text">Agregar al pedido</span></button>
		</div>

	<!--DIV DE MENU-->
		<div class="cat__content-main">
			<div class="cat__content">
				<div id="categories" class="cat__grid">
					<?php $id_content_count = 0;?> <!--VARIABLE PARA ASIGNAR EL ID DEL DIV QUE CONTIENE LOS PLATOS-->
					<?php $id_quant = 1;?>	<!--VARIABLE PARA ASIGNAR EL CONSECUTIVO DEL ARRAY QUANT-->
					<?php foreach ($categorias as $ketc): ?>
					<div class="cat__grid-item-box">
						<div class="cat__grid-item">
							<div class="grid-item__info">
								<img src="img/categorias/<?=$ketc['IMAGEN']?>" alt="" class="grid-item__image">
							</div>
						</div>
						<h4 class="cat__title"><?php echo $ketc['DESCRIPCION']?></h4>
						<div class="cat__grid-content">
							<div class="cat__grid-content-scroller">
								<div class="cat__grid-details">
									<h2 class="cat__title-main">
										<?php echo $ketc['DESCRIPCION']?>										
									</h2>									
									<p class="cat_description"  id="searchGeneral<?=$ketc['COD_CATEGORIA']?>" onclick="activarSearch('contentSearch<?=$ketc['COD_CATEGORIA']?>','searchGeneral<?=$ketc['COD_CATEGORIA']?>')" >

										<!--Descripción de <?php echo $ketc['DESCRIPCION']?> -->
										<i class="material-icons" style=" position: relative; top: 5px; left: 5px;">&#xE8B6;</i> Buscar 
									</p>									
	
									<div class="input-group" id="contentSearch<?=$ketc['COD_CATEGORIA']?>" style="display: none;">
										<span class="input-group-addon">
											<i class="material-icons">&#xE8B6;</i>
										</span>
										<input type="search" class="form-control" placeholder="Buscar" id="Search<?=$ketc['COD_CATEGORIA']?>" style=" border-radius: 10px; border: 1px solid #666666;">
									</div>

									
								</div>
								<div class="content">
									<div class="grid">
										<?php foreach ($comidas as $keyco): ?>								
											<?php if ($keyco['CATEGORIA']==$ketc['COD_CATEGORIA']): ?>
												<div class="product" id="<?=$keyco['COD_PRODUCTO'].$ketc['COD_CATEGORIA']?>">
													<div class="product__info">
														<img class="product__image" src="img/categorias/<?=$ketc['IMAGEN']?>" alt="Carne" />
														<h3 class="product__title" plt-cod="<?=$keyco['COD_PRODUCTO']?>"><?=$keyco['NOMBRE']?></h3>
														<span class="product__price highlight">$<?php echo number_format($keyco['PRECIO']);?> *</span>
														<div class="content-count" id="<?php echo $id_content_count; ?>">
															<div class="input-group">
																<span class="input-group-btn">
																	<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[<?php echo $id_quant; ?>]">
																		<span class="glyphicon glyphicon-minus"></span>
																	</button>
																</span>
																<input type="text" name="quant[<?php echo $id_quant; ?>]" class="form-control input-number" value="1" min="1" max="10">
																<span class="input-group-btn">
																	<button type="button" class="btn btn-default btn-number plus" data-type="plus" data-field="quant[<?php echo $id_quant; ?>]">
																		  <span class="glyphicon glyphicon-plus"></span>
																	</button>
																</span>
															</div>
														</div>
														<label class="actions action--button action--compare-add">
															<!---->
															<input class="check-hidden" type="checkbox"/>
															<i class="material-icons plus">&#xE145;</i>
															<i class="material-icons check">&#xE876;</i>
															<span class="action__text">Agregar</span>
															<i id="<?=$keyco['COD_PRODUCTO']?>" class="material-icons plus idPato" onclick="notaPedido('<?=$keyco['COD_PRODUCTO']?>','<?=$keyco['NOMBRE']?>','<?=$ketc['COD_CATEGORIA']?>')" data-cat="<?=$ketc['COD_CATEGORIA']?>" style="width: 20%;">note_add</i> <!--bookmark_border-->
														</label>
														<label style="font-size: 11px;"><?=$keyco['MENSAJE']?> </label>
													</div>
												</div><!-- /product 1 -->	
												<?php $id_content_count += 1; ?>
												<?php $id_quant += 1; ?>
											<?php endif ?>
										<?php endforeach ?>					
									</div><!-- grid -->
								</div>
								<section class="compare">
									<button class="actions action--close-compare"><i class="fa fa-remove"></i><span class="action__text action__text--invisible">Close comparison overlay</span></button>
								</section>
							</div>
						</div>
					</div>
					<?php endforeach ?>
					<button class="action__close-products" aria-label="Close" onclick="desactivarSearch()"><i class="material-icons">&#xE317;</i></button>
				</div>
			</div>
		</div>
		<div class="top-bar-btns">
   			<div class="container-fluid">
    			<a onclick="retrocederMesa()" class="btn btn-raised btn-organge-grad btn-radius btn-inline">
     				<i class="material-icons"></i>
    			</a>
   			</div>
  		</div>


  		<div id="modalNotas" class="modal fade" role="dialog" >
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
						<div class="modal-header text-center">
						<div class="container-fluid">
							<!--<div class="row">									
								<div class="pull-right">
									<a href="#" class="btn btn-raised btn-organge-grad btn-radius btn-inline" data-dismiss="modal" aria-label="Close">
										<i class="material-icons icon-btn">&#xE14C;</i>Salir
									</a>
								</div>
							</div>-->
						</div>
						</div>
					<div class="modal-body">	
						<h4 class="text-center">NOTA DE PLATO</h4>
						<h4 class="text-center" id="notaPlatoName"></h4>
						<div class="row">
							<div class="col-sm-12">
								<div class="content-fact">
									<div id="content-notas">	
										<div class="input-group">
											<input type="text" id="notaPlato" class="form-control" placeholder="Ingresa nota" >
											<div class="input-group-btn">    <!-- Buttons -->
												<a type="button" class="btn btn-raised btn-success btn-radius btn-inline" onclick="addOption()">AÑADIR</a>
											</div>
										</div>
										<div id="selectOptionNote">
											<select multiple="multiple" name="favorite_fruits" id="opcionNotasPlato">
												
										    </select>'
										</div>												
									</div>									
								</div>
							</div>
							<div class="col-sm-12">
								<a class="btn btn-raised btn-success btn-radius btn-inline" id="btnSaveNote">
									GUARDAR
									<div class="ripple-container"></div>
								</a>
								<a class="btn btn-raised btn-organge-grad btn-radius btn-inline" onclick="cerrarModal()">
				     				CANCELAR
				    			</a>
				    			<a class="btn btn-raised btn-organge-grad btn-radius btn-inline" id="btnDeleteNote">
				     				<i class="material-icons">delete</i>
				    			</a>
							</div>
						</div>
					</div>      						
					<div class="modal-footer">
							        							
					</div>
						
				</div>
			</div>
		</div>
	<?php $this->endBody() ?>
	<!--<script src="../web/js/main-menu-new.js"></script>-->
	<!--<script src="../web/js/order_new.js"></script>-->
	<?= Html::jsFile('@web/js/main-menu-new.js') ?>
	<?= Html::jsFile('@web/js/order_new.js') ?>
		<script>
			(function() {
				var categories = new CircleCategories(document.getElementById('categories'));
			})();
		</script>

		<script>			
			// funcion que se ejecuta para tomar el pedido
			function tomapedido(){
				// arrays con los datos del pedido
				var codigos = new Array();
				var cantidad = new Array();
				var puesto  = new Array();

				//arry que tiene los codigos del pedido y la cantidad pedida 
				var datosPedidos = new Array();
				datosPedidos = acomodaPedido();
				// array con los codigos de los platos 
				var codigosPlatos = new Array();
				codigosPlatos = datosPedidos[1];
				//array con la cantidad de los platos
				var cantidadPlatos = new Array();
				cantidadPlatos = datosPedidos[0];
				//array con los puestos 
				var puestosPedido = new Array();
				puestosPedido = datosPuesto(codigosPlatos.length); 
				//identificar si es el primer edido tomado de la mesa
				<?php if($puestos === 0){$pv=0;}else{$pv=1;} ?>
				var primerPedido = '<?=$pv?>'; 
				//si ya hay un pedido une lo ya pedido con lo recien pedido
				if(primerPedido == 1){
					//obtengo los datos de los datos ya establecidos en el otro pedido
					//codigos de los platos ya ordenados
					var codigosPlatos2 = new Array();
					codigosPlatos2 = rellenarArrayCadena('<?=$platos?>');
					//cantidad de los platos ya ordenados
					var cantidadPlatos2 = new Array();
					cantidadPlatos2 = rellenarArrayCadena('<?=$cantidad?>');
					//puesto de los platos ya ordenados
					var puestosPedido2 = new Array();
					puestosPedido2 = rellenarArrayCadena('<?=$puestos?>');

					//se une los codigos de los platos ya pedidos y los q se estan pidiendo
					codigos = unirArray(codigosPlatos2,codigosPlatos);
					//se une las cantidades de los platos ya pedidos y los q se estan pidiendo
					cantidad = unirArray(cantidadPlatos2,cantidadPlatos);
					//se une los puestos de los platos ya pedidos y los q se estan pidiendo
					puestos = unirArray(puestosPedido2,puestosPedido);

				}else{
					//se une los codigos de los platos ya pedidos y los q se estan pidiendo
					codigos = codigosPlatos;
					//se une las cantidades de los platos ya pedidos y los q se estan pidiendo
					cantidad = cantidadPlatos
					//se une los puestos de los platos ya pedidos y los q se estan pidiendo
					puestos = puestosPedido;

				}


				var notas = notasConPedidos(codigosPlatos);

				//ruta que retorna a la mesa para tomar demas pedidos
				var urlMesa = '<?php echo Url::toRoute(['site/mesa'])?>';
				urlMesa = urlMesa +
					'&codigoM='+'<?=$codmesa?>'+
					'&tamanoM='+'<?=$tamano?>'+
					'&estadoM='+'<?=$estado?>'+
					'&platos='+codigos+
					'&cantidad='+cantidad+
					'&puestos='+puestos+
					'&avatars='+'<?=$avatars?>'+
					'&notas='+notas;
				location.href = urlMesa;		

				//var urlMesa = '<?php echo Url::toRoute(['site/mesa'])?>';
				//location.href = urlMesa+'&platos='+codigos+'&cantidad='+cantidad+'&puestos='+puestos;
				//
			}

			//funcion para comodar todo lo escogido del menu
			function acomodaPedido(){
				//array donde van a estar los codigos de los productos
				var listaPlatos = new Array();
				// se llena el array
				<?php foreach($comidas as $keyCC){ ?>
			        listaPlatos.push('<?php echo $keyCC['COD_PRODUCTO']; ?>');
			    <?php } ?>			    
				//obtengo la lista de los div que se generan por cada producto que se ha adicionado 
				var listaPedido =  ($('div.compare-basket').children('div'));					
				//cada div adicionado los separo y los acomodo en un array
				var arrayDatos = $.map(listaPedido, function(value, index) {
					return [value];
				});	
				// obtengo la cantidad de div que se generaron 
				var tamano = arrayDatos.length;
				// array donde se almacena los valor 
				var idDiv = new Array();
				var idPltPedido = new Array();
				// recorro el array y obtengo el id de cada uno 				
				for(var i=0 ; i<tamano ; i++){
					//obtengo el id del div y la cantida seleccionada 
					idDiv.push(arrayDatos[i].id);
					idPltPedido.push($(arrayDatos[i]).attr("data-info"));
				}				
				//
				var cantidadPedido = new Array();
				var codigoPedido = new Array();
				//
				for(var j=0 ; j<idDiv.length ; j++){
					var temp = idDiv[j].split(":");
					cantidadPedido.push(temp[1]);

					var buscarID = idPltPedido[j].substring(idPltPedido[j].indexOf("plt-cod"));
			    	buscarID = (buscarID.substring(buscarID.indexOf("\""),buscarID.indexOf(">"))).trim();    	
			    	buscarID = buscarID.substr(1,buscarID.length-2);

					codigoPedido.push(buscarID);
				}				

				/*for(var k=0 ; k<codigoPedido.length ; k++){
					codigoPedido[k] = listaPlatos[codigoPedido[k]]
				}	*/			
				//console.log(cantidadPedido);
				//console.log(codigoPedido);

				var datosTotal = new Array();
				datosTotal = [cantidadPedido,codigoPedido];


				return datosTotal;
			}

			function retrocederMesa(){
				//url a la que se redirecciona
				var urlMesa = '<?php echo Url::toRoute(['site/mesa'])?>';
				//url actual
				var urlActual = window.location.href;
				//posicion de los parametros
				var posParams = urlActual.search("&");
				//parametros de la url
				var urlParams = urlActual.substring(posParams);
				

				//se cancela el avatar tambien seleccionado
				for (var i=1 ; i<=urlParams.length ; i++) {					

					var cadenaOpuesta = urlParams.substring(urlParams.length-i,urlParams.length);
					
					var caracter = cadenaOpuesta.substring(0,1);
					
					// si es la primera vez que toma un pedido en mesa
					if('<?=$platos?>'.localeCompare("0") == 0){
						if(caracter.localeCompare("&") == 0){
							urlParams = urlParams.substring(0,urlParams.length-i);
							console.log("url break: "+urlParams);
							break;
						}	
					}

					// despues de haber tomado el primer pedido en mesa
					if('<?=$platos?>'.localeCompare("0") != 0){
						if(caracter.localeCompare(",") == 0){
							urlParams = urlParams.substring(0,urlParams.length-i);
							console.log("url break: "+urlParams);
							break;
						}	
					}					
					
				}	
				
				location.href = urlMesa+"&"+urlParams;
				
				
			}

			function datosPuesto(tamano){
				var puestoPedido = '<?php echo $puesto; ?>';
				var arrayPuestos = new Array();

				for (var i=0 ; i<tamano ; i++){
					arrayPuestos.push(puestoPedido);
				}

				return arrayPuestos;
			}

			function unirArray(array1, array2){
				var arrayUnido = new Array();

				for (var i=0 ; i<array1.length ; i++) {
					arrayUnido.push(array1[i]);
				}

				for (var j=0 ; j<array2.length ; j++) {
					arrayUnido.push(array2[j]);
				}

				return arrayUnido;
			}

			function rellenarArrayCadena(datos){
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

		</script>
	</body>
</html>
<?php $this->endPage() ?>


<script type="text/javascript">

	var comidas = JSON.parse('<?=json_encode($comidas)?>'); // platos donde se van a buscar las palabras de los inputs
	var categorias = JSON.parse('<?=json_encode($categorias)?>'); // datos de las categorias 
	var searchActivo; // id de buscador que se usa para una categoira x
	var searchPulsado; // id de la descripcion que muestra el input
	var searchInput; // id del input search
	var idCateg; // id se la categoria en la que esta buscando

	ationSearch();

	function ationSearch(){
		//
		for(i=0 ; i<categorias.length ; i++){

			var id = "#Search"+categorias[i]['COD_CATEGORIA'];
			var codigo = categorias[i]['COD_CATEGORIA'];

			$(id).on('keyup', function () {
				var categoria = this.id.substring(this.id.length-2, this.id.length);
				var identificador = "#"+this.id;

				doneTyping(categoria,identificador);				
			});			
		}
	}

	//user is "finished typing," do something
	function doneTyping(codigoCategoria, idInput) { 
		
		var digitado = $(idInput).val();

		for(i=0 ; i<comidas.length ; i++){

			if(comidas[i]['CATEGORIA'].localeCompare(codigoCategoria) == 0){

				var codigoBloque = "#"+comidas[i]['COD_PRODUCTO']+codigoCategoria;
				codigoBloque =codigoBloque.replace(/ /g , "");

				var nombrePlato = comidas[i]['NOMBRE'];			

				if(nombrePlato.indexOf(digitado.toUpperCase()) == -1){					
					$(codigoBloque).hide();
				}else{
					$(codigoBloque).show();
				}
			}
		}
	}	

	function activarSearch(idSearch,idGeneral){				
		$("#"+idSearch).show();
		$("#"+idGeneral).hide();

		searchActivo = idSearch;
		searchPulsado = idGeneral;
		
		var idBuscador = "Search"+idSearch.substring(idSearch.length, idSearch.length-2);
		searchInput = idBuscador;
		idCateg = idSearch.substring(idSearch.length, idSearch.length-2)

		document.getElementById(idBuscador).focus();
	}

	function desactivarSearch(idSearch){		
		$("#"+searchActivo).hide();
		$("#"+searchPulsado).show();		

		$("#"+searchInput).val('');

		doneTyping(idCateg,"#"+searchInput);

		searchActivo = '';
	}

	/////////////////////////
	var contadorPedido = 0;
	var nombrePlatoNota = new Array();
	var codigoPlato = new Array();
	var notaPlato = new Array();

	function cerrarModal(){
		$('#modalNotas').modal('hide');		
	}

	function notaPedido(id,nombre,categoria){		

		$("#notaPlatoName").html(nombre);

		//$('#modalNotas').modal('show');
		$('#modalNotas').modal({backdrop: 'static', keyboard: false})

		$("#btnSaveNote").attr('onclick','guardarNotaPlato("'+id+'","'+nombre+'")');

		$.ajax({
			url:'<?php echo Url::toRoute(['site/carganotaspedido']); ?>',	
			dataType:'json',								
			method: "GET",
			data: {'categoria':categoria,'plato':id},
			success: function (data) {	
				//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
				var arrayDatos = $.map(data, function(value, index) {
	    			return [value];
				});		

				$("#opcionNotasPlato").html("");				
				$(".non-selected-wrapper").html("");	
				$(".selected-wrapper").html("");

				var notasPlato = arrayDatos[0];
				var opcionesNota1 = '';
				var opcionesNota2 = '';

				for(var i=0 ; i<notasPlato.length ; i++){
					opcionesNota1 = opcionesNota1 + '<option>'+notasPlato[i]+'</option>';
					opcionesNota2 = opcionesNota2 + '<a tabindex="0" class="item" role="button" data-value="'+notasPlato[i]+'" multi-index="'+i+'">'+notasPlato[i]+'</a>';

					contadorPedido = i;
				}

				$("#opcionNotasPlato").html(opcionesNota1);				
				$(".non-selected-wrapper").html(opcionesNota2);				

				var select = document.getElementById('opcionNotasPlato');
		    	multi(select,{
		    		'search_placeholder': 'Buscar...',
		    	});		

		    	$("#btnDeleteNote").hide();		
			}
		});	
	}	

	function guardarNotaPlato(idPlato, nomPlato){				
		var inputSelects = $("#opcionNotasPlato").val();

		if(!!inputSelects){

			var platoRepetido = -1;

			for(var i=0 ; i<codigoPlato.length ; i++){
				if(codigoPlato[i].localeCompare(idPlato) == 0){
					platoRepetido = i;
				}
			}

			if(platoRepetido < 0){
				nombrePlatoNota.push(nomPlato);
				codigoPlato.push(idPlato);
				notaPlato.push(arrayToChar(inputSelects));
			}else{
				notaPlato[platoRepetido] = arrayToChar(inputSelects);
			}	

			cerrarModal();
		}else{
			swal("Datos vacíos","Debe agregar una nota, de lo contrario cancele la operación","warning");
		}

	}

	function addOption(){		
		contadorPedido++;

		var valorNuevo = $("#notaPlato").val();
		valorNuevo = valorNuevo.toUpperCase();

    	$("#opcionNotasPlato").append('<option selected="selected">'+valorNuevo+'</option>');
    	$(".non-selected-wrapper").append('<a tabindex="0" class="item selected" role="button" data-value="'+valorNuevo+'" multi-index="'+contadorPedido+'">'+valorNuevo+'</a>')
    	$(".selected-wrapper").append('<a tabindex="0" class="item selected" role="button" data-value="'+valorNuevo+'" multi-index="'+contadorPedido+'">'+valorNuevo+'</a>')

    	var select = document.getElementById('opcionNotasPlato');
    	multi(select,{
    		'search_placeholder': 'Buscar...',
    	});

    	$("#notaPlato").val("");
    }

    function removeNote(item){

    	var idPlato = (item.id);
    	idPlato = idPlato.substring(0, idPlato.length-2);
    	
    	for(var i=0 ; i<codigoPlato.length ; i++){
    		if(codigoPlato[i].localeCompare(idPlato) == 0){
    			nombrePlatoNota.splice(i, 1);
    			codigoPlato.splice(i, 1);
				notaPlato.splice(i, 1);
    		}
    	}

    }

    function verNotaPlato(atributo){    
    	//capturar e id del plato que esta clickeando
    	var idPlato = atributo.substring(atributo.indexOf("<i id="));
    	idPlato = (idPlato.substring(idPlato.indexOf("\""),idPlato.indexOf("class"))).trim();    	
    	idPlato = idPlato.substr(1,idPlato.length-2);
    	// captura el codigo de la categoria a la que pertenece el plato
    	var idCategNota = atributo.substring(atributo.indexOf("data-cat"));
    	idCategNota = (idCategNota.substring(idCategNota.indexOf("\""),idCategNota.indexOf("style"))).trim();
    	idCategNota = idCategNota.substr(1,idCategNota.length-2);    	
    	//array que contiene las notas dle plato
    	var notasArray = new Array();
    	//identifico el plato ue selecciono en el array de las notas
    	for(var i=0 ; i<codigoPlato.length ; i++){
    		if(idPlato.localeCompare(codigoPlato[i]) == 0){
    			notasArray = crearArray(notaPlato[i]);
    			$("#notaPlatoName").html(nombrePlatoNota[i]);
    		}
    	}
    	//limpia el selector de notas
    	$("#opcionNotasPlato").html("");				
		$(".non-selected-wrapper").html("");	
		$(".selected-wrapper").html("");

    	$.ajax({
			url:'<?php echo Url::toRoute(['site/carganotaspedido']); ?>',	
			dataType:'json',								
			method: "GET",
			data: {'categoria':idCategNota,'plato':idPlato},
			success: function (data) {	
				//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
				var arrayDatos = $.map(data, function(value, index) {
	    			return [value];
				});

				var notasPlato = arrayDatos[0];		
				var notaCount = 0;		
				var opcionesNota1 = '';

				contadorPedido = 0;

				for(var i=0 ; i<notasPlato.length ; i++){					

					for(var j=0 ; j<notasArray.length ; j++){						

						if(notasPlato[i].localeCompare(notasArray[j]) == 0){														
							notaCount++;							
						}
					}					

					if(notaCount == 0){
						//opcion en input no selecciondos
						opcionesNota1 = opcionesNota1 + '<option>'+notasPlato[i]+'</option>';												
					}

					notaCount = 0;					
				}


				for(var i=0 ; i<notasArray.length ; i++){						
					//option en el input que fueron seleccionados
					opcionesNota1 = opcionesNota1 + '<option selected="selected">'+notasArray[i]+'</option>';															
				}	
						
				$("#selectOptionNote").html(
						'<select multiple="multiple" name="favorite_fruits" id="opcionNotasPlato">'+
							opcionesNota1+
					    '</select>'
					);

				var select = document.getElementById('opcionNotasPlato');

		    	multi(select,{
		    		'search_placeholder': 'Buscar...',
		    	});			    			    	
		    	
				/*$(".selected-wrapper").append(opcionesNota3);*/

		    	$('#modalNotas').modal('show');		
		    	$("#btnDeleteNote").show();
		    	$("#btnDeleteNote").attr("onclick","eliminarNota(\'"+idPlato+"\')");
		    	$("#btnSaveNote").attr('onclick','guardarNotaPlato("'+idPlato+'")');
		    }
		});	
    }

    function eliminarNota(platoEliminar){

    	for(var i=0 ; i<notaPlato.length ; i++){
    		if(platoEliminar.localeCompare(codigoPlato[i]) == 0){
    			nombrePlatoNota.splice(i, 1);
    			codigoPlato.splice(i, 1);
				notaPlato.splice(i, 1);
    		}
    	}

    	cerrarModal();
    }

    function notasConPedidos(codigo){    	
    	var notasRealizadas = crearArray('<?=$notas?>');
		var notaPlatoReturn = new Array();

		var contadorNotas = 0;		

		for(var i=0 ; i<codigo.length ; i++){

			var posicionNota;

			for(var j=0 ; j<codigoPlato.length ; j++){
				if(codigo[i].localeCompare(codigoPlato[j]) == 0){
					contadorNotas++;
					posicionNota = j;
				}
			}

			if(contadorNotas > 0){
				notaPlatoReturn.push(notaPlato[posicionNota].replace(",",'*_'));
			}else{
				notaPlatoReturn.push("");
			}		

			contadorNotas = 0;
		}

		if(notasRealizadas != 0){
			
			notaPlatoReturn = notasRealizadas.concat(notaPlatoReturn);			
		}

		return notaPlatoReturn;
    }
</script>



<script type="text/javascript">
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
</script>