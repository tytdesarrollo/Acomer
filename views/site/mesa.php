<?php
	use yii\helpers\Html;
	use app\assets\AppAsset;
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
	use yii\helpers\Url;

	AppAsset::register($this);

	$this->title = 'Acomer';

	$request = Yii::$app->request;

	// variables de sesiones para el manejo de las mesas
	session_start();	

?>

<?php 
	$this->beginPage() 
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
	    <meta charset="<?= Yii::$app->charset ?>">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <?= Html::csrfMetaTags() ?>
	    <title><?= Html::encode($this->title) ?></title>
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	    <?php $this->head() ?>
	</head>
	<body class='bg-acomer'>
	<?php $this->beginBody() ?>
		<div class="main-mesa">
			<div class="main-content-select-puestos">
				<div class="mrg__bottom-30">
					<div class="container-fluid">
						<div class="pull-right">
							<a href="<?php echo Url::toRoute(['site/plaza']); ?>" class="btn btn-raised btn-organge-grad btn-radius btn-inline">
								<i class="material-icons">&#xE14C;</i>
							</a>
						</div>
					</div>
				</div>
				<div class="text-center">
					<h2 class="txt__light-70">Selecciona el número de puestos</h2>
				</div>
				<div class="content-select-puestos mrg__bottom-30">
					<div class="input-group">
						<span class="input-group-btn">
							<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="selectPuestos">
								<span class="glyphicon glyphicon-minus"></span>
							</button>
						</span>
						<input id="numPersonas" type="text" name="selectPuestos" class="form-control input-number" value="1" min="1" max="6">
						<span class="input-group-btn">
							<button type="button" class="btn btn-default btn-number plus" data-type="plus" data-field="selectPuestos">
								  <span class="glyphicon glyphicon-plus"></span>
							</button>
						</span>
					</div>
				</div>
				<div class="text-center">
					<a id="NPuestos" onClick="personasMesa()" class="btn btn-raised btn-success btn-radius btn-inline">
						<i class="material-icons">&#xE5CA;</i>
					</a>
				</div>
			</div>
			<div class="main-content-unir-mesa">
				<div class="mrg__bottom-30">
					<div class="container-fluid">
						<div class="pull-right">
							<a href="#" id="cancelMesa" class="btn btn-raised btn-organge-grad btn-radius btn-inline">
								<i class="material-icons">&#xE317;</i>
							</a>
						</div>
					</div>
				</div>
				<div class="text-center">
					<h2 class="txt__light-70">Selecciona una mesa disponible para unir</h2>
				</div>
				<div class="content-unir-mesa">
					<div class="container">
						<div class="row">
							<!--LISTA 1 DE LAS MESA DISPONIBLES PARA UNIR-->
							<div class="col-sm-6 col-md-6 divider" id="listaMesas1">
								
							</div>

							<!--LISTA 2 DE LAS MESAS DISPONIBLES PARA UNIR-->
							<div class="col-sm-6 col-md-6" id="listaMesas2">
								
							</div>
						</div>
					</div>
				</div>
			</div>

			

			<div class="main-content-mesa">				

				<div class="main-content-puestos text-center" >		
					<!--DIV PARA LA MESA CON 4 PUESTOS-->		
					<div class="content-puestos mesax4p" id="mesaPuestos4">
						
					</div>
					<!--DIV PARA LA MESA CON 6 PUESTO-->
					<div class="content-puestos mesax6p" id="mesaPuestos6">
						
					</div>
					<!--DIV PARA LA MESA CON 8 PUESTO-->
					<div class="content-puestos mesax8p" id="mesaPuestos8">
						
					</div>
				</div>

				<div class="top-bar-btns">
					<div class="container-fluid">
						<div class="pull-left">
							<a onClick="retrocederMesa()" class="btn btn-raised btn-organge-grad btn-radius btn-inline">
								<i class="material-icons">&#xE317;</i>
							</a>
							<a onClick="showAvatars()" class="btn btn-raised btn-organge-grad btn-radius btn-inline" data-toggle="modal" data-target="#personajesModal">
								<i class="material-icons"></i>Prueba_Personajes
							</a>
						</div>
						<div class="pull-right">
							<a onClick="verPedido()" class="btn btn-raised btn-organge-grad btn-radius btn-inline" data-toggle="modal" data-target="#pedidoModal">
								<i class="material-icons icon-btn">&#xE556;</i>Ver pedido
							</a>
							<a onClick="verFactura()" class="btn btn-raised btn-success btn-radius btn-inline" data-toggle="modal" data-target="#facturaModal">
								<i class="material-icons icon-btn">&#xE8B0;</i>Facturar
							</a>
						</div>
					</div>
				</div>
			</div>

			<!--MODAL DEL Prueba_P-->
			<div class="modal list-pedidos fade" id="personajesModal" tabindex="-1" role="dialog" aria-labelledby="pedidoModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal_personajes">
						<div class="modal-header">
							<div class="container-fluid">
								<div class="row">
									<div class="pull-right">
										<a href="#" class="btn btn-raised btn-organge-grad btn-radius btn-inline" data-dismiss="modal" aria-label="Close">
											<i class="material-icons icon-btn">&#xE14C;</i>Cancelar
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12 txt__light-100">
										<h4 id="puestoDetalle" class="centrarh4"><span>Selecciona el tipo de cliente</span></h4>
									<div class="row menos">
										<img class="animate_avatar" src="../web/img/personajes/uviejo1.svg" alt="">
										<img class="animate_avatar" src="../web/img/personajes/uadulto1.svg" alt="">
										<img class="animate_avatar" src="../web/img/personajes/unino1.svg" alt="">
									</div>
									<div class="row menos">
										<img class="animate_avatar" src="../web/img/personajes/uviejo2.svg" alt="">
										<img class="animate_avatar" src="../web/img/personajes/uadulto2.svg" alt="">
										<img class="animate_avatar" src="../web/img/personajes/unino2.svg" alt="">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--MODAL DEL PEDIDO-->
			<div class="modal list-pedidos fade" id="pedidoModal" tabindex="-1" role="dialog" aria-labelledby="pedidoModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<div class="container-fluid">
								<div class="row">
									<div class="pull-right">
										<a onClick="mensajeAlerta(2)" class="btn btn-raised btn-organge-grad btn-radius btn-inline">
											<i class="material-icons icon-btn">&#xE14B;</i>Cancelar Todo
										</a>
										<a onClick="realizarPedido()" class="btn btn-raised btn-success btn-radius btn-inline">
											<i class="material-icons icon-btn">&#xE877;</i>Confirmar Pedido
										</a>
										<a href="#" class="btn btn-raised btn-organge-grad btn-radius btn-inline" data-dismiss="modal" aria-label="Close">
											<i class="material-icons icon-btn">&#xE14C;</i>Salir
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<h2 class="no-mrg-top">Pedidos por confirmar</h2>
							<div class="row">
								<div class="col-sm-6">
								<!--FIN DE PEDIDOS QUE POR CONFIRMAR-->
									<div class="table-wrapper view-List-pedidos">
										<table>
											<tbody>		
												<?php if ($platos === 0): ?>
													<tr class="default">
														<td>Mesa sin pedidos por confirmar</td>														
													</tr>													
												<?php else: ?>
													<?php if ($tamano <= 4): ?>
														<tr class="default active">
															<td id="tituloMesa4">Mesa <?=$codigomesa?></td>	
															<td><span class="arrow" id="flechaPuestos4">arrow</span></td>											
														</tr>
														<tr class="toggle-row">
															<td colspan="5">
																<div class="sub-table-wrap" id="listaPuestos4"></div>
															</td>
														</tr>	
													<?php else: ?>
														<?php if ($tamano >= 5 && $tamano <= 6): ?>
																<!--MESA 1 PARA 6 PERSONAS-->
																<tr class="default active">
																	<td id="tituloMesa61">Mesa <?=$codigomesa?></td>	
																	<td><span class="arrow" id="flechaPuestos61">arrow</span></td>											
																</tr>
																<tr class="toggle-row">
																	<td colspan="5">
																		<div class="sub-table-wrap" id="listaPuestos61"></div>
																	</td>
																</tr>	
																<!--MESA 2 PARA 6 PERSONAS-->
																<tr class="default" id="detalleMesa62">
																	<td id="tituloMesa62">Mesa <?=$_SESSION["mesa1"]?></td>	
																	<td><span class="arrow" id="flechaPuestos62">arrow</span></td>											
																</tr>
																<tr class="toggle-row">
																	<td colspan="5">
																		<div class="sub-table-wrap" id="listaPuestos62"></div>
																	</td>
																</tr>	
														<?php endif ?>
														
													<?php endif ?>
													
												<?php endif ?>
																						
											</tbody>
										</table>
									</div>
								<!--FIN DE PEDIDOS QUE POR CONFIRMAR-->

								<br>

								<!--INICIO DE PEDIDOS CONFIRMADOS-->
									<h2 class="no-mrg-top">Pedidos confirmados</h2>
									<div class="table-wrapper view-List-pedidos">
										<table>
											<tbody>		
												<?php if ($confirmados === 0): ?>
													<tr class="default">
														<td>Mesa sin pedidos confirmados</td>														
													</tr>													
												<?php else: ?>
													<?php if ($tamano <= 4): ?>
														<tr class="default active">
															<td id="tituloMesaC4">Mesa <?=$codigomesa?></td>	
															<td><span class="arrow" id="flechaPuestosC4">arrow</span></td>											
														</tr>
														<tr class="toggle-row">
															<td colspan="5">
																<div class="sub-table-wrap" id="listaPuestosC4"></div>
															</td>
														</tr>	
													<?php else: ?>
														<?php if ($tamano >= 5 && $tamano <= 6): ?>
																<!--MESA 1 PARA 6 PERSONAS-->
																<tr class="default active">
																	<td id="tituloMesa61">Mesa <?=$codigomesa?></td>	
																	<td><span class="arrow" id="flechaPuestos61">arrow</span></td>											
																</tr>
																<tr class="toggle-row">
																	<td colspan="5">
																		<div class="sub-table-wrap" id="listaPuestos61"></div>
																	</td>
																</tr>	
																<!--MESA 2 PARA 6 PERSONAS-->
																<tr class="default" id="detalleMesa62">
																	<td id="tituloMesa62">Mesa <?=$_SESSION["mesa1"]?></td>	
																	<td><span class="arrow" id="flechaPuestos62">arrow</span></td>											
																</tr>
																<tr class="toggle-row">
																	<td colspan="5">
																		<div class="sub-table-wrap" id="listaPuestos62"></div>
																	</td>
																</tr>	
														<?php endif ?>
														
													<?php endif ?>
													
												<?php endif ?>
																						
											</tbody>
										</table>
									</div>
								<!--FIN DE PEDIDOS QUE CONFIRMADOS-->

								
								</div>


																				
											
								<div class="col-sm-6">
									<div class="content-view-pedido txt__light-100">
										<div class="content-head-view-pedido clearfix">
											<div class="pull-left">
												<h4 id="puestoDetalle"><span class="txt__lightorange">Puesto </span></h4>
											</div>
											<div class="pull-right ">
												<div id="mesaDetalle">
													
												</div>
											</div>
										</div>
										<div class="content-list-view-pedido-item table-responsive">
											<table>
												<tbody id="platosDetalle">
													
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--MODAL FACTURA-->
			<div class="modal m-facturar fade" id="facturaModal" tabindex="-1" role="dialog" aria-labelledby="facturaModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<div class="container-fluid">
								<div class="row">
									<div class="pull-left">
										<div class="btn-factura-action-content" onclick="opcionFacturar()">
											<a id="btn-fact" href="#" class="btn btn-raised btn-success btn-radius btn-inline btn-factura" data-type="modal-view-factura-action">Facturar</a>
											<span class="modal-view-factura-bg"></span>
										</div>										
									</div>
									<div class="pull-right">
										<a href="#" class="btn btn-raised btn-organge-grad btn-radius btn-inline" data-dismiss="modal" aria-label="Close">
											<i class="material-icons icon-btn">&#xE14C;</i>Salir
										</a>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-body">
							<h2 class="text-center">Selecciona los puestos a facturar</h2>
							<div class="row">
								<div class="col-sm-6">
									<div class="content-fact">
										<div class="table-responsive">
											<table id="data-table" class="table table-hover">
												<thead>
													<tr>
														<th class="select-cell" id="checkAll">
															<div class="checkbox">
															  <label>
																<input name="select_all" value="1" type="checkbox" id="check0">
															  </label>
															</div>
														</th>
														<th id="tituloMesaFac">Mesa 1</th>
													</tr>
												</thead>
												<tbody id="puestosFactura4">
													<tr id="facturaPuesto1">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check1">
															  </label>
															</div>
														</td>
														<td>Pedido puesto 1</td>
													</tr>
													<tr id="facturaPuesto2">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check2">
															  </label>
															</div>
														</td>
														<td>Pedido puesto 2</td>
													</tr>
													<tr id="facturaPuesto3">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check3"> 
															  </label>
															</div>
														</td>
														<td>Pedido puesto 3</td>
													</tr>
													<tr id="facturaPuesto4">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check4">
															  </label>
															</div>
														</td>
														<td>Pedido puesto 4</td>
													</tr>
													<tr id="facturaPuesto5">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check5">
															  </label>
															</div>
														</td>
														<td>Pedido puesto 5</td>
													</tr>
													<tr id="facturaPuesto6">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check6">
															  </label>
															</div>
														</td>
														<td>Pedido puesto 6</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>								
							</div>
						</div>

						<div class="modal-view-factura">
							<div class="modal-view-factura-content">
								<div class="container">
									<div class="box-factura-content">
										<div class="clearfix">
											<div class="logo-factura-content pull-left">
												<?= Html::img('@web/img/logo_small_gray.png', ['alt' => 'Acomer', 'class' => 'img-responsive',]) ?>
											</div>
											<div class="pull-right">
												<div class="num-factura-content">
													<dl class="num-fact">
														<dt>Fecha</dt>
														<dd id="fechaFactura">17-07-2017</dd>
													</dl>
													<dl class="divider">
														<div></div>
													</dl>
													<dl class="num-fact">
														<dt>Factura</dt>
														<dd id="numeroFactura">#0001</dd>
													</dl>
												</div>
											</div>
										</div>
										<hr>
										<div class="detail-factura-content">
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th>Producto</th>
															<th>unidad</th>
															<th>Precio</th>
														</tr>
													</thead>
													<tbody id="listadoFactura">
														
													</tbody>
												</table>
											</div>
											<div class="total-factura-content clearfix">
												<div id="btnImprimir" class="btn-factura-box pull-left">
													<a onClick="imprimirRecibo()" id="labelImprimir"  href="#" class="btn btn-raised btn-info btn-radius btn-inline">
														Salir<i class="material-icons">&#xE5C8;</i>
													</a>
												</div>
												<div class="total-factura-box pull-right">
													<span class="total-txt">Total</span>
													<span class="total-num" id="totalFactura">$000.000</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> <!-- cd-modal-content -->
						</div> <!-- cd-modal -->
						<a id="cerrarFacturar" class="modal-view-factura-close"><i class="material-icons">&#xE14C;</i></a>
					</div>
				</div>
			</div>
		</div>
