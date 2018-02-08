<?php
	use yii\helpers\Html;
	use app\assets\AppAsset;
	use yii\bootstrap\ActiveForm;
	use yii\bootstrap\Alert;
	use yii\helpers\Url;

	AppAsset::register($this);

	$this->title = 'Acomer';

	$request = Yii::$app->request;	

	session_start();

	
	if(isset($_SESSION["mesa1"])){
		if(is_array($_SESSION['mesa1'])){
			$mesaSesion = $_SESSION["mesa1"][0];
		}else{
			$mesaSesion = $_SESSION["mesa1"];
		}
	}else{
		$mesaSesion = "undefined";
	}

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
	    <script src="/Acomer/web/js/jquery.min.js"></script>
	    <script src="/Acomer/web/js/mesaJs.js"></script>
	    <script src="/Acomer/web/js/ciclosession.js"></script>
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
							<!--<a onClick="showAvatars()" class="btn btn-raised btn-organge-grad btn-radius btn-inline" data-toggle="modal" data-target="#personajesModal">
								<i class="material-icons"></i>Prueba_Personajes
							</a>-->
						</div>
						<div class="pull-right">
							<a id="visualizarPedidoBtn" onClick="verPedido()" class="btn btn-raised btn-organge-grad btn-radius btn-inline" data-toggle="modal" data-target="#pedidoModal">
								<i class="material-icons icon-btn">&#xE556;</i>Ver pedido
							</a>
							<a id="facturarPedidoBtn" onClick="verFactura()" class="btn btn-raised btn-success btn-radius btn-inline" data-toggle="modal" data-target="#facturaModal">
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
										<?php echo Html::img('@web/img/personajes/uviejo1.svg', ['class'=>'animate_avatar','id'=>'pervi1'])?>
										<?php echo Html::img('@web/img/personajes/uadulto1.svg', ['class'=>'animate_avatar','id'=>'perad1'])?>
										<?php echo Html::img('@web/img/personajes/unino1.svg', ['class'=>'animate_avatar','id'=>'perni1'])?>
									</div>
									<div class="row menos">
										<?php echo Html::img('@web/img/personajes/uviejo2.svg', ['class'=>'animate_avatar','id'=>'pervi2'])?>
										<?php echo Html::img('@web/img/personajes/uadulto2.svg', ['class'=>'animate_avatar','id'=>'perad2'])?>
										<?php echo Html::img('@web/img/personajes/unino2.svg', ['class'=>'animate_avatar','id'=>'perni2'])?>
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
										<a onClick="cancelarTodo()" class="btn btn-raised btn-organge-grad btn-radius btn-inline">
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
																	<td id="tituloMesa62">Mesa <?=$mesaSesion?></td>	
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
																	<td><span class="arrow" id="flechaPuestosC61">arrow</span></td>											
																</tr>
																<tr class="toggle-row">
																	<td colspan="5">
																		<div class="sub-table-wrap" id="listaPuestosC61"></div>
																	</td>
																</tr>	
																<!--MESA 2 PARA 6 PERSONAS-->
																<tr class="default" id="detalleMesa62">
																	<td id="tituloMesa62">Mesa <?$mesaSesion?></td>	
																	<td><span class="arrow" id="flechaPuestosC62">arrow</span></td>											
																</tr>
																<tr class="toggle-row">
																	<td colspan="5">
																		<div class="sub-table-wrap" id="listaPuestosC62"></div>
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
												<h4 id="puestoDetalle" onClick="verDetallePedidoMesa()">
													<span class="txt__lightorange">
														<i class="material-icons icon-btn">&#xe913;</i> Detalle del pedido
													</span>
												</h4>
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
														<td id="tituloPuestoFac1">Pedido puesto 1</td>
													</tr>
													<tr id="facturaPuesto2">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check2">
															  </label>
															</div>
														</td>
														<td id="tituloPuestoFac2">Pedido puesto 2</td>
													</tr>
													<tr id="facturaPuesto3">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check3"> 
															  </label>
															</div>
														</td>
														<td id="tituloPuestoFac3">Pedido puesto 3</td>
													</tr>
													<tr id="facturaPuesto4">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check4">
															  </label>
															</div>
														</td>
														<td id="tituloPuestoFac4">Pedido puesto 4</td>
													</tr>
													<tr id="facturaPuesto5">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check5">
															  </label>
															</div>
														</td>
														<td id="tituloPuestoFac5">Pedido puesto 5</td>
													</tr>
													<tr id="facturaPuesto6">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check6">
															  </label>
															</div>
														</td>
														<td id="tituloPuestoFac6">Pedido puesto 6</td>
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
										<div class="clearfix">
											<div class="pull-right">
												<div class="num-factura-content">
													<dl class="num-fact">
														<dd id="nombreClientefac">Nombre del cliente</dd>
													</dl>
												</div>				
											</div>		
										</div>
										<div class="clearfix">
											<div class="pull-right">
												<div class="num-factura-content">
													<dl class="num-fact">														
														<dd id="idClientefac">Codigo del cliente</dd>					
													</dl>
												</div>				
											</div>		
										</div>
										<!--<div class="clearfix">
											<div class="logo-factura-content pull-left">
												
											</div>
											<div class="pull-right">												
												<div class="num-factura-content">													
													<dl class="num-fact">
														<dt>Codigo</dt>
														<dd id="codigoClientediv">123456789</dd>
													</dl>
													<dl class="num-fact">
														<dt>Nombre</dt>
														<dd id="nombreClientediv">Jose Perez</dd>
													</dl>
												</div>
												
											</div>
										</div>-->
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
											<div class="clearfix mrg__bottom-30">
												<div class="propina-content pull-left" id="opcionesPropina">
													<p class="fnt__Bold">¿Desea agregar propina?</p>
													<div class="radio radio-primary">
														<label>
															<input type="radio" name="optionsRadiosPropina" id="optionsRadiosPropina1" value="0" checked="" onclick="calcularPropina(0)">
															0%
														</label>
													</div>
													<div class="radio radio-primary">
														<label>
															<input type="radio" name="optionsRadiosPropina" id="optionsRadiosPropina2" value="10" onclick="calcularPropina(10)">
															10%
														</label>
													</div>
													<div class="radio radio-primary">
														<label>
															<input type="radio" name="optionsRadiosPropina" id="optionsRadiosPropina3" value="15" onclick="calcularPropina(15)">
															15%
														</label>
													</div>
													<div class="radio radio-primary">
														<label>
															<input type="radio" name="optionsRadiosPropina" id="optionsRadiosPropina4" value="18" onclick="calcularPropina(18)">
															18%
														</label>
													</div>
													<div class="radio radio-primary">
														<label>
															<input type="radio" name="optionsRadiosPropina" id="optionsRadiosPropina5" value="0" onclick="habilitarPropina()">Otro:
														</label>																
													</div>	
													<div class="radio radio-primary">
														<input type="number" class="form-control" placeholder="$0" id="propinax" value="x" style="width:100px; font-size:20px;" disabled="true" />
													</div>				
												</div>
												<div class="sub-total-factura-content pull-right">
													<div class="iva-factura text-right fnt__Medium">
														<span>Subtotal</span>
														<span>Propina</span>
														<span>IVA</span>
													</div>
													<div class="sub-total-factura text-right">
														<span id="valorSubtotal">$00.000</span>
														<span id="valorPropina">$0</span>
														<span id="valorIva">$00.000</span>
													</div>
												</div>
											</div>
											<div class="total-factura-content clearfix">
												<div id="btnImprimir" class="btn-factura-box pull-left">
													<a onClick="imprimirRecibo()" id="labelImprimir"  href="#" class="btn btn-raised btn-info btn-radius btn-inline">
														Salir<i class="material-icons">&#xE5C8;</i>
													</a>
												</div>
												<div id="btnRegistroC" class="btn-factura-box pull-left">
													<a onclick="iniciaModalCliente()" id="labelCliente"  href="#" class="btn btn-raised btn-warning btn-radius btn-inline">Cliente</a>
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
						<div class="modal-registro">
							<div class="m-content">
								<div class="client-content">
									<div class="clt-cnt">
										<h3 class="title-header fnt__Medium text-center">CLIENTE</h3>
										<div class="form-group">
											<input type="number" class="form-control" id="cltRCc" placeholder="Identificación">
										</div>
									</div>
									<div class="btn-addId-content">
										<button id="addIdClt" type="button" class="btn btn-modact btn-add-id-cl" onclick="consultarCliente()">
											<i class="material-icons">&#xE876;</i>
										</button>
										<button id="closeModClt" type="button" class="btn btn-modact btn-close-cl" onclick="cerrarModalCliente()">
											<i class="material-icons">&#xE14C;</i>
										</button>
									</div>
								</div>
								<div class="new-client-content">
									<i class="btn-nw-clt material-icons" onclick="arrastrarCodigo()" id="cerrarRegistro">person_add</i>
									<div class="main-cnt">
										<div class="clt-cnt">
											<h3 class="title-header fnt__Medium text-center txt__light-100">CLIENTE NUEVO</h3>
											<div class="form-group input-white">
												<input class="form-control" id="cltNombre" type="text" placeholder="Nombre completo">
											</div>
											<div class="form-group input-white">
												<input class="form-control" id="cltNCc" type="number" placeholder="Identificación">
											</div>
											<div class="form-group input-white">
												<input class="form-control" id="clCdd" type="text" placeholder="Ciudad">
											</div>
											<div class="form-group input-white">
												<input class="form-control" id="cltDir" type="text" placeholder="Dirección">
											</div>
											<div class="form-group input-white">
												<input class="form-control" id="cltMail" type="text" placeholder="Correo electrónico">
											</div>
											<div class="form-group input-white">
												<input class="form-control" id="cltTel" type="number" placeholder="Teléfono">
											</div>
										</div>
										<div class="btn-addId-content">
											<button type="button" class="btn btn-modreg btn-add-nw-cl" onclick="registrarCliente()">
												Registrar
											</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php $this->endBody() ?>
	<!--<script src="../web/js/modal_view_fact.js"></script>-->
	<?= Html::jsFile('@web/js/modal_view_fact.js') ?>
	<script>
	  $(function () {
		$.material.init();
	  });
	</script>
	<script>
	  $(function () {
		$(".main-content-select-puestos").addClass("in");
	  });
	</script>
	<script>
		$("#cancelMesa").click(function(){
			$(".main-content-unir-mesa").removeClass("in");
			$(".main-content-select-puestos").removeClass("out");
			$(".main-content-select-puestos").addClass("in");
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
	// MODAL AGREGAR CLIENTE //
		// Abrir modal registro de cliente
		$("#btnRegistroC").click(function () {
			$(".modal-registro").addClass("show-modal");
		});
		// Evento abrir/cerrar del formulario de cliente nuevo
		$(".btn-nw-clt").click(function (){
			if (!$(this).hasClass('open')){
				$(".m-content").addClass("sld-up");
				$(".new-client-content").addClass("active-nw-clt");
				$(this).addClass("open");
				$(this).html("close");
			}
			else if ($(this).hasClass('open')){
				$(".m-content").removeClass("sld-up");
				$(".new-client-content").removeClass("active-nw-clt");
				$(this).removeClass("open");
				$(this).html("person_add");
			}
			else{
				return false;
			}
		});
		// Cerrar modal registro de cliente
		$("#closeModClt").click(function () {
			$(".modal-registro").removeClass("show-modal");
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
		// limitar la entrada de numero en el codigo del clinete
		cltRCc.oninput = function () {
		    if (this.value.length > 11) {
		        this.value = this.value.slice(0,11); 
		    }
		}

		cltNCc.oninput = function () {
		    if (this.value.length > 11) {
		        this.value = this.value.slice(0,11); 
		    }
		}

		cltTel.oninput = function () {
		    if (this.value.length > 10) {
		        this.value = this.value.slice(0,10); 
		    }
		}
	</script>

	<script type="text/javascript">
		var generalEstadoM = '<?=$estadomesa?>';
		var generalCodigoM = '<?=$codigomesa?>';
		var generalPlatos = '<?=$platos?>';		
		var generalCantidad = '<?=$cantidad?>';
		var generalPuestos = '<?=$puestos?>';		
		var generalTamano = '<?=$tamano?>'; 
		var generalarrPuestos = '<?=$arrpuestos?>';
		var generalMesa1 = '<?=$mesaSesion?>';
		var generalConfirmado = '<?=$confirmados?>';
		var generalConfirmPlatos;
		var generalConfirmCantidad;
		var generalConfirmPuestos;
		var generalConfirmPlaCod;
		var generalConfirmImagen;
		var generalConfirmMesas;
		var generalFacturaPuestos; // numero de ouestos que se pueden facturar
		var generalCheksPulsados;
		var generalNombrePlatos = new Array();
		var generalNombreImages = new Array();
		var generalMesaPrinc;
		var generalRever;
		var generalFactura;
		var generalAvatars = '<?=$avatars?>';
		var generalAvatarsDb = '';
	</script>

	<script type="text/javascript">
		//URL DE LAS FUNCIONES AJAX
		// usado en la funcion mesasDisponiblesR
		var urlUnionMesaDisponible = '<?php echo Url::toRoute(['site/jsonmesas']); ?>';
		// usado en la funcion avatarsG
		var urlAvatars = '<?php echo Url::toRoute(['site/consultaavatar']); ?>';
		// usada en la funcion hacerPedido Y hacerPedidoX
		var urlMenuNew = '<?php echo Url::toRoute(['site/menunew'])?>';
		// usado en la funcion crearSession
		var urlSessionMesaUnida = '<?php echo Url::toRoute(['site/varsesions']); ?>';
		// usada en la funcion retrocederMesa, opcionesReciboFac, imprimirRecibo
		var urlSitePlaza = '<?php echo Url::toRoute(['site/plaza']); ?>';
		// usada en la funcion mesasUnidad
		var urlMesasUnidad = '<?php echo Url::toRoute(['site/jsonmesasunidas']); ?>';
		// usado en la funcion pedidosConfirmados
		var urlConsutaPedido  = '<?php echo Url::toRoute(['site/consultarpedido']); ?>';
		var urlConsutaPedidoX = '<?php echo Url::toRoute(['site/consultarpedidox']); ?>';
		// usado en la funcion cancelarConfirmado
		var urlCancelarPedido = '<?php echo Url::toRoute(['site/cancelarpedido']); ?>';
		// usado en la funcion cancelarTodo
		var urlCancelarTodo = '<?php echo Url::toRoute(['site/cancelartodo']); ?>';
		// usada en la funcion cancelarRestoPedido
		var urlCancelarResto = '<?php echo Url::toRoute(['site/cancelarresto']); ?>';
		// usada en la funcion listaFactura
		var urlListaPuestoFactura = '<?php echo Url::toRoute(['site/jsonpuestosfac']); ?>';
		// usado en la funcion listaFacturaX
		var urlListaPuestoFacturax = '<?php echo Url::toRoute(['site/jsonpuestosfacx']); ?>';
		// usada en la funcion opcionesReciboFac, reversarFac
		var urlSiteMesa = '<?php echo Url::toRoute(['site/mesa']); ?>';
		// usada en la funcion reversarFac
		var urlRefersarFactura = '<?php echo Url::toRoute(['site/reversarfactura']); ?>';
		// usada en a funcion visualizaFactura
		var urlVisualizarFactura = '<?php echo Url::toRoute(['site/visualizarfac']); ?>';
		var urlVisualizarFacturaX = '<?php echo Url::toRoute(['site/visualizarfacx']); ?>';
		// usada en la funcion consultarCliente
		var urlConsultarCliente = '<?php echo Url::toRoute(['site/consultacliente']); ?>';
		// usada en la funcion registrarCliente
		var urlRegistroCliente = '<?php echo Url::toRoute(['site/registrarcliente']); ?>';
		// usada en la funcion estadoMesaFac
		var urlEstadoMesaFactura = '<?php echo Url::toRoute(['site/estadomesafac']); ?>';
		// usada en la funcion mostrarFactura
		var urlFacturarPedido = '<?php echo Url::toRoute(['site/facturar']); ?>';
		var urlFacturarPedidox = '<?php echo Url::toRoute(['site/facturarx']); ?>';
		// usada en la funcion realizarPedido
		var urlRealizarPedido = '<?php echo Url::toRoute(['site/realizarpedido']); ?>';
		var urlAdicionarPedido = '<?php echo Url::toRoute(['site/adicionarpedido']); ?>';
		var urlRealizarPedidoX = '<?php echo Url::toRoute(['site/realizarpedidox']); ?>';
		var urlAdicionarPedidoX = '<?php echo Url::toRoute(['site/adicionarpedidox']); ?>';
		// usada en la funcion nombrePlato
		var urlConsultaNomPlato = '<?php echo Url::toRoute(['site/consultanomplato']); ?>';


	</script>

	<script type="text/javascript">
		//VARIABLE CON DATOS PASADOS DEL PHP
		//usado en la function listaOut
		var sessionMesa1 = '<?php if(!isset($_SESSION["mesa1"])){ echo "undefined";}else{echo $mesaSesion;}?>'
		//usada en la funcion avatarsG
		var avatarPhp = '<?=$avatars?>';
		//usada en la funcion crearMesaX
		var imgMesa6Puestos = '<?= Html::img('@web/img/mesa_6_puestos.svg', ['alt' => 'Mesa 6 puestos', 'class' => 'img-responsive',]) ?>';
		var imgMesa8Puestos = '<?= Html::img('@web/img/mesa_8_puestos.svg', ['alt' => 'Mesa 6 puestos', 'class' => 'img-responsive',]) ?>';
		var imgMesa8PuestoL = '<?= Html::img('@web/img/puesto_left.svg', ['alt' => 'Puesto 1', 'class' => 'img-responsive',]) ?>';
		var imgMesa8PuestoT = '<?= Html::img('@web/img/puesto_top.svg', ['alt' => 'Puesto 2', 'class' => 'img-responsive',]) ?>';
		var imgMesa6PuestoR = '<?= Html::img('@web/img/puesto_right.svg', ['alt' => 'Puesto 3', 'class' => 'img-responsive',]) ?>';
		var imgMesa8PuestoB = '<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 4', 'class' => 'img-responsive',]) ?>';		
		//usada en la funcion retrocederMesa
		var estadoMesa = '<?=$estadomesa?>';
	</script>

	<script type="text/javascript">		
		$(document).ready(function() {
			$(xVez());
			$(validarCheck());
			$(pedidosConfirmados());
			$(nombrePlatos());
			$(habilitarBotones());
			$(avatarsG());		
		});
		
	

	

	

	//////////////////////////////////////////////////////////////////////////////
	var typingTimer;                //timer identifier
	var doneTypingInterval = 1000;  //time in ms, 5 second for example
	var $input = $('#propinax');

	//on keyup, start the countdown
	$("#propinax").on('keyup', function () {
		clearTimeout(typingTimer);
		typingTimer = setTimeout(doneTyping, doneTypingInterval);
	});

	//on keydown, clear the countdown 
	$("#propinax").on('keydown', function () {
		clearTimeout(typingTimer);
	});

	//user is "finished typing," do something
	function doneTyping () {
		var subtotalFactura = formatoNumerico($('#valorSubtotal').html());	
		subtotalFactura = subtotalFactura.substring(1);
		// calcula el porcentaje sobre el subtotal
		var valorPorcentaje = document.getElementById("propinax").value;
		
		if(valorPorcentaje.localeCompare("") == 0 || valorPorcentaje.indexOf('.') != -1 || 
		   valorPorcentaje.indexOf('e') != -1 || valorPorcentaje.indexOf(',') != -1){
			valorPorcentaje = 0;
			console.log("--"+valorPorcentaje+"--");
		}
		
		//
		var valorIvaFatura  = formatoNumerico($('#valorIva').html());	
		valorIvaFatura = valorIvaFatura.substring(1);
		//
		var valorTotalFactura = parseFloat(valorIvaFatura) + parseFloat(valorPorcentaje) + parseFloat(subtotalFactura);

		document.getElementById("valorPropina").innerHTML = '$'+formatoMoneda(valorPorcentaje.toString());	
		document.getElementById("totalFactura").innerHTML = '$'+formatoMoneda(valorTotalFactura.toString());	

		calcularPorcentajePropina(valorPorcentaje,subtotalFactura);
	}

	//////////////////////////////////////////////////////////////////////////////
	</script>

	<script type="text/javascript">
		function funcionesInterval(){
			var tamanoMesa = document.getElementById("numPersonas").value;			
			// ejecucion de la funcion mesasdisponibles
			if(generalEstadoM == 1 && tamanoMesa > 4){
				setInterval(mesasDisponiblesR, 9000);		
			}
		}setInterval(funcionesInterval,1000);
		
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


