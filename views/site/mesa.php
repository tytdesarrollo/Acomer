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
<html lang="<?= Yii::$app->language ?>">
	<head>
	    <meta charset="<?= Yii::$app->charset ?>">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <?= Html::csrfMetaTags() ?>
	    <title><?= Html::encode($this->title) ?></title>
	    <?= Html::jsFile('@web/js/jquery.min.js') ?>
		<?= Html::jsFile('@web/js/ciclosession.js') ?>
		<?= Html::cssFile('@web/css/multi.min.css') ?>
		<?= Html::jsFile('@web/js/multi.min.js') ?>	
	    <?php $this->head() ?>
	    <style type="text/css">
			.loader {
				border: 16px solid #f3f3f3;
				border-radius: 50%;
				border-top: 16px solid #3498db;
				width: 120px;
				height: 120px;
				-webkit-animation: spin 2s linear infinite; /* Safari */
				animation: spin 2s linear infinite;
			}

			/* Safari */
			@-webkit-keyframes spin {
			  	0% { -webkit-transform: rotate(0deg); }
			  	100% { -webkit-transform: rotate(360deg); }
			}

			@keyframes spin {
			  	0% { transform: rotate(0deg); }
			  	100% { transform: rotate(360deg); }
			}
		</style>
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
					<h2 class="txt__light-70">Selecciona el número de personas</h2>
				</div>
				<div class="content-select-puestos mrg__bottom-30">
					<div class="input-group">
						<span class="input-group-btn">
							<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="selectPuestos">
								<span class="glyphicon glyphicon-minus"></span>
							</button>
						</span>
						<input id="numPersonas" type="text" name="selectPuestos" class="form-control input-number" value="1" min="1" max="12">
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

			<!--<div class="main-content-unir-mesa">
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
							<div class="col-sm-2 col-md-6 divider" id="listaMesas1">
								
							</div>							
							<div class="col-sm-2 col-md-6 divider" id="listaMesas2">
								
							</div>
							<div class="col-sm-2 col-md-6 divider" id="listaMesas3">
								
							</div>							
							<div class="col-sm-2 col-md-6 divider" id="listaMesas4">
								
							</div>
							<div class="col-sm-2 col-md-6 divider" id="listaMesas5">
								
							</div>
							<div class="col-sm-2 col-md-6 divider" id="listaMesas6">
								
							</div>
						</div>
					</div>
				</div>
			</div>-->

			

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
					<!--DIV PARA LA MESA CON 10 PUESTO-->
					<div class="content-puestos mesax10p" id="mesaPuestos10">
						
					</div>
					<!--DIV PARA LA MESA CON 12 PUESTO-->
					<div class="content-puestos mesax12p" id="mesaPuestos12">
						
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
								<i class="material-icons icon-btn">&#xE8B0;</i>Opciones de factura
							</a>
						</div>
					</div>
				</div>
			</div>

			<!--MODAL DEL Prueba_P-->
			<!-- se descomenta si se quiere ontrol de tipo de personas que piden
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
									</div>
									<div class="row menos">
										<?php echo Html::img('@web/img/personajes/uviejo2.svg', ['class'=>'animate_avatar','id'=>'pervi2'])?>
										<?php echo Html::img('@web/img/personajes/uadulto2.svg', ['class'=>'animate_avatar','id'=>'perad2'])?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>-->
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
													<?php if ($tamano >= 1 && $tamano <= 12): ?>
														<tr class="default active">
															<td id="tituloMesa4">Mesa <?=$codigomesa?></td>	
															<td><span class="arrow" id="flechaPuestos4">arrow</span></td>											
														</tr>
														<tr class="toggle-row">
															<td colspan="5">
																<div class="sub-table-wrap" id="listaPuestos4"></div>
															</td>
														</tr>		
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
													<?php if ($tamano >= 1 && $tamano <= 12): ?>
														<tr class="default active">
															<td id="tituloMesaC4">Mesa <?=$codigomesa?></td>	
															<td><span class="arrow" id="flechaPuestosC4">arrow</span></td>											
														</tr>
														<tr class="toggle-row">
															<td colspan="5">
																<div class="sub-table-wrap" id="listaPuestosC4"></div>
															</td>
														</tr>					
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
													<tr id="facturaPuesto7">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check7">
															  </label>
															</div>
														</td>
														<td id="tituloPuestoFac7">Pedido puesto 7</td>
													</tr>
													<tr id="facturaPuesto8">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check8">
															  </label>
															</div>
														</td>
														<td id="tituloPuestoFac8">Pedido puesto 8</td>
													</tr>
													<tr id="facturaPuesto9">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check9">
															  </label>
															</div>
														</td>
														<td id="tituloPuestoFac9">Pedido puesto 9</td>
													</tr>
													<tr id="facturaPuesto10">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check10">
															  </label>
															</div>
														</td>
														<td id="tituloPuestoFac10">Pedido puesto 10</td>
													</tr>
													<tr id="facturaPuesto11">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check11">
															  </label>
															</div>
														</td>
														<td id="tituloPuestoFac11">Pedido puesto 11</td>
													</tr>
													<tr id="facturaPuesto12">
														<td class="select-cell">
															<div class="checkbox">
															  <label>
																<input name="name1" type="checkbox" id="check12">
															  </label>
															</div>
														</td>
														<td id="tituloPuestoFac12">Pedido puesto 12</td>
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
														<dt>Hora</dt>
														<dd id="horaFactura">17:00:00</dd>
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
													<p class="fnt__Bold">Selecciona la forma de pago</p>
													<div class="radio radio-primary">
														<label>
															<input type="radio" name="formaPago" id="formaPago1" value="01" checked="">
															Efectivo
														</label>
													</div>
													<div class="radio radio-primary">
														<label>
															<input type="radio" name="formaPago" id="formaPago2" value="02" onclick="habilitarAuth('numeroAuth1')">
															Tarjeta
														</label>
													</div>
													<div class="radio radio-primary">
														<input type="number" class="form-control" placeholder="# Auth" id="numeroAuth1" value="x" style="width:82px; font-size:20px;" disabled="true" />
													</div>														
													<div class="radio radio-primary">
														<label>
															<input type="radio" name="formaPago" id="formaPago3" value="03" onclick="habilitarAuth('numeroAuth2')">
															Ambos															
														</label>
													</div>		
													<div class="radio radio-primary">
														<input type="number" class="form-control" placeholder="# Auth" id="numeroAuth2" value="x" style="width:82px; font-size:20px;" disabled="true" />
													</div>												
													<p>
														<a onclick="adicionarAtencion()" href="#" style="text-transform: uppercase; font-weight: 500; color:#03a9f4" >
															<i class="material-icons">card_giftcard</i> Atenciones
														</a>														
													</p>													
												</div>																					
												<div class="sub-total-factura-content pull-right">
													<div class="iva-factura text-right fnt__Medium">
														<span>Subtotal</span>
														<span>Propina</span>
														<span>Impuestos</span>
														<span>Atenciones</span>
													</div>
													<div class="sub-total-factura text-right">
														<span id="valorSubtotal">$00.000</span>
														<span id="valorPropina">$0</span>
														<span id="valorIva">$00.000</span>
														<span id="valorAtencion">$0</span>
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

			<div id="modalAtencion" class="modal fade" role="dialog" >
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
  						<div class="modal-header text-center">
    						<div class="container-fluid">
								<div class="row">									
									<div class="pull-right">
										<a href="#" class="btn btn-raised btn-organge-grad btn-radius btn-inline" data-dismiss="modal" aria-label="Close">
											<i class="material-icons icon-btn">&#xE14C;</i>Salir
										</a>
									</div>
								</div>
							</div>
  						</div>
						<div class="modal-body">
						 	<h2 class="text-center">Adiciona atenciones a la factura</h2>
							<div class="row">
								<div class="col-sm-12">
									<div class="content-fact">
										<div>
											<table class="table">
							 					<thead>
							 						<tr>							 							
							 							<th>EMPRESA</th>
							 							<th>VALOR DE ATENCION</th>							 							
							 						</tr>							 						
							 					</thead>
							 					<tbody>		
							 						<?php for ($i=0 ; $i<count($empresas['GEN_EMP_COD']) ; $i++): ?>
								 						<tr>							 							
								 							<td><?=$empresas["GEN_EMP_NOM"][$i]?></td>
								 							<td>
								 								<div class="form-group">																
																	<div class="row">										
																		<div class="col-md-12">
																			<input name="valorAtenciones" type="number" class="form-control" id="<?=$empresas["GEN_EMP_COD"][$i]?>" placeholder="Valor de la antencion">																			
																		</div>												
																	</div>						    				
												    			</div>
								 							</td>
								 						</tr>
								 					<?php endfor ?>		
								 					<tr>
								 						<td></td>
								 						<td><h3><strong id="totalAtencionModal">TOTAL: $0</strong></h3></td>
								 					</tr>					 						
							 					</tbody>
							 				</table>	
										</div>
										<div class="table-responsive">
										</div>
									</div>
								</div>
							</div>
						</div>      						
						<div class="modal-footer">
  							        							
						</div>
  						
					</div>
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
		var generalNotas = '<?=$notas?>';
		var generalCantidad = '<?=$cantidad?>';
		var generalPuestos = '<?=$puestos?>';		
		var generalTamano = '<?=$tamano?>'; 
		var generalarrPuestos = '<?=$arrpuestos?>';		
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
		$(xVez());
		$(validarCheck());
		$(pedidosConfirmados());
		$(nombrePlatos());
		$(habilitarBotones());
		setTimeout(function(){
			$(avatarsG());	
		}, 1000);	

		if(generalEstadoM == 0){
			setTimeout(function(){
				$(verFactura());
			}, 5000);	
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
			$(".main-content-select-puestos").removeClass("in");
			$(".main-content-select-puestos").addClass("out");
			//muestro las mesa de 4 puestos 
			$(".main-content-mesa").addClass("in");
			// oculto las mesas con mas o menos puestos que la necesaria
			document.getElementById('mesaPuestos4').style.display = 'block';
			document.getElementById('mesaPuestos6').style.display = 'none';
			document.getElementById('mesaPuestos8').style.display = 'none';
			document.getElementById('mesaPuestos10').style.display = 'none';
			document.getElementById('mesaPuestos12').style.display = 'none';

		}else if(cantidad >= 5 && cantidad <= 6){
			//ejecuta la creacion de la mesa
			creacion = crearMesa(cantidad);
			//se muestra en el div
			document.getElementById("mesaPuestos6").innerHTML = creacion;
			// oculta la seleccion de puesto y muestra la mesa
			$(".main-content-select-puestos").removeClass("in");
			$(".main-content-select-puestos").addClass("out");
			//muestro las mesa de 4 puestos 
			$(".main-content-mesa").addClass("in");						
			// oculto las mesas con mas o menos puestos que la necesaria
			document.getElementById('mesaPuestos4').style.display = 'none';
			document.getElementById('mesaPuestos6').style.display = 'block';
			document.getElementById('mesaPuestos8').style.display = 'none';
			document.getElementById('mesaPuestos10').style.display = 'none';
			document.getElementById('mesaPuestos12').style.display = 'none';

		}else if(cantidad >= 7 && cantidad <= 8){
			//ejecuta la creacion de la mesa
			creacion = crearMesa(cantidad);
			//se muestra en el div
			document.getElementById("mesaPuestos8").innerHTML = creacion;
			// oculto el seleccionar puestos
			$(".main-content-select-puestos").removeClass("in");
			$(".main-content-select-puestos").addClass("out");
			//muestro las mesa de 4 puestos 
			$(".main-content-mesa").addClass("in");
			// oculto las mesas con mas o menos puestos que la necesaria
			document.getElementById('mesaPuestos4').style.display = 'none';
			document.getElementById('mesaPuestos6').style.display = 'none';
			document.getElementById('mesaPuestos8').style.display = 'block';
			document.getElementById('mesaPuestos10').style.display = 'none';
			document.getElementById('mesaPuestos12').style.display = 'none';

		}else if(cantidad >= 9 && cantidad <= 10){
			//ejecuta la creacion de la mesa
			creacion = crearMesa(cantidad);
			//se muestra en el div
			document.getElementById("mesaPuestos10").innerHTML = creacion;
			// oculto el seleccionar puestos
			$(".main-content-select-puestos").removeClass("in");
			$(".main-content-select-puestos").addClass("out");
			//muestro las mesa de 4 puestos 
			$(".main-content-mesa").addClass("in");
			// oculto las mesas con mas o menos puestos que la necesaria
			document.getElementById('mesaPuestos4').style.display = 'none';
			document.getElementById('mesaPuestos6').style.display = 'none';
			document.getElementById('mesaPuestos8').style.display = 'none';
			document.getElementById('mesaPuestos10').style.display = 'block';
			document.getElementById('mesaPuestos12').style.display = 'none';

		}else if(cantidad >= 11 && cantidad <= 12){
			//ejecuta la creacion de la mesa
			creacion = crearMesa(cantidad);
			//se muestra en el div
			document.getElementById("mesaPuestos12").innerHTML = creacion;
			// oculto el seleccionar puestos
			$(".main-content-select-puestos").removeClass("in");
			$(".main-content-select-puestos").addClass("out");
			//muestro las mesa de 4 puestos 
			$(".main-content-mesa").addClass("in");
			// oculto las mesas con mas o menos puestos que la necesaria
			document.getElementById('mesaPuestos4').style.display = 'none';
			document.getElementById('mesaPuestos6').style.display = 'none';
			document.getElementById('mesaPuestos8').style.display = 'none';
			document.getElementById('mesaPuestos10').style.display = 'none';
			document.getElementById('mesaPuestos12').style.display = 'block';
		}
		
	}	

	function crearMesa(cantidad){
		//varible que contendra los datos de la mesa con los puests que se va a crear
		var crearMesa = '';
		var cantidadReal;

		if(cantidad <= 4){
			// se asigna el valor del tamano real de la mesa
			cantidadReal = 4; 

		}else if(cantidad >= 5 && cantidad <= 6){
			// se asigna el valor del tamano real de la mesa
			cantidadReal = 6; 

		}else if(cantidad >= 7 && cantidad <= 8){
			// se asigna el valor del tamano real de la mesa
			cantidadReal = 8; 

		}else if(cantidad >= 9 && cantidad <= 10){
			// se asigna el valor del tamano real de la mesa
			cantidadReal = 10; 

		}else if(cantidad >= 11 && cantidad <= 12){
			// se asigna el valor del tamano real de la mesa
			cantidadReal = 12; 
		}

		//se crea la mesa 
		crearMesa = 
			'<div class="content-mesa">'+
				'<img src="img/mesa_'+cantidadReal+'_puestos.svg" alt="Mesa '+cantidadReal+' puestos" class="img-responsive">'+					
				'<div class="n-mesa">'+
					'<span>#'+generalCodigoM+'</span>'+
				'</div>'+
			'</div>';

		for (var i=0 ; i<cantidadReal ; i++){
			crearMesa = crearMesa +
				'<div class="content__puesto-'+(i+1)+'" id="avatarPuesto'+(i+1)+'">'+							
					'<img src="img/puesto_left.svg" alt="Puesto '+(i+1)+'" class="img-responsive avatar-hidden" id="imgPersona+'+(i+1)+'">'+						
					'<div class="puesto-libre" data-toggle="modal" data-target="#personajesModal">'+
						'<div class="cnt"  onClick="seleccionaPersona('+(i+1)+')">'+
							'<span class="txt-puesto">Puesto</br>#'+(i+1)+'</span>'+
						'</div>'+
					'</div>'+
				'</div>';
		}     

		return crearMesa;
	}
	
	function avatarsG(){
		//captura el valor de los avatar
		var avatar = '<?=$avatars?>';				
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
					var puesto = arrayAvatar[i].substring(arrayAvatar[i].length-3);					
					var img = arrayAvatar[i].substring(0,arrayAvatar[i].length-3);		

					if(isNaN(puesto)){
						puesto = arrayAvatar[i].substring(arrayAvatar[i].length-1);					
						img = arrayAvatar[i].substring(0,arrayAvatar[i].length-1);
					}else{
						puesto = arrayAvatar[i].substring(arrayAvatar[i].length-2);					
						img = arrayAvatar[i].substring(0,arrayAvatar[i].length-2);
					}
					
					// creo la imgrn html 
					if(generalTamano >= 1 && generalTamano <= 12){
						var imgAvatar = '<img src="img/personajes/'+img+'.svg" alt="Puesto '+puesto+'" class="img-responsive" id="imgPersona'+puesto+'" onClick="hacerPedido('+puesto+')">';
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
					if(generalTamano >= 1 && generalTamano <= 12){
						var imgAvatar = '<img src="img/personajes/'+img+'.svg" alt="Puesto '+puesto+'" class="img-responsive" id="imgPersona'+puesto+'" onClick="hacerPedido('+puesto+')">';
					}
					// imprimo en pantalla el avatar ya seleccionado 
					document.getElementById("avatarPuesto"+puesto).innerHTML = imgAvatar;		
					$("#avatarPuesto"+puesto).html()
					console.log($("#avatarPuesto"+puesto));		
				}
			}
			
			$.ajax({
				url:'<?php echo Url::toRoute(['site/consultaavatar']); ?>',	
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

						if(generalTamano >= 1 && generalTamano <= 12){
							var imgAvatar = '<img src="img/personajes/'+arrAvatar[i]+'" alt="Puesto '+arrPuestos[i]+'" class="img-responsive" id="imgPersona+'+puesto+'" onClick="hacerPedido('+arrPuestos[i]+')">';	
						}
						// imprimo en pantalla el avatar ya seleccionado 
						document.getElementById("avatarPuesto"+arrPuestos[i]).innerHTML = imgAvatar;	
					}
				}
			});			
		}

		generalAvatarsDb = avatar;
	}

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
			generalAvatars = arrayToChar(getNew);
		}


		var nuevoAvatar =
			'<img src="img/puesto_left.svg" alt="Puesto '+puesto+'" class="img-responsive avatar-hidden" id="imgPersona+'+puesto+'">'+						
			'<div class="puesto-libre" data-toggle="modal" data-target="#personajesModal">'+
				'<div class="cnt"  onClick="seleccionaPersona('+puesto+')">'+
					'<span class="txt-puesto">Puesto</br>#'+puesto+'</span>'+
				'</div>'+
			'</div>';

		document.getElementById("avatarPuesto"+puesto).innerHTML = nuevoAvatar;	
	}

	function arrayAvatar(avatar,puesto){

		if(generalAvatars == 0){
			generalAvatars = avatar+puesto;
		}else{
			generalAvatars = generalAvatars+","+avatar+puesto;
		}
		
		if(generalTamano >= 1 && generalTamano <= 12){
			hacerPedido(puesto);
		}
	}

	function seleccionaPersona(puesto){
		
		arrayAvatar("adulto1",puesto);
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
			location.href = url+"&puesto="+puesto+'&codigoM='+generalCodigoM+'&tamanoM='+tamano+'&estadoM='+'<?=$estadomesa?>'+'&avatars='+generalAvatars;
		}else{
			location.href = url + 
					"&puesto="+puesto+
					'&codigoM='+generalCodigoM+
					'&tamanoM='+tamano+
					'&estadoM='+'<?=$estadomesa?>'+
					"&platos="+generalPlatos+
					'&cantidad='+generalCantidad+
					'&puestos='+generalPuestos+
					'&avatars='+generalAvatars+
					'&notas='+generalNotas;
		}
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
			$("#facturarPedidoBtn").hide();
		}else{
			//se oculta hasta no tener resultado de la consulta
			$("#labelImprimir").hide();
			$("#btnRegistroC").hide();

			$.ajax({
				url:'<?php echo Url::toRoute(['site/mostrarbotonfactura']); ?>',				
				method: "GET",
				data: {'mesa':generalCodigoM},
				success: function (data) {											
					//identifica si se muestra el boton o no 
					if("NO_MOSTRAR".localeCompare(data) == 0){
						$("#labelImprimir").hide();
						$("#btnRegistroC").hide();
						$("#btn-fact").html("Visualizar");
					}else if("MOSTRAR".localeCompare(data) == 0){
						$("#labelImprimir").show();
						$("#btnRegistroC").show();
						$("#btn-fact").html("Facturar");
					}
				}
			});	

		}

		//habilir el boton de visualizar el pedido 
		if(generalPlatos == 0 && generalEstadoM == 1){						
			document.getElementById("visualizarPedidoBtn").style.display = 'none';			
		}

		//habilitar el boton de cerrar factura
		document.getElementById("cerrarFacturar").style.display = 'none';			
		
	}	

	function retrocederMesa(){
		var tamano =  document.getElementById("numPersonas").value;
		var estado = '<?=$estadomesa?>';

		switch (estado){
			case '1':
				//console.log(estado);
				if(tamano >= 1 && tamano <= 12){					
					$(".main-content-mesa").removeClass("in");
					$(".main-content-select-puestos").removeClass("out");
					$(".main-content-select-puestos").addClass("in");					
				}
				break;
			case '0':
				var urlPlaza = '<?php echo Url::toRoute(['site/plaza']); ?>'
				location.href = urlPlaza;
				break;
		}
				
	}
	
	

	function verPedido(){		
		// cantidad de personas que estan seleccionadas 
		var cantidad = generalTamano;
		// si es menor o igual que 4
		if(cantidad >= 1 && cantidad <= 12){
			listaPedidos();					
		}

		verDetallePedidoMesa();
	}

	function verFactura(){
		// cantidad de personas que estan seleccionadas 
		var cantidad = generalTamano;
		// si es menor o igual que 4 solo es una mesa
		if(cantidad >= 1 && cantidad <= 12){
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

			document.getElementById("listaPuestos4").innerHTML = cadenaPuestos;	
		}
		
			
	}

	function pedidosConfirmados(){
		//si ya hay pedidos confirmados
		if(generalConfirmado == '1'){
			// si el tamano de la mesa es 4
			if(generalTamano >= 1 && generalTamano <= 12){
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
						generalConfirmImagen = arrayDatos[4];
						
						if(generalTamano >= 1 && generalTamano <= 12){
							mostrarConfirmados(arrayDatos[2]);
						}
					}
				});	
			}			
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

		if(generalTamano >= 1 && generalTamano <= 12){
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
					var puestoCncelar;

					if(generalConfirmPuestos[posicionArray].length == 1){
						puestoCncelar = "0"+generalConfirmPuestos[posicionArray];
					}else{
						puestoCncelar = generalConfirmPuestos[posicionArray];
					}
					console.log(puestoCncelar);
					//
		    		$.ajax({
						url:'<?php echo Url::toRoute(['site/cancelarpedido']); ?>',						
						method: "GET",
						data: {'mesa':generalCodigoM,'plato':generalConfirmPlaCod[posicionArray],
							   'cantidad':cantidadCancelar,'puesto':puestoCncelar},		
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
								location.reload();
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
		  		
		  		var urlDestino = '<?php echo Url::toRoute(['site/plaza']); ?>'
				
		  		if(generalTamano >= 1 && generalTamano <= 12){
		  			$.ajax({
						url:'<?php echo Url::toRoute(['site/cancelartodo']); ?>',	
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
				}

		  	} else {
			    swal("", "Proceso cancelado..", "error");
			}
		});
	}

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
		  		
		  		if(generalTamano >= 1 && generalTamano <= 12){
		  			$.ajax({
						url:'<?php echo Url::toRoute(['site/cancelarresto']); ?>',	
						method: "GET",
						data: {'mesa':generalCodigoM, 'tamano':generalTamano},
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
		var arrcodigosNotas = crearArray(generalPlatos);
		//contenido del pedido
		var contenidoPedido = '';

		if(generalTamano >= 1 && generalTamano <= 12){
			// mostrar los pedidos que no esten confirmados
			if(Array.isArray(arrPlatos)){
				if(arrPlatos.length > 0){
					for(var i=0 ; i<arrPlatos.length ; i++){

						if(arrCantidad[i] != 0){
							contenidoPedido = contenidoPedido +
								'<tr>'+
									'<td class="icn">'+
										'<img src="img/categorias/'+arrImagen[i]+'" class="img-item">'+							
									'</td>'+
									'<td class="desc" onclick="verNota(\''+arrPlatos[i]+'\','+i+',\''+arrcodigosNotas[i]+'\')">'+
										'<div class="nom-item">'+
											'<p>'+arrPlatos[i]+'</p>'+
											'<p style="color:#b79d8b">Puesto '+arrPuestos[i]+'</p>'+
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
				}	
			}

			// mostrar los platos que han sido confirmados
			if(Array.isArray(generalConfirmPlatos)){
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
										'<p style="color:#b79d8b">Puesto '+generalConfirmPuestos[i]+'</p>'+
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
		}

		document.getElementById("mesaDetalle").innerHTML = '<h5 class="text-right txt__light-70">Mesa '+generalCodigoM+'</h5>';
		document.getElementById("platosDetalle").innerHTML = contenidoPedido;
		document.getElementById("mesaDetalle").innerHTML = '';
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

		//document.getElementById("puestoDetalle").innerHTML = '<span class="txt__lightorange">Puesto '+puesto+'</span>';	
		document.getElementById("mesaDetalle").innerHTML = '<h5 class="text-right txt__light-70">Puesto '+puesto+'</h5>';
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
					for (var i=1 ; i<=12 ; i++){		
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
					for(var k=1 ; k<=12 ; k++){
						document.getElementById(nombreDiv+k).style.display = 'none';					
					}
				}
			}
		});	
		 
		
	}	

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


	function opcionesReciboFac(){

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
					swal({
						title: "Faltan platos por facturar",
					  	text: "Desea continuar en la mesa o salir a la plaza?",	
					  	type: 'info',	  
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
							urlDestino = '<?php echo Url::toRoute(['site/mesa']); ?>'
							location.href = urlDestino+"&codigoM="+generalCodigoM+"&estadoM="+generalEstadoM+"&tamanoM="+generalTamano;
						//retornar a la plaza
						} else {					
							urlDestino = '<?php echo Url::toRoute(['site/plaza']); ?>'
							location.href = urlDestino;	
						}
				  		
					});
				}else{
					reversarFac();
				}
			}
		);			
	}

	function reversarFac(){
		//numero de factura
		var numeroFactura = $("#numeroFactura").html();

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
					url:'<?php echo Url::toRoute(['site/reversarfactura']); ?>',					
					method: "GET",
					data: {'factura':numeroFactura},
					success: function (data) {										
						urlDestino = '<?php echo Url::toRoute(['site/mesa']); ?>';
						location.href = urlDestino+"&codigoM="+generalCodigoM+"&estadoM="+generalEstadoM+"&tamanoM="+generalTamano;			
					}
				});			
			}

		});		
	}

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
		var valorAtencion = formatoNumerico($("#valorAtencion").html());
		valorAtencion = valorAtencion.substring(1);
		//
		var valorTotalFactura = (parseFloat(valorIvaFatura.replace(',','.')) + parseFloat(valorPorcentaje) + parseFloat(subtotalFactura.replace(',','.'))).toFixed(2);
		valorTotalFactura = (parseFloat(valorTotalFactura) - parseFloat(valorAtencion)).toFixed(2);

		document.getElementById("valorPropina").innerHTML = '$'+formatoMoneda(valorPorcentaje.toString());	
		document.getElementById("totalFactura").innerHTML = '$'+formatoMoneda(valorTotalFactura.toString());	

		calcularPorcentajePropina(valorPorcentaje,subtotalFactura);
	}

	//////////////////////////////////////////////////////////////////////////////

	function calcularPorcentajePropina(valor,subtotal){
		var subtotalNew = subtotal.replace(",",".");

		var porcentaje = (valor*100)/subtotalNew;		

		$("#optionsRadiosPropina5").attr('value', porcentaje);		
	}

	function habilitarPropina(){
		$("#propinax").prop("disabled",false);
		$("#propinax").focus();		
		document.getElementById("valorPropina").innerHTML = "$0";
	}

	function calcularPropina(porcentaje){		
		document.getElementById("propinax").value = "";
		// valor del subtotal
		var subtotalFactura = formatoNumerico($('#valorSubtotal').html());	
		subtotalFactura = subtotalFactura.substring(1);		
		// calcula el porcentaje sobre el subtotal
		var valorPorcentaje = (parseFloat(subtotalFactura)*(porcentaje/100)).toFixed(2);
		//		
		var valorIvaFatura  = formatoNumerico($('#valorIva').html());	
		valorIvaFatura = valorIvaFatura.substring(1);		
		//
		var valorAtencion = formatoNumerico($("#valorAtencion").html());
		valorAtencion = valorAtencion.substring(1);
		//
		var valorTotalFactura = (parseFloat(valorIvaFatura.replace(',','.')) + parseFloat(valorPorcentaje) + parseFloat(subtotalFactura.replace(',','.'))).toFixed(2);		
		valorTotalFactura = (parseFloat(valorTotalFactura) - parseFloat(valorAtencion)).toFixed(2);

		document.getElementById("valorPropina").innerHTML = '$'+formatoMoneda(valorPorcentaje.toString());	
		document.getElementById("totalFactura").innerHTML = '$'+formatoMoneda(valorTotalFactura.toString());		
	}	

	function visualizaFactura(){	
		
		if(generalTamano >= 1 && generalTamano <= 12){
			$.ajax({
				url:'<?php echo Url::toRoute(['site/visualizarfac']); ?>',
				dataType:'json',
				method: "GET",
				data: {'puestos':generalCheksPulsados, 'mesa':generalCodigoM},	// full para saber si es por puestos o toda la mesa		
				success: function (data) {										
					// platos pedidos por los puestos
					var arrayDatos = $.map(data, function(value, index) {
		    			return [value];
					});						

					var arrayDetalle = arrayDatos[0];
					var subtotalFac = arrayDatos[1];
					var ivaFac = arrayDatos[2];
					var totalFac = arrayDatos[3];
					var fecha = arrayDatos[4];
					var hora  = arrayDatos[5];

					// lista de productos
					var nombreProducto = arrayDetalle.FACPROCOD;
					var unidadProducto = arrayDetalle.FACUNI;
					var valorProducto = arrayDetalle.FACVALTUN;

					var listaProductos = '';

					for(var i=0 ; i<nombreProducto.length ; i++){
						listaProductos = listaProductos +
							'<tr>'+
								'<td>'+nombreProducto[i]+'</td>'+
								'<td>'+unidadProducto[i]+'</td>'+
								'<td>$'+formatoMoneda(valorProducto[i])+'</td>'+
							'</tr>';						
					}			

					document.getElementById("numeroFactura").innerHTML = '####';
					document.getElementById("fechaFactura").innerHTML = fecha;
					document.getElementById("horaFactura").innerHTML = hora;
					document.getElementById("totalFactura").innerHTML = '$'+formatoMoneda(totalFac.toString());
					document.getElementById("listadoFactura").innerHTML = listaProductos;
					document.getElementById("valorIva").innerHTML = '$'+formatoMoneda(ivaFac.toString());
					document.getElementById("valorSubtotal").innerHTML = '$'+formatoMoneda(subtotalFac.toString());					

					document.getElementById("cerrarFacturar").style.display = 'block';
					
				}
			});
		}
	}

	function consultarCliente(){
		var idCliente = document.getElementById("cltRCc").value;

		if(("".localeCompare(idCliente) == 0)){
			mensajeAlerta(5);
		}else{
			//consulta el nombre del cliente si ya se encuentra registrado
			$.ajax({
				url:'<?php echo Url::toRoute(['site/consultacliente']); ?>',
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

	function cerrarModalCliente(opcion = 0){
		//cambia el codigo del cliente a vacio
		if(opcion == 0){
			document.getElementById("cltRCc").value = "";
			document.getElementById("nombreClientefac").innerHTML = "Nombre del cliente";
			document.getElementById("idClientefac").innerHTML = "Codigo del cliente";
		}

		console.log(opcion);
	}

	function iniciaModalCliente(){
		 $("#closeModClt").attr('onclick', 'cerrarModalCliente()');
	}

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
						url:'<?php echo Url::toRoute(['site/registrarcliente']); ?>',
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

	function arrastrarCodigo(){
		var codigoIngresado = document.getElementById("cltRCc").value;
		
		if(("".localeCompare(codigoIngresado) != 0)){
			document.getElementById("cltNCc").value = codigoIngresado;
		}
		
	}

	function estadoMesaFac(){		
		$.ajax({
			url:'<?php echo Url::toRoute(['site/estadomesafac']); ?>',
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

	function generarFactura(){	
		//

		var validaciones = true;
		/********************************************/
		//codigo del cliente
		var codigoCliente = document.getElementById("cltRCc").value;

		/********************************************/
		//validar formas de pago
		var idCheckFormaPago;
		var valorFormaPago;
		var valorAutorizacion;

		$("input[name=formaPago]").each(function(){
			if(this.checked){
				idCheckFormaPago = this.id;
				valorFormaPago = this.value;
			}
		});

		switch(idCheckFormaPago){
			case "formaPago2":
				valorAutorizacion = $("#numeroAuth1").val();
				if(valorAutorizacion.localeCompare("") == 0){
					validaciones = false;
				}
				break;
			case "formaPago3":
				valorAutorizacion = $("#numeroAuth2").val();
				if(valorAutorizacion.localeCompare("") == 0){
					validaciones = false;
				}
				break;
			default:
				valorAutorizacion = "";
				break;
		}		
		/********************************************/
		var valorAtencion = formatoNumerico($("#valorAtencion").html());
		valorAtencion = valorAtencion.substring(1);

		var empresaAten = "";
		var valoresAten = "";

		if(valorAtencion.localeCompare("0") == 0){
			empresaAten = "0";
			valoresAten = "0";
		}else{
			$("input[name=valorAtenciones]").each(function(){
				if(this.value.localeCompare("") != 0){
					empresaAten = empresaAten + this.id+",";
					valoresAten = valoresAten + this.value+",";
				}
			});

			empresaAten = empresaAten.substring(0,empresaAten.length-1);
			valoresAten = valoresAten.substring(0,valoresAten.length-1);
		}		
		console.log(empresaAten+" - "+valoresAten);
		/********************************************/

		if(validaciones){
			if(("".localeCompare(codigoCliente) == 0)){
				swal({
					title: 'Cliente no ingresado!',						
					type: "info",
					text: 'Si genera la factura con cliente nulo, no se podrá enviar la factura al correo.',//Se generaría la factura con cliente nulo.
					showCancelButton: true,
					confirmButtonColor: "#5cb85c",
					cancelButtonColor: "#EC4424",
					confirmButtonText: "Continuar y facturar",
					cancelButtonText: "Cancelar",
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
							mostrarFactura(valorFormaPago,valorAutorizacion,empresaAten,valoresAten);
							// muestra el mensaje de terminado
							//swal("","Factura generada correctamente","success");
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
				mostrarFactura(valorFormaPago,valorAutorizacion,empresaAten,valoresAten);
				// muestra el mensaje de terminado
				//swal("","Factura generada correctamente","success");
			}			
		}else{
			swal("Numero de autorizacion no ingresado","Debe ingresar el número de autorización dado en el váucher","error");
		}			
	}	

	function mostrarFactura(valorFormaPago,valorAutorizacion,empresaAten,valoresAten){
		/***********************************************************************/
		swal({
			title: "<div id='divLoader' class='loader center-block'></div>",
			text: "<div id='textoLoader'>Generando factura...</div>",			
			html:true,
			showCancelButton: false,		
			showConfirmButton: false,		
			cancelButtonColor: "#0288D1",
			confirmButtonClass: "btn-danger",
			confirmButtonText: "",
			closeOnConfirm: false		
		});
		/***********************************************************************/
		//toma el valor de la propina
		var propina = $('input:radio[name=optionsRadiosPropina]:checked').val(); 
		propina = propina.replace(",", ".");
		//propina = propina.substring(0,propina.indexOf(".")+4); 		
		//codigo del cliente
		var codigoClienteFactura = $("#idClientefac").html();
		var nombreClienteFactura = $("#nombreClientefac").html();
		//cuando el tamano de la mesa es de 4 personas
		if(generalTamano >= 1 && generalTamano <= 12){
			$.ajax({
				url:'<?php echo Url::toRoute(['site/facturar']); ?>',
				dataType:'json',
				method: "GET",
				data: {
					'codigoCliente':codigoClienteFactura,
					'nombreCliente':nombreClienteFactura,
					'codigoMesa':generalCodigoM,					
					'formaPago':valorFormaPago,
					'codigoAuth':valorAutorizacion,
					'puestos':generalCheksPulsados,
					'valorAtencion':valoresAten,
					'empresaAtencion':empresaAten,
					'porcentajePropina':propina
				},
				success: function (data) {						
					//numero de la factura
					var numeroFactura = data[0];					
					//cabecera de la factura
					var productos = data[1];
					//detalle de la factura
					var subtotal = data[2];
					//impuesto de la factura
					var impuestos = data[3];
					//
					var propina = data[4];
					//
					var atenciones = data[5];
					//
					var totalPagar = data[6];
					//
					var fechaFactura = data[7];
					//
					var horaFactura = data[8];
					// cabecera de la factura
					var arrayDatosCF = $.map(productos, function(value, index) {
		    			return [value];
					});
					// lista de productos
					var nombreProducto = arrayDatosCF[0];
					var unidadProducto = arrayDatosCF[1];
					var valorProducto = arrayDatosCF[2];
					
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
					document.getElementById("fechaFactura").innerHTML = fechaFactura;
					document.getElementById("horaFactura").innerHTML = horaFactura;
					document.getElementById("numeroFactura").innerHTML = numeroFactura;
					document.getElementById("listadoFactura").innerHTML = listaProductos;
					document.getElementById("valorSubtotal").innerHTML = '$'+formatoMoneda(subtotal.toString());	
					document.getElementById("valorPropina").innerHTML = '$'+formatoMoneda(propina.toString());	
					document.getElementById("valorIva").innerHTML = '$'+formatoMoneda(impuestos.toString());
					document.getElementById("valorAtencion").innerHTML = '$'+formatoMoneda(atenciones.toString());	
					document.getElementById("totalFactura").innerHTML = '$'+formatoMoneda(totalPagar.toString());	

					swal.close();
					imprimirFactura(numeroFactura);
					estadoMesaFac();
				}
			});
		}
	}

	function imprimirFactura(numeroFactura){
		$.ajax({
			url:'<?php echo Url::toRoute(['site/imprimirfactura']); ?>',
			dataType:'json',
			method: "GET",
			data: {
				'codigoFactura':numeroFactura,			
			}		
		});
	}

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
					var urlPlaza = '<?php echo Url::toRoute(['site/plaza']); ?>'
					location.href = urlPlaza;
				}else{
					reversarFac();
				}
			}
		);			
		
	}

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
					if(nombre.length > 6){
						nombreChecks.push(nombre.substring(nombre.length-2,nombre.length));
					}else{
						nombreChecks.push(nombre.substring(nombre.length-1,nombre.length));	
					}					
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

	function cancelarPuesto(puesto){
		//nombre del div que posee el puesto mostrado
		var nombre = '#puestoDiv'+puesto;		
		//datos en texto plano de los platos la cantidad y el puesto
		var platos = generalPlatos;
		var cantidad = generalCantidad;
		var puestos = generalPuestos;
		var notasPl = generalNotas;
		// acomodan los textos planos en array
		var arrPlatos = crearArray(platos);
		var arrCantidad = crearArray(cantidad);
		var arrPuestos = crearArray(puestos);
		var arrNotas = crearArray(notasPl);

		//array con los pedidos nuevos
		var arrPlatosNew = Array();
		var arrCantidadNew = Array();
		var arrPuestosNew = Array();
		var arrNotasNew = Array();
		var contador = 0; // rellenar los array new

		//recorre los array de los pedidos
		for(var j=0 ; j<arrPuestos.length ; j++){
			//
			if(arrPuestos[j] != puesto){				
				arrPlatosNew[contador] = arrPlatos[j];
				arrCantidadNew[contador] = arrCantidad[j];
				arrPuestosNew[contador] = arrPuestos[j];
				arrNotasNew[contador] = arrNotas[j];

				contador++;
			}			
		}

		//si es el ultimo o unico puesto que se esta eliminando los valores toman cero y no null
		if(arrPlatosNew[0] == null){
			arrPlatosNew[0] = 0;
			arrCantidadNew[0] = 0;
			arrPuestosNew[0] = 0;
			arrNotasNew[0] = 0;
		}

		//elimina el dis que esta mostrando el puesto 
		$(nombre).remove();
		
		//convierto los array en texto plato
		var platosTxt = arrayToChar(arrPlatosNew);
		var cantidadTxt = arrayToChar(arrCantidadNew);
		var puestoTxt = arrayToChar(arrPuestosNew);
		var notasTxt = arrayToChar(arrNotasNew);

		//cambio el valor de las variables que manejan los pedidos 
		generalPlatos = platosTxt;
		generalCantidad = cantidadTxt;
		generalPuestos = puestoTxt;
		generalNotas = notasTxt;

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
		cancelarAvatar(puesto);
		nombrePlatos();
	}

	function realizarPedido(){
		//datos en texto plano de los platos la cantidad y el puesto
		var platos = generalPlatos;
		var cantidad = generalCantidad;
		var puestos = generalPuestos;
		var mesa = generalCodigoM;
		var estado = generalEstadoM;
		var avatar = generalAvatarsDb;
		var notas = generalNotas;
		//datos en array 
		var arrplatos = crearArray(platos);		
		var termino = arrplatos.length;
		//cantidad de personas seleccionadas
		var cantidadPuestos = document.getElementById("numPersonas").value;
		
		// si hay pedidos para confirmar se hace el pedido si no sale error
		if(platos != 0){
			if(cantidadPuestos >= 1 && cantidadPuestos <= 12){
				if(estado != 0){				
					$.ajax({
						url:'<?php echo Url::toRoute(['site/realizarpedido']); ?>',
						dataType:'json',
						method: "GET",
						data: {'puestos':puestos, 'platos':platos , 'cantidad':cantidad, 'notas':notas , 'mesa':mesa, 'avatar':avatar, "tamano":cantidadPuestos},			
						success: function (data) {						
							
						}
					});
				}else{				
					$.ajax({
						url:'<?php echo Url::toRoute(['site/adicionarpedido']); ?>',
						dataType:'json',
						method: "GET",
						data: {'puestos':puestos, 'platos':platos , 'cantidad':cantidad, 'termino':termino , 'mesa':mesa, 'avatar':avatar},			
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
		var arrcodigosNotas = crearArray(generalPlatos);

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
						'<td class="desc" onclick="verNota(\''+arrPlatos[i]+'\','+i+',\''+arrcodigosNotas[i]+'\')">'+
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
		
		//document.getElementById("puestoDetalle").innerHTML = '<span class="txt__lightorange">Puesto '+puesto+'</span>';	
		document.getElementById("mesaDetalle").innerHTML = '<h5 class="text-right txt__light-70">Puesto '+puesto+'</h5>';
		document.getElementById("platosDetalle").innerHTML = contenidoPedido;
			

	}	
	
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
					
					generalNombrePlatos = arrayDatos[0];
					generalNombreImages = arrayDatos[1];

					verDetallePedidoMesa();
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

	function crearArray2(datos, separador){
		//array que se retorna
		var arrayRetornar = new Array();
		//cadena que entra y se va a estar modificando
		var cadena = datos+separador;		
		//posicion de la coma
		var posComa = cadena.indexOf(separador) ;			
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
			cadena = cadena.substr(posComa + separador.length);
			// se busca la posicion de la siguiente coma 
			posComa = cadena.indexOf(separador);
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

	function arrayToChar2(array,separador){
		//cadena que va tener los datos del array
		var char = '';
		// ciclo para rellenar la variable char
		for (var i=0 ; i<array.length ; i++) {
			//anida con los datos nuevos
			char = char + array[i] + separador;
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
				  		if(generalTamano <= 4 || (generalTamano >=7 && generalTamano <= 12)){				  			

							urlDestino = '<?php echo Url::toRoute(['site/mesa']); ?>'
							location.href = urlDestino+"&codigoM="+generalCodigoM+"&estadoM="+generalEstadoM+"&tamanoM="+generalTamano;	
								
						}else if(generalTamano >= 5 && generalTamano <= 6){												

							urlDestino = '<?php echo Url::toRoute(['site/mesa']); ?>'
							location.href = urlDestino+"&codigoM="+generalMesaPrinc+"&estadoM="+generalEstadoM+"&tamanoM="+generalTamano;
								
						}

						    
				  	} else {
					    swal("", "Proceso cancelado..", "error");
					}
				});
				break;

		}
	}

	/************ATENCIONES*************/	
	function adicionarAtencion(){
		$('#modalAtencion').modal('show');		
	}

	$("input[name='valorAtenciones']" ).change(function() {
		//valor total de las adiciones	  	
	  	var valorAcumulado = 0;
	  	$("input[name=valorAtenciones]").each(function(){
	  		//valor del input
	  		var valorInput = this.value;
	  		// si no esta definido toma el valor cero
	  		if(valorInput.localeCompare("") == 0){
	  			valorInput = 0;
	  		}
	  		//
	  		valorAcumulado = valorAcumulado + parseFloat(valorInput);
		});	  	
	  	$("#totalAtencionModal").html("TOTAL: $"+formatoMoneda(valorAcumulado.toString()));
	  	$("#valorAtencion").html("$"+formatoMoneda(valorAcumulado.toString()));

	  	// valor del subtotal
		var subtotalFactura = formatoNumerico($('#valorSubtotal').html());	
		subtotalFactura = subtotalFactura.substring(1);		
		// calcula el porcentaje sobre el subtotal
		var valorPropina = formatoNumerico($('#valorPropina').html());	
		valorPropina = valorPropina.substring(1);		
		//		
		var valorIvaFatura  = formatoNumerico($('#valorIva').html());	
		valorIvaFatura = valorIvaFatura.substring(1);		
		//
		var valorAtencion = formatoNumerico($("#valorAtencion").html());
		valorAtencion = valorAtencion.substring(1);

		var valorTotalFactura = (parseFloat(valorIvaFatura.replace(',','.')) + parseFloat(valorPropina) + parseFloat(subtotalFactura.replace(',','.'))).toFixed(2);		
		valorTotalFactura = (parseFloat(valorTotalFactura) - parseFloat(valorAtencion)).toFixed(2);

		$("#totalFactura").html("$"+formatoMoneda(valorTotalFactura.toString()));
		
	});
	/************ATENCIONES*************/	

	/************NOTAS*************/
	var contadorPedido = 0;

	function cerrarModal(){
		$('#modalNotas').modal('hide');		
	}

	function verNota(nombrePlato, posicion, id){
		$('#modalNotas').modal('show');
		$("#notaPlatoName").html(nombrePlato);
		$("#btnSaveNote").attr('onclick','guardarNotaPlato("'+posicion+'")');

		var opcionesNota1 = '';
		var notasPlatos = crearArray(generalNotas);		
		var notaDelPlato = crearArray2(notasPlatos[posicion],"*_");

		contadorPedido = 0;

		for(var i=0 ; i<notaDelPlato.length ; i++){
			opcionesNota1 = opcionesNota1 + '<option selected="selected">'+notaDelPlato[i]+'</option>';			
			contadorPedido++;
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

    	$("#btnDeleteNote").attr("onclick","eliminarNota(\'"+posicion+"\')");

	}

	function addOption(){				

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

    	contadorPedido++;
    }

    function guardarNotaPlato(posicion){
    	var notasArray = crearArray(generalNotas);    	

    	var inputSelects = $("#opcionNotasPlato").val();

		if(!!inputSelects){						
			notasArray[posicion] = arrayToChar(inputSelects);
			notasArray[posicion] = notasArray[posicion].replace(new RegExp(',', 'gi'), '*_');

			generalNotas = arrayToChar(notasArray);
			cerrarModal();
		}else{
			swal("Datos vacíos","Debe agregar una nota, de lo contrario cancele la operación","warning");
		}	
    	
    }

    function eliminarNota(posicion){

    	var notasArray = crearArray(generalNotas);    	
    	notasArray[posicion] = '';
		generalNotas = arrayToChar(notasArray);

		cerrarModal();				

    }
	/************NOTAS*************/	

	function habilitarAuth(idAuth){
		$("#"+idAuth).prop("disabled",false);
		$("#"+idAuth).focus();				
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