<?php $this->endBody() ?>
	<script src="../web/js/modal_view_fact.js"></script>
	<script>
	  $(function () {
		$.material.init();
	  });
	</script>
	<script>
		$("#cancelMesa").click(function(){
			$(".main-content-unir-mesa").removeClass("in");
			$(".main-content-select-puestos").removeClass("out");
		});
	</script>
	<script>
		$(document).ready(function ($) {
		  $('.active').next().find('.sub-table-wrap').show();
		  $('.default').click(function () {    
			$('.default').not($(this)).removeClass('active');
			$(this).toggleClass('active').next().find('.sub-table-wrap').slideToggle();
			$(".toggle-row").not($(this).next()).find('.sub-table-wrap').slideUp('fast');
		  });
		});
	</script>
	<script>
		var dataTable = document.getElementById('data-table');
		var checkItAll = dataTable.querySelector('input[name="select_all"]');
		var inputs = dataTable.querySelectorAll('tbody>tr>td.select-cell input');
		var btnFact = document.getElementById('btn-fact');

		inputs.forEach(function(input) {
		  input.addEventListener('change', function() {
			if (!this.checked) {
			  checkItAll.checked = false;
			}else if (!checkItAll.checked) {
			  var allChecked = true;
			  for (var i=0; i<inputs.length; i++) {
				if (!inputs[i].checked) {
				  allChecked = false;
				  break;
				}
			  }
			  if (allChecked) {
				checkItAll.checked = true;
			  }
			}
		  });
		});

		checkItAll.addEventListener('change', function() {
		  inputs.forEach(function(input) {
			input.checked = checkItAll.checked;
		  });
		});
	</script>

	<script type="text/javascript">
		var generalEstadoM = '<?=$estadomesa?>';
		var generalCodigoM = '<?=$codigomesa?>';
		var generalPlatos = '<?=$platos?>';		
		var generalCantidad = '<?=$cantidad?>';
		var generalPuestos = '<?=$puestos?>';		
		var generalTamano = '<?=$tamano?>'; 
		var generalarrPuestos = '<?=$arrpuestos?>';
		var generalMesa1 = '<?php if(isset($_SESSION['mesa1'])){echo $_SESSION['mesa1'];}else{echo 0;}?>';
		var generalConfirmado = '<?=$confirmados?>';
		var generalConfirmPlatos;
		var generalConfirmCantidad;
		var generalConfirmPuestos;
		var generalConfirmPlaCod;



	</script>


	<script type="text/javascript">		
		$(xVez());
		$(validarCheck());
		$(pedidosConfirmados());
		$(nombrePlatos());
		$(habilitarBotones());

		function mesasDisponiblesR(){
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
					//almaceno los valores pertenecientes al estado de las mesas
					var estadosMesas = arrayDatos[1];
					
					var mesas = new Array();
					mesas = cargarMesas(estadosMesas);						

					//muestros las mesas en la plaza
					document.getElementById("listaMesas1").innerHTML = mesas[0];
					document.getElementById("listaMesas2").innerHTML = mesas[1];
				}
			});
		}setInterval(mesasDisponiblesR, 1000);

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
				codMes = '<?php if(!isset($_SESSION["mesa1"])){ echo "undefined";}else{echo $_SESSION["mesa1"];}?>';
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
		$(".main-content-mesa").addClass("in");
	}

	function mesaOut(){
		$(".main-content-unir-mesa").addClass("in");
		$(".main-content-mesa").addClass("out");
	}

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
			$(".main-content-select-puestos").addClass("out");
			//muestro las mesa de 4 puestos 
			$(".main-content-mesa").addClass("in");
			// oculto las mesas con mas o menos puestos que la necesaria
			document.getElementById('mesaPuestos4').style.display = 'block';
			document.getElementById('mesaPuestos6').style.display = 'none';
			document.getElementById('mesaPuestos8').style.display = 'none';
			
		}else{			
			// oculta la seleccion de puesto y muestra la mesa
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
					'<div class="content__puesto-'+(i+1)+'">'+							
						'<img src="img/puesto_left.svg" alt="Puesto '+(i+1)+'" class="img-responsive">'+						
						'<div class="puesto-libre">'+
							'<div class="cnt" onClick="hacerPedido('+(i+1)+')">'+
								'<span class="txt-puesto">Puesto</br>#'+(i+1)+'</span>'+
							'</div>'+
						'</div>'+
					'</div>';
			}
		}

		return crearMesa;
	}

	function crearMesaX(cantidad,codMes, principal = generalCodigoM){				
		//varible que contendra los datos de la mesa con los puests que se va a crear
		var crearMesa = '';
		//console.log('<?=$codigomesa?>');
		if(cantidad >= 4 && cantidad <= 6){			
			// se genera la mesa con los 6 puestos
			crearMesa = 
				'<div class="content-mesa">'+
					'<?= Html::img('@web/img/mesa_6_puestos.svg', ['alt' => 'Mesa 6 puestos', 'class' => 'img-responsive',]) ?>'+			
					'<div class="n-mesa">'+
						'<span>#'+principal+'</span>'+
					'</div>'+
					'<div class="n-mesa">'+
						'<span>#'+codMes+'</span>'+
					'</div>'+
				'</div>'+
				'<div class="content__puesto-1">'+
					'<?= Html::img('@web/img/puesto_left.svg', ['alt' => 'Puesto 1', 'class' => 'img-responsive',]) ?>'+
					'<div class="puesto-libre">'+
						'<div class="cnt" onClick="hacerPedidoX('+1+','+principal+')">'+
							'<span class="txt-puesto">Puesto</br>#1</span>'+
						'</div>'+
					'</div>'+
				'</div>'+
				'<div class="content__puesto-2">'+
					'<?= Html::img('@web/img/puesto_top.svg', ['alt' => 'Puesto 2', 'class' => 'img-responsive',]) ?>'+
					'<div class="puesto-libre">'+
						'<div class="cnt" onClick="hacerPedidoX('+2+','+principal+')">'+
							'<span class="txt-puesto">Puesto</br>#2</span>'+
						'</div>'+
					'</div>'+
				'</div>'+
				'<div class="content__puesto-3">'+
					'<?= Html::img('@web/img/puesto_right.svg', ['alt' => 'Puesto 3', 'class' => 'img-responsive',]) ?>'+
					'<div class="puesto-libre">'+
						'<div class="cnt" onClick="hacerPedidoX('+3+','+principal+')">'+
							'<span class="txt-puesto">Puesto</br>#3</span>'+
						'</div>'+
					'</div>'+
				'</div>'+
				'<div class="content__puesto-4">'+
					'<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 4', 'class' => 'img-responsive',]) ?>'+
					'<div class="puesto-libre">'+
						'<div class="cnt" onClick="hacerPedidoX('+4+','+principal+')">'+
							'<span class="txt-puesto">Puesto</br>#4</span>'+
						'</div>'+
					'</div>'+
				'</div>'+
				'<div class="content__puesto-5">'+
					'<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 5', 'class' => 'img-responsive',]) ?>'+
					'<div class="puesto-libre">'+
						'<div class="cnt" onClick="hacerPedidoX('+5+','+principal+')">'+
							'<span class="txt-puesto">Puesto</br>#5</span>'+
						'</div>'+
					'</div>'+
				'</div>'+
				'<div class="content__puesto-6">'+
					'<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 5', 'class' => 'img-responsive',]) ?>'+
					'<div class="puesto-libre">'+
						'<div class="cnt" onClick="hacerPedidoX('+6+','+principal+')">'+
							'<span class="txt-puesto">Puesto</br>#6</span>'+
						'</div>'+
					'</div>'+
				'</div>';
		}else if(cantidad >= 7 && cantidad <= 8){
			crearMesa = 
				'<div class="content-puestos mesax8p">'+
					'<div class="content-scroll-mesa">'+
						'<div class="content-mesa">'+
							'<?= Html::img('@web/img/mesa_8_puestos.svg', ['alt' => 'Mesa 6 puestos', 'class' => 'img-responsive',]) ?>'+
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
							'<?= Html::img('@web/img/puesto_left.svg', ['alt' => 'Puesto 1', 'class' => 'img-responsive',]) ?>'+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#1</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-2">'+
							'<?= Html::img('@web/img/puesto_top.svg', ['alt' => 'Puesto 2', 'class' => 'img-responsive',]) ?>'+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#2</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-3">'+
							'<?= Html::img('@web/img/puesto_right.svg', ['alt' => 'Puesto 3', 'class' => 'img-responsive',]) ?>'+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#3</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-4">'+
							'<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 4', 'class' => 'img-responsive',]) ?>'+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#4</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-5">'+
							'<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 5', 'class' => 'img-responsive',]) ?>'+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#5</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-6">'+
							'<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 6', 'class' => 'img-responsive',]) ?>'+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#6</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-7">'+
							'<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 7', 'class' => 'img-responsive',]) ?>'+
							'<div class="puesto-libre">'+
								'<div class="cnt">'+
									'<span class="txt-puesto">Puesto</br>#7</span>'+
								'</div>'+
							'</div>'+
						'</div>'+
						'<div class="content__puesto-8">'+
							'<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 8', 'class' => 'img-responsive',]) ?>'+
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

	function hacerPedido(puesto){
		//identificar si es la primera vez que se ordena en mesa
		var pedidoAcumu = generalPlatos;
		//ruta para cargar el menu
		var url = "<?php echo Url::toRoute(['site/menunew'])?>"
		//cantidad e personas que pueden ordenar
		var tamano = document.getElementById("numPersonas").value;
		// si el pedido acumulado es cero parte como primer pedido a realizar en mesa
		if(pedidoAcumu == 0){			
			location.href = url+"&puesto="+puesto+'&codigoM='+generalCodigoM+'&tamanoM='+tamano+'&estadoM='+'<?=$estadomesa?>';
		}else{
			location.href = url+"&puesto="+puesto+'&codigoM='+generalCodigoM+'&tamanoM='+tamano+'&estadoM='+'<?=$estadomesa?>'+
							    "&platos="+generalPlatos+'&cantidad='+generalCantidad+'&puestos='+generalPuestos;
		}
	}

	function hacerPedidoX(puesto, mesa){
		//tamano de personas que pueden ordernar		
		var tamano = document.getElementById("numPersonas").value;
		//identificar si es la primera vez que se ordena en mesa
		var pedidoAcumu = generalPlatos;
		//ruta para cargar el menu
		var url = "<?php echo Url::toRoute(['site/menu'])?>"
		//cantidad e personas que pueden ordenar
		var tamano = document.getElementById("numPersonas").value;
		// si el pedido acumulado es cero parte como primer pedido a realizar en mesa
		if(pedidoAcumu == 0){			
			location.href = url+"&puesto="+puesto+'&codigoM='+mesa+'&tamanoM='+tamano+'&estadoM='+'<?=$estadomesa?>';
		}else{
			location.href = url+"&puesto="+puesto+'&codigoM='+mesa+'&tamanoM='+tamano+'&estadoM='+'<?=$estadomesa?>'+
							    "&platos="+generalPlatos+'&cantidad='+generalCantidad+'&puestos='+generalPuestos;
		}
		//alert('puesto '+puesto+' pidiendo en la mesa '+mesa+'. Tamano total: '+tamano);
	}

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

	function crearSession(mesaSeleccionada1 = 0, mesaSeleccionada2 = 0){		
		// tamano de la mesa que se carga		
		var tamano = document.getElementById("numPersonas").value;
		var mesa1 = mesaSeleccionada1;
		var mesa2 = mesaSeleccionada2;


		//console.log(mesas[0]);
		$.ajax({
			url: '<?php echo Url::toRoute(['site/varsesions']); ?>',
			method: "GET",
			data: {'tamano':tamano, 'mesa1':mesa1},
			success: function (data) {			
				
			}
		});
	}

	function retrocederMesa(){
		var tamano =  document.getElementById("numPersonas").value;
		var estado = '<?=$estadomesa?>';

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
				var urlPlaza = '<?php echo Url::toRoute(['site/plaza']); ?>'
				location.href = urlPlaza;
				break;
		}
				
	}
	
	function mesasUnidad(){
		var mesa = generalCodigoM;
		
		//console.log(mesa);
		$.ajax({
			url:'<?php echo Url::toRoute(['site/jsonmesasunidas']); ?>',
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

				listaOut(mesaUnida1,mesaPrincipal);
			}
		});		
	}

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

	function verFactura(){
		// cantidad de personas que estan seleccionadas 
		var cantidad = generalTamano;
		// si es menor o igual que 4 solo es una mesa
		if(cantidad <= 4){
			listaFactura();
		}else if(cantidad >= 5 && cantidad <= 6){
			listaFactura();
		}
	}

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
		}else{
			document.getElementById("flechaPuestos4").style.display = 'none';	
			document.getElementById("tituloMesa4").innerHTML = 'No hay pedidos por confirmar';
			 if(generalEstadoM != 0){
			 	document.getElementById("platosDetalle").innerHTML = "Sin pedidos";
			 }
		}

		document.getElementById("listaPuestos4").innerHTML = cadenaPuestos;	
			
	}

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

			}
		}else{
			// si no hya pedidos en la union de 2 mesas (6 puestos)
			if(cantidadPuestos >= 5 && cantidadPuestos <= 6){
				document.getElementById("flechaPuestos61").style.display = 'none';	
				document.getElementById("flechaPuestos62").style.display = 'none';	
				document.getElementById("detalleMesa62").style.display = 'none';	
				document.getElementById("tituloMesa61").innerHTML = 'Mesa sin pedidos';			
				document.getElementById("platosDetalle").innerHTML = "Sin pedidos";
			}
		}


		document.getElementById("listaPuestos61").innerHTML = cadenaPuestos1;	
		document.getElementById("listaPuestos62").innerHTML = cadenaPuestos2;
	}

	function pedidosConfirmados(){

		if(generalConfirmado == '1'){
			var mesa = generalCodigoM;

			$.ajax({
				url:'<?php echo Url::toRoute(['site/consultarpedido']); ?>',
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
					
					if(generalTamano <= 4){
						mostrarConfirmados(arrayDatos[2]);
					}
				}
			});	
		}
	}

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

	function aumentarCantidad(){
		var valorCantidad = document.getElementById("cantidadSweet").innerHTML;
		var resultado = 1;

		if(valorCantidad != 1){
			resultado = valorCantidad - 1;
		}

		document.getElementById("cantidadSweet").innerHTML = resultado;

	}

	function reducirCantidad(cantidad){
		var valorCantidad = parseInt(document.getElementById("cantidadSweet").innerHTML);
		var resultado = document.getElementById("cantidadSweet").innerHTML;

		if(valorCantidad != cantidad){
			resultado = valorCantidad + 1;
		}

		document.getElementById("cantidadSweet").innerHTML = resultado;

	}

	function cancelarConfirmado(cantidad, posicionArray){				
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
						url:'<?php echo Url::toRoute(['site/cancelarpedido']); ?>',						
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
		
		
	}

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
							'<?= Html::img('@web/img/items/carne.png', ['alt' => 'Imagen Item', 'class' => 'img-item',]) ?>'+
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
			url:'<?php echo Url::toRoute(['site/jsonpuestosfac']); ?>',
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
							document.getElementById(nombreDiv+i).style.display = 'none';					
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

	function opcionFacturar(){
		// se oculta el boton de cerrar la vista de la factura
		document.getElementById("cerrarFacturar").style.display = 'none';			
		//mensaje de alerta y saber que accion se va a tomar
		swal({
			title: '¿Previsualizar factura o facturar pedido?',						
			type: "info",
			showCancelButton: true,
			confirmButtonColor: "#5cb85c",
			cancelButtonColor: '#d33',
			confirmButtonText: "Facturar",
			cancelButtonText: "Previsualizar",
			closeOnConfirm: false,
			closeOnCancel: false
		},
			function(isConfirm){
				if (isConfirm) {
					//se genera la factura de los puestos que ya selecciono
					generarFactura();					
					swal("", "Factura generada", "success");
					//muestra el boton de salir (futuro a imprimir )
					document.getElementById("labelImprimir").innerHTML = 'Salir';
				} else {
					swal("", "Previsualizacion Completada", "success");
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
		});		
	}	

	function accionFacturaVisualiza(accion){
		if(accion == 1){
			console.log("presiono visualizar");
		}else{
			console.log("Presiono generar");			
		}
	}

	function generarFactura(){
		//cambio el onclick del boton
		$(document).ready(function(){					    
		    // clears onclick then sets click using jQuery
		    $("#labelImprimir").attr('onclick', 'imprimirRecibo()');
		});	
		//muestra el boton de salir (futuro a imprimir )
		document.getElementById("labelImprimir").innerHTML = 'Salir';
		// nombre de los combo box
		var nombrebox = 'check';
		//array de los puestos que se seleccionaron
		var arrayFacPuestos = new Array();
		//saber si termina el ciclo o no
		var ciclo = true;
		// contador
		var i = 0; 

		while(ciclo == true){			
			// id del check box 
			nombreboxc = nombrebox+i;
			//saber si esta check			
			if(i <= 4){
				// lee el estado del check book
				bool =  document.getElementById(nombreboxc).checked;
			}else{
				// si pasa los 4 sale del ciclo
				ciclo = false;
			}

			// si es el primero y esta check, para el ciclo y muestra la factura 
			if(i == 0 && bool == true){
				// para el ciclo				
				ciclo = false;
				// se resta 1 al contador
				//i--;
			}else if(bool == true){
				arrayFacPuestos.push(i);				
			}
			//incremento el contador en 
			i++;	
		}			

		if(i == 1){			
			mostrarFactura(false);
		}
		else{			
			generalFacturaPuestos = arrayFacPuestos;
			mostrarFactura(true);
		}
	}

	var generalFacturaPuestos; // numero de ouestos que se pueden facturar

	function mostrarFactura(full = false){
		
		$.ajax({
			url:'<?php echo Url::toRoute(['site/facturar']); ?>',
			dataType:'json',
			method: "GET",
			data: {'puestos':generalFacturaPuestos, 'mesa':generalCodigoM, 'full':full},	// full para saber si es por puestos o toda la mesa		
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
				//total a pagar en la fctura
				var totalPagar = data[2];

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
							'<td>$'+valorProducto[i]+'</td>'+
						'</tr>';
				}

				// muestran los datos en la factura 				
				document.getElementById("numeroFactura").innerHTML = arrayDatosCF[0];
				document.getElementById("fechaFactura").innerHTML = arrayDatosCF[1];				
				document.getElementById("totalFactura").innerHTML = '$'+totalPagar;
				document.getElementById("listadoFactura").innerHTML = listaProductos;
			}
		});

		//console.log(generalFacturaPuestos);
	}

	function imprimirRecibo(){
		var urlPlaza = '<?php echo Url::toRoute(['site/plaza']); ?>'
		location.href = urlPlaza;
	}

	function validarCheck(){
		//inicio de nombre del check box
		var nombrebox = 'check';
		//identifica
		var contador = 0;
		//var nombreboxc = nombrebox+1;
		var bool;
		// recorrer todos los check box
		for(var i=0 ; i<=4 ; i++){
			// id del check box 
			nombreboxc = nombrebox+i;
			//saber si esta check
			bool =  document.getElementById(nombreboxc).checked;
			// conteo de checks
			if(bool){
				// incremento del contador
				contador++;
			}			
		}		

		if(contador == 0){
			document.getElementById('btn-fact').style.display = 'none';			
		}else{
			document.getElementById('btn-fact').style.display = 'block';		
		}
		
	}setInterval(validarCheck, 1000);

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

		//console.log(generalarrPuestos);



		//vuelve a cargar los puestos con pedidos
		verPedido();
	}

	function realizarPedido(){
		//datos en texto plano de los platos la cantidad y el puesto
		var platos = generalPlatos;
		var cantidad = generalCantidad;
		var puestos = generalPuestos;
		var mesa = generalCodigoM;
		var estado = generalEstadoM;
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
						url:'<?php echo Url::toRoute(['site/realizarpedido']); ?>',
						dataType:'json',
						method: "GET",
						data: {'puestos':puestos, 'platos':platos , 'cantidad':cantidad, 'termino':termino , 'mesa':mesa},			
						success: function (data) {						
							
						}
					});
				}else{				
					$.ajax({
						url:'<?php echo Url::toRoute(['site/adicionarpedido']); ?>',
						dataType:'json',
						method: "GET",
						data: {'puestos':puestos, 'platos':platos , 'cantidad':cantidad, 'termino':termino , 'mesa':mesa},			
						success: function (data) {						
							
						}
					});
				}
			}else if(cantidadPuestos >= 5 && cantidadPuestos <= 6){
				if(estado != 0){				
					$.ajax({
						url:'<?php echo Url::toRoute(['site/realizarpedidox']); ?>',
						dataType:'json',
						method: "GET",
						data: {'puestos1':puestos, 'platos1':platos , 'cantidad1':cantidad, 'termino1':termino , 'mesa1':mesa, 
							   'mesa2':'', 'tamano':0},			
						success: function (data) {						
							
						}
					});
				}else{				
					$.ajax({
						url:'<?php echo Url::toRoute(['site/adicionarpedidox']); ?>',
						dataType:'json',
						method: "GET",
						data: {'puestos1':puestos, 'platos1':platos , 'cantidad1':cantidad, 'termino1':termino , 'mesa1':mesa, 
							   'mesa2':'s', 'tamano':0},			
						success: function (data) {						
							
						}
					});
				}
			}
		}else{
			// mensaje de alerta
			mensajeAlerta(1);
		}

		//console.log();
	}


	function verDetallePedido(puesto, mesa){
		//datos en texto plano de los platos la cantidad y el puesto
		var platos = generalPlatos;
		var cantidad = generalCantidad;
		var puestos = generalPuestos;	

		// acomodan los textos planos en array
		var arrPlatos = generalNombrePlatos;		
		var arrCantidad = crearArray(cantidad);
		var arrPuestos = crearArray(puestos);

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
							'<?= Html::img('@web/img/items/carne.png', ['alt' => 'Imagen Item', 'class' => 'img-item',]) ?>'+
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

	var generalNombrePlatos = new Array();
	
	function nombrePlatos(){	
		// datos de los platos seleccionados	
		var platos = generalPlatos;	

		if(platos != 0){
			$.ajax({
				url:'<?php echo Url::toRoute(['site/consultanomplato']); ?>',	
				dataType:'json',								
				method: "GET",
				data: {'plato':platos},
				success: function (data) {	
					//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
					var arrayDatos = $.map(data, function(value, index) {
		    			return [value];
					});		
					
					generalNombrePlatos = arrayDatos;
				}
			});	
		}

		
		
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

	function mensajeAlerta(tipoAlerta){
		switch(tipoAlerta){
			case 1:
				swal("Mesa sin pedido", "Tome el pedido antes de confirmarlo!", "error");
				break;
			case 2:
				swal({
				  title: "Esta seguro?",
				  text: "Usted cancelara todo el pedido!",
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
				    var urlPlaza = '<?php echo Url::toRoute(['site/plaza']); ?>'
					location.href = urlPlaza;
				  } else {
				    swal("", "Proceso cancelado..", "error");
				  }
				});
				break;
		}
	}
	</script>

<script>

 var avatars = document.querySelectorAll('.animate_avatar') 
 function showAvatars() {
  // Animate each line individually
  for(var i=0; i<avatars.length; i++) {
   var avt= avatars[i]
   // Define initial properties
   dynamics.css(avt, {
   opacity: 0,
   scale: .1
   })

   // Animate to final properties
   dynamics.animate(avt, {
   opacity: 1,
   scale: 1
   }, {
   type: dynamics.spring,
   frequency: 300,
   friction: 400,
   duration: 1200,
   delay: 200 + i * 40
   })
  }
 }

</script>

</body>
</html>
<?php $this->endPage() ?>


