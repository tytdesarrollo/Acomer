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
		<script src="js/modernizr-custom.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
	<body class='bg-acomer'>
	<?php $this->beginBody() ?>
	<!--DIV DONDE VAN LO QUE SE AGREGA A PEDIDO -->
		<div class="compare-basket" id="listaPedidos">
			<button class="actions action--button action--compare" onclick="tomapedido()"><i class="fa fa-check"></i><span class="action__text">Agregar al pedido</span></button>
		</div>

	<!--DIV DE MENU-->
		<div class="content-main">
			<div id="slideshow" class="slideshow">
				<?php $id_content_count = 0;?> <!--VARIABLE PARA ASIGNAR EL ID DEL DIV QUE CONTIENE LOS PLATOS-->
				<?php $id_quant = 1;?>	<!--VARIABLE PARA ASIGNAR EL CONSECUTIVO DEL ARRAY QUANT-->
				<?php foreach ($categorias as $ketc): ?>
					<div class="slide">
						<h2 class="slide__title slide__title--preview"><?php echo $ketc['DESCRIPCION']?></h2>
						<div class="slide__item">
							<div class="slide__inner">
								<img class="slide__img slide__img--small" src="img/categorias/parrilla.png" alt="Carnes a la Parrilla" />
								<button class="action action--open" aria-label="View details"><i class="material-icons">&#xE145;</i></button>
							</div>
						</div>
						<div class="slide__content">
							<div class="slide__content-scroller">
								<div class="slide__details">
									<h2 class="slide__title slide__title--main"><?php echo $ketc['DESCRIPCION']?></h2>
									<?php if ($ketc['DESCRIPCION']=='Bebidas'): ?>
										<p class="slide__description">Descripción de <?php echo $ketc['DESCRIPCION']?></p>
									<?php else: ?>
										<p class="slide__description">Descripción comida de <?php echo $ketc['DESCRIPCION']?></p>
									<?php endif ?>									
								</div><!-- /slide__details 1 -->
								<div class="content">
									<div class="grid">
									<?php foreach ($comidas as $keyco): ?>								
										<?php if ($keyco['CATEGORIA']==$ketc['COD_CATEGORIA']): ?>
											<div class="product">
												<div class="product__info">
													<img class="product__image" src="img/items/carne.png" alt="Carne" />
													<h3 class="product__title"><?=$keyco['NOMBRE']?></h3>
													<span class="product__price highlight">$<?php echo number_format($keyco['PRECIO']);?></span>
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
													<label class="actions action--button action--compare-add" id="45">
														<input class="check-hidden" type="checkbox"/><!--onclick="tomapedido('<?php echo $keyco['COD_PRODUCTO']?>')"-->
														<i class="material-icons plus">&#xE145;</i>
														<i class="material-icons check">&#xE876;</i>
														<span class="action__text" >Agregar</span> 
													</label>
												</div>
											</div><!-- /product 1 -->	
											<?php $id_content_count += 1; ?>
											<?php $id_quant += 1; ?>
										<?php endif ?>
									<?php endforeach ?>								
									</div><!-- grid -->
								</div><!-- content -->
								<section class="compare">
									<button class="actions action--close-compare"><i class="fa fa-remove"></i><span class="action__text action__text--invisible">Close comparison overlay</span></button>
								</section>
							</div><!-- slide__content-scroller 1 -->
						</div><!-- slide__content 1 -->
					</div>
				<?php endforeach ?>
				
				
				<button class="action action--close" aria-label="Close"><i class="material-icons">&#xE317;</i></button>
			</div>
		</div>
	<?php $this->endBody() ?>
		<script>
			(function() {
				var slideshow = new CircleSlideshow(document.getElementById('slideshow'));
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
				
				console.log(codigos);
				console.log(cantidad);
				console.log(puestos);

				//ruta que retorna a la mesa para tomar demas pedidos
				//var urlMesa = '<?php echo Url::toRoute(['site/mesa'])?>';
				//location.href = urlMesa+'&platos='+codigos+'&cantidad='+cantidad+'&puestos='+puestos;
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
				// recorro el array y obtengo el id de cada uno 				
				for(var i=0 ; i<tamano ; i++){
					//obtengo el id del div y la cantida seleccionada 
					idDiv.push(arrayDatos[i].id);
				}
				//
				var cantidadPedido = new Array();
				var codigoPedido = new Array();
				//
				for(var j=0 ; j<idDiv.length ; j++){
					var temp = idDiv[j].split(":");
					cantidadPedido.push(temp[1]);
					codigoPedido.push(temp[0]);
				}

				for(var k=0 ; k<codigoPedido.length ; k++){
					codigoPedido[k] = listaPlatos[codigoPedido[k]]
				}				
				//console.log(cantidadPedido);
				//console.log(codigoPedido);

				var datosTotal = new Array();
				datosTotal = [cantidadPedido,codigoPedido];

				return datosTotal;
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