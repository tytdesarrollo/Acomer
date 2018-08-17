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


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>		
	    <meta charset="<?= Yii::$app->charset ?>">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <?= Html::csrfMetaTags() ?>
	    <title><?= Html::encode($this->title) ?></title>		
		<?php $this->head() ?>	    

		<style type="text/css">					

			#fechaCuenta, #fechaHist, #fechaFactura, #horaFactura, #fecIniCierre, #fecFinCierre, #horaIniCierre, #horaFinCierre{
				width: 185px;
    			height: 31px;
			}

			#title {
				margin-top: 10px;
			}

			#title img{
				vertical-align: bottom;
			}

			#title p span:not(:first-child){
			    border-left:1px solid #fff;
			}

			#title span{
			    padding:0 5px;
			}

			#nameRest {
				color:white;
			}

			.tab-content {
			    padding-top: 4px;
			}

			#containerTab {
				background: white;
			}

			#iconFecha {
				color: black;
			}

			#btnCierre, #btnAnadir, #btnFacturar {
				background: #009688;
				color:white;
			}
			
			#catForm label{
				color: black;
			}		
			.deleteIcon{
				color: red;
			}

			.editIcon{
				color: #f7f71e;
			}

			table img{
				width: 32px;
			}

			#bodyContModal3 img{
				width: 81px;
			}

			.ui-menu .ui-menu-item {
			    margin: 0;
			    cursor: pointer;
			    list-style-image: url(data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7);
			}

			li {
			    display: list-item;
			    text-align: -webkit-match-parent;
			}

			.ul {
			    display: none;
			    top: 416.469px;
			    left: 317px;
			    width: 932px;
			}
			.ui-widget.ui-widget-content {
			    border: 1px solid #d3d3d3;
			}
			.ui-widget-content {
			    border: 1px solid #aaaaaa;
			    background: #ffffff;
			    color: #222222;
			}
			.ui-widget {
			    font-family: Verdana,Arial,sans-serif;
			    font-size: 1.1em;
			}
			.ui-menu {
			    list-style: none;
			    padding: 0;
			    margin: 0;
			    display: block;
			    outline: 0;
			}
			.ui-autocomplete {
			    position: absolute;
			    top: 0;
			    left: 0;
			    cursor: default;
			}
			.ui-front {
			    z-index: 100;
			}
			
			.hrNotvisible{
				border: 0;
				clear:both;
				display:block;
				width: 96%;
				background-color:#FFF;
				height: 1px;
			}

			.centerThead{
				 text-align: center;
			}

			.centerTbody{
				text-align: right;
			}
			
		</style>
		<?= Html::jsFile('@web/js/jquery.min.js') ?>

		<script type="text/javascript">
			
		</script>

	</head>

	<body class='bg-acomer'>
		<?php $this->beginBody() ?>
			<div class="container">				
				<div class="row" id="title">					
					<div class="col-md-12 text-center">
						<p class="txt__light-100">
							
							<div class="pull-right">
								<a href="#" class="btn btn-raised btn-organge-grad btn-radius btn-inline" onclick="salir()" id="btnSalida">
									<i class="material-icons icon-btn">&#xE14C;</i>Salir
								</a>
							</div>
							
							<span>
								<?= Html::img('@web/img/logo_small.png', ['alt' => 'Acomer', 'class' => 'logo-login',]) ?>	
							</span>							
							<span id="nameRest">
								EL DISTRITO DAPA S.A.S
							</span>						  	
						</p>	
						<p class="txt__light-100 mrg__top-30">
							<span>
								NIT. 901.124.396-2
							</span>							
						</p>								  
					</div>
				</div>

				<div class="row" id="containerTab">
					<div id="tabbar">
						<ul class="nav nav-tabs">
							<?php if ($rol === "ADMINISTRADOR"): ?>
								<li  class="active">
									<a href="#tab1" data-toggle="tab">
										<i class="material-icons">attach_money</i> CUENTAS
									</a>
								</li>
								<li class="divider"><div class="ln"></div></li>							
								<li >
									<a href="#tab2" data-toggle="tab">
										<i class="material-icons">&#xE889;</i> HISTORIAL DE VENTAS
									</a>
								</li>
								<li class="divider"><div class="ln"></div></li>							
								<li >								
									<a href="#tab3" data-toggle="tab" id="tab3Click">									
										<i class="material-icons icon-btn">&#xE561;</i> MENU RESTAURANTES
									</a>
								</li>
								<li class="divider"><div class="ln"></div></li>
								<li >
									<a href="#tab4" data-toggle="tab">
										<i class="material-icons">&#xE8A1;</i> CIERRES
									</a>
								</li>	
								<li class="divider"><div class="ln"></div></li>
								<li >
									<a href="#tab5" data-toggle="tab">
										<i class="material-icons">insert_drive_file</i> FACTURAR
									</a>
								</li>		
							<?php else: ?>
								<li >
									<a href="#tab1" data-toggle="tab">
										<i class="material-icons">attach_money</i> CUENTAS
									</a>
								</li>
								<li class="active">								
									<a href="#tab3" data-toggle="tab">									
										<i class="material-icons icon-btn">&#xE561;</i> MENU RESTAURANTES
									</a>
								</li>
								<li class="divider"><div class="ln"></div></li>
								<li >
								<a href="#tab4" data-toggle="tab">
									<i class="material-icons">&#xE8A1;</i> CIERRES
								</a>
								<li class="divider"><div class="ln"></div></li>
								<li >
									<a href="#tab5" data-toggle="tab">
										<i class="material-icons">insert_drive_file</i> FACTURAR
									</a>
								</li>
							<?php endif ?>				
						</ul>
					</div>
					<div class="tab-content">						

					<!--CUENTAS-->
						<?php if ($rol === "ADMINISTRADOR"): ?>
						  <div class="tab-pane fade active in" id="tab1">	
						<?php else: ?>
						  <div class="tab-pane fade in" id="tab1">
						<?php endif ?>						
							<div class="heading">
								<h3 class="fnt__Medium text-center"><strong>CUENTAS</strong></h3>
							</div>
							<div class="body">		

								<hr>		

								<div class="row">									
									<div class="col-md-6">
										<div class="input-group" id="contentSearch">
											<span class="input-group-addon">
												<i class="material-icons" >date_range</i>
											</span>
											<input type="date" class="form-control" id="fechaCuenta" value="<?php echo date("Y-m-d");?>">
										</div>
									</div>																		
								</div>	


								<hr>									
								
								<div class="col-md-12">					
									<!--<h4 class="fnt__Medium"><strong>Detalle por empresa</strong></h4>-->
									<table class="table table-striped table-bordered table-responsive" id="dataTable8" style="width: 100%;overflow-x:auto;">
										<thead class="thead" align="center">
											<tr>
												<th></th>		
												<th class="centerThead" colspan="2">NETO DIA</th>
												<th class="centerThead" colspan="6">ACUMULADOS</th>
												<th class="centerThead" colspan="3">TOTAL DIARIO</th>	
											</tr>
											<tr>
												<th class="centerThead">EMPRESA</th>		
												<th class="centerThead">NETO</th>										
												<th class="centerThead">%</th>
												<th class="centerThead">SEMANA</th>
												<th class="centerThead">%</th>
												<th class="centerThead">MES</th>
												<th class="centerThead">%</th>
												<th class="centerThead">AÑO</th>												
												<th class="centerThead">%</th>
												<th class="centerThead">BRUTO*</th>												
												<th class="centerThead">IMPUESTOS</th>
												<th class="centerThead">ATENCIONES</th>											
											</tr>
										</thead>
										<tbody id="bodyCuenta1">											

										</tbody>
									</table>
									*No incluye impuesto									

								</div>									
								
											
							</div>
						</div>
					
					<!--HISTORIAL DE VENTAS-->
						<div class="tab-pane fade in" id="tab2">
							<div class="heading">
								<h3 class="fnt__Medium text-center"><strong>HISTORIAL DE VENTAS</strong></h3>
							</div>							
							<div class="body">
								<hr>
								<div class="row">									
									<div class="col-md-6">
										<div class="input-group" id="contentSearch">
											<span class="input-group-addon">
												<i class="material-icons" >date_range</i>
											</span>
											<input type="date" class="form-control" id="fechaHist" value="<?php echo date("Y-m-d");?>">
										</div>
									</div>																		
								</div>	
								<hr>

								<div class="col-md-12">
									<table class="table table-striped" id="dataTable2" style="width: 100%;overflow-x:auto;">
										<thead class="thead">
											<tr>
												<th scope="col" class="order-data-tables"></th>
												<th scope="col">NIT</th>
												<th scope="col">RESTAURANTE</th>
												<th scope="col"># DOCUMENTO</th>
												<th scope="col">FECHA</th>
												<th scope="col">SUBTOTAL</th>
												<th scope="col">PROPINA</th>
												<th scope="col">IMPUESTO</th>
												<th scope="col">ATENCIONES</th>
												<th scope="col">VALOR FACTURADO</th>
											</tr>
										</thead>
										<tbody id="tBodyHist">
											<?php for ($i=0 ; $i<count($documentos['NIT']) ; $i++): ?>
												<tr>
													<td><i class="material-icons" onclick="mostrarDetallesVentas(<?=$i?>)">&#xE417;</i></td>
													<td><span id='histnit<?=$i?>'><?=$documentos['NIT'][$i]?></span></td>
													<td><span id='histemp<?=$i?>'><?=$documentos['EMPRESA'][$i]?></span></td>
													<td><span id='histdoc<?=$i?>'><?=$documentos['DOCUMENTO'][$i]?></span></td>
													<td><?=$documentos['FECHA'][$i]?></span></td>
													<td><span id='histsub<?=$i?>'><?=number_format($documentos['SUBTOTAL'][$i], 2,',', '.')?></span></td>
													<td><span id='histpro<?=$i?>'><?=number_format($documentos['PROPINA'][$i], 2,',', '.')?></span></td>
													<td><span id='histimp<?=$i?>'><?=number_format($documentos['IMPUESTO'][$i], 2,',', '.')?></span></td>
													<td><span id='histatn<?=$i?>'><?=number_format($documentos['ATENCIONES'][$i], 2,',', '.')?></span></td>
													<td><span id='histval<?=$i?>'><?=number_format($documentos['VALOR'][$i], 2,',', '.')?></span></td>
											    </tr>	
											<?php endfor ?>											
										</tbody>
									</table>
								</div>
							</div>
						</div>

					<!--MENU DE RESTAURANTE-->
						<?php if ($rol === "ADMINISTRADOR"): ?>
						<div class="tab-pane fade in" id="tab3">						
						<?php else: ?>
						<div class="tab-pane fade active in" id="tab3">												
						<?php endif ?>												
							<div class="heading">
								<h3 class="fnt__Medium text-center"><strong>MENU DE RESTAURANTES</strong></h3>
							</div>
							<div class="body">
								<hr>
								<div class="row">									
									<div class="col-md-12">
										<div class="row">
											<div class="col-md-6">												
												<button class="btn btn-link click-order-table" onclick="showForm('CAT')">CATEGORIA</button>
												<button class="btn btn-link click-order-table" onclick="showForm('PLA')">Platos</button>
												<button class="btn btn-link click-order-table" onclick="showForm('NTS')">NOTAS</button>
											</div>																						
										</div>
										<div class="row">
											<div id="catForm" class="col-md-12">	
												<hr>
												<div class="col-md-12">
													<h4><strong>LISTA DE CATEGORIAS</strong></h4>	
													<a class="pull-right btn btn-raised btn-success btn-radius btn-inline" onclick="editarCategoria('nuevo')" style="z-index: 2;">
														<i class="material-icons">add</i> crear
													</a>												
												</div>												
												<div class="col-md-12" style="z-index: 1;">													
													<table class="table table-striped" id="dataTable6" style="width: 100%;" >
														<thead class="thead">
															<tr>
																<th>CODIGO</th>
																<th>NOMBRE</th>
																<th>IMAGEN</th>
																<th class="order-data-tables">EDITAR</th>
																<th>ELIMINAR</th>
															</tr>	
														</thead>
														<tbody>
															
														</tbody>
													</table>													
												</div>
											</div>
											<div id="plaForm" class="col-md-12">
												<hr>
												<div class="col-md-12">
													<h4><strong>LISTA DE PLATOS</strong></h4>	
													<a class="pull-right btn btn-raised btn-success btn-radius btn-inline" onclick="editarPlato('nuevo')" style="z-index: 2;">
														<i class="material-icons">add</i> crear
													</a>												
												</div>												
												<div class="col-md-12" style="z-index: 1;">													
													<table class="table table-striped" id="dataTable7" style="width: 100%;overflow-x:auto;">
														<thead class="thead">
															<tr>
																<th>CODIGO</th>
																<th>NOMBRE</th>
																<th>PRECIO BRUTO</th>
																<th>PRECIO NETO</th>
																<!--<th>IMAGEN</th>-->
																<th>COD CATEGORIA</th>
																<th>CATEGORIA</th>
																<th>TIEMPO (min)</th>
																<th>NIT</th>
																<th>EMPRESA</th>
																<th>DESCRIPCION</th>
																<th class="order-data-tables">EDITAR</th>
																<th>ELIMINAR</th>
															</tr>
														</thead>
														<tbody>
															
														</tbody>
													</table>													
												</div>
											</div>
											<div id="notaForm" class="col-md-12">	
												<hr>
												<div class="col-md-12">
													<h4><strong>LISTA DE NOTAS</strong></h4>	
													<a class="pull-right btn btn-raised btn-success btn-radius btn-inline" onclick="editarNota('nuevo')" style="z-index: 2;">
														<i class="material-icons">add</i> crear
													</a>												
												</div>												
												<div class="col-md-12" style="z-index: 1;">													
													<table class="table table-striped" id="dataTable9" style="width: 100%;" >
														<thead class="thead">
															<tr>
																<th>DESCRIPCION NOTA</th>
																<th>CATEGORIA / PLATO</th>
																<th class="order-data-tables">EDITAR</th>
																<th>ELIMINAR</th>
															</tr>
														</thead>
														<tbody>
															
														</tbody>
													</table>													
												</div>
											</div>
										</div>
									</div>
								</div>								
							</div>
						</div>

					<!--CIERRES-->
						<div class="tab-pane fade in" id="tab4">
							<div class="heading">
								<h3 class="fnt__Medium text-center"><strong>CIERRES</strong></h3>
							</div>
							<div class="body">
								<hr>								
								<div class="col-md-12">
									<h3><strong>Cierre del dia</strong></h3>
								</div>
								<br>
								<div class="col-md-12">
									<table class="table table-striped" style="width: 100%;">
										<thead class="thead">
											<tr>
												<th scope="col">FECHAS</th>
												<th scope="col">HORAS</th>					
											</tr>
										</thead>
										<tbody>
											<tr>													
												<td>
													<div class="col-md-6">
														<label class="font-style-form" for="fecIniCierre">Fecha de incio</label>
														<div class="input-group" id="contentSearch">
															<span class="input-group-addon">
																<i class="material-icons" >date_range</i>
															</span>
															<input type="date" class="form-control" id="fecIniCierre" max="<?php echo date("Y-m-d");?>">
														</div>
													</div>			
												</td>												
												<td>
													<div class="col-md-6">
														<label class="font-style-form" for="horaIniCierre">Hora de incio</label>
														<div class="input-group" id="contentSearch">															
															<span class="input-group-addon">
																<i class="material-icons" >hourglass_empty</i>
															</span>
															<input type="time" class="form-control" id="horaIniCierre" disabled="disabled">
														</div>
													</div>	
												</td>
											</tr>

											<tr>
												<td>
													<div class="col-md-6">
														<label class="font-style-form" for="fecFinCierre">Fecha fin</label>
														<div class="input-group" id="contentSearch">															
															<span class="input-group-addon">
																<i class="material-icons" >date_range</i>
															</span>
															<input type="date" class="form-control" id="fecFinCierre" disabled="disabled">
														</div>
													</div>	
												</td>
												<td>
													<div class="col-md-6">
														<label class="font-style-form" for="horaFinCierre">Hora fin</label>
														<div class="input-group" id="contentSearch">															
															<span class="input-group-addon">
																<i class="material-icons" >hourglass_empty</i>
															</span>
															<input type="time" class="form-control" id="horaFinCierre" disabled="disabled">
														</div>
													</div>
												</td>												
										    </tr>	
										</tbody>
									</table>									
								</div>								
								<div class="col-md-12 text-center">
									Confirmar: <input type="checkbox" id="confirmCierre" onclick="checkCierre(1)">
								</div>			
								<div class="col-md-12 text-center">									
									<button class="btn btn-primary" id="btnCierre" onclick="realizarCierre()">Realizar cierre</button>
								</div>
								<hr>
								<div class="col-md-12">
									<h3><strong>Historial de cierres</strong></h3>
								</div>
								<br>
								<div class="col-md-12">
									<table class="table table-striped" id="dataTable3" style="width: 100%;overflow-x:auto;" >
										<thead class="thead">
											<tr>
												<th scope="col" class="order-data-tables"></th>
												<th scope="col">CODIGO</th>
												<th scope="col">FECHA INICIO</th>
												<th scope="col">HORA INICIO</th>
												<th scope="col">FECHA FIN</th>
												<th scope="col">HORA FIN</th>
												<th scope="col">TIPO DE CIERRE</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th><i class="material-icons" onclick="mostrarDetalleCierre()">&#xE417;</i></th>
												<th>#041</th>										
												<td>09/05/2018</td>
												<td>3:00:00 PM</td>
												<td>10/05/2018</td>
												<td>1:00:00 AM</td>
												<td>Total</td>
										    </tr>	
										</tbody>
									</table>
								</div>
							</div>
						</div>

					<!--FACTURAR-->
						<div class="tab-pane fade in" id="tab5">
							<div class="heading">
								<h3 class="fnt__Medium text-center"><strong>FACTURAR</strong></h3>
							</div>
							<div class="body">
								<hr>
							<!--HORA Y FECHA DE PROCEDO-->
								<div class="col-md-12">									
									<h5><strong>HORA Y FECHA DE PROCESO*</strong></h5>
								</div>								
								<div class="row">									
									<div class="col-md-6">
										<div class="input-group" id="contentSearch">
											<span class="input-group-addon">
												<i class="material-icons" >date_range</i>
											</span>
											<input type="date" class="form-control" id="fechaFactura">
										</div>
									</div>						
									<div class="col-md-6">
										<div class="input-group" id="contentSearch">
											<span class="input-group-addon">
												<i class="material-icons" >hourglass_empty</i>
											</span>
											<input type="time" class="form-control" id="horaFactura">
										</div>
									</div>																		
								</div>	
								<hr>
							<!--LISTA DE PEDIDOS-->
								<div class="col-md-12">									
									<h5><strong>PEDIDO*</strong></h5>
								</div>	
								<div class="col-md-3">
									<label class="font-style-form" for="codPlatosFactura">Codigo de plato</label>
									<input type="text" class="form-control" id="codPlatosFactura" disabled="disabled">
								</div>
								<div class="col-md-4">
									<label class="font-style-form" for="platosFactura">Selecciona el plato pedido</label>
									<input type="text" class="form-control" id="platosFactura">
								</div>			
								<div class="col-md-3">
									<label class="font-style-form" for="cantidadPlato">Selecciona cantidad</label>
									<input type="number" class="form-control" id="cantidadPlato" value="1">
								</div>									
								<div class="col-md-2">
									<button class="btn btn-primary" id="btnAnadir" onclick="anadirPlato()">AÑADIR</button>
								</div>
								<div class="row"></div>
								<hr>
								<div class="col-md-12">									
									<h5><strong>LISTA PEDIDO*</strong></h5>
								</div>	
								<div class="col-md-12">
									<table class="table table-striped" id="tablePedido">
										<thead>
											<th>CODIGO</th>
											<th>PLATO</th>
											<th>CANTIDAD</th>											
											<th></th>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
								<div class="row"></div>
								<hr>
							<!--DATOS DE FACTURACION-->
								<div class="col-md-12">									
									<h5><strong>DATOS DE FACTURA*</strong></h5>
								</div>
								
								<div class="col-md-6">
									<label class="font-style-form" for="meseroFactura">Codigo de mesero</label>
									<div class="input-group" id="contentSearch">
										<span class="input-group-addon">
											<i class="material-icons" >person_pin</i>
										</span>
										<input type="number" class="form-control" id="meseroFactura" placeholder="Cedula del mesero">
									</div>
								</div>																	
															
								<div class="col-md-6">
									<label class="font-style-form" for="codigoMesa">Codigo de mesa</label>
									<div class="input-group" id="contentSearch">
										<span class="input-group-addon">
											<i class="material-icons" >location_on</i>
										</span>
										<input type="number" class="form-control" id="codigoMesa" placeholder="Codigo de la mesa">
									</div>
								</div>																										

								<div class="col-md-12">
									<hr class="hrNotvisible">
								</div>

								<div class="col-md-6">								
									<label class="font-style-form" for="formaPagos">Forma de pago</label>	
									<select id="formaPagos" class="form-control">
				    					<option id="default" selected="selected" value="default">Selecciona una forma de pago</option>
				    					<option id="01" value="01">Efectivo</option>
				    					<option id="02" value="02">Tarjeta</option>
				    					<option id="03" value="03">Ambos</option>
									</select>
								</div>								
																			
								<div class="col-md-6">
									<label class="font-style-form" for="numAutorizacion">Numero de autorizacion</label>	
									<div class="input-group" id="autorizacionContent">										
										<span class="input-group-addon">
											<i class="material-icons" >payment</i>
										</span>
										<input type="number" class="form-control" id="numAutorizacion" placeholder="Ingresa el numero de autorizacione">
									</div>
								</div>	

								<div class="row"></div>
								<hr>
								<div class="col-md-12">									
									<h5><strong>ATENCIONES</strong></h5>
								</div>	
								<div class="col-md-6">	
									<label class="font-style-form" for="atencion1">Atenciones de <?=$container1?></label>		
									<div class="input-group" id="contentSearch">
										<span class="input-group-addon">
											<i class="material-icons" >attach_money</i>
										</span>
										<input type="number" class="form-control" id="atencion1" placeholder="Ingrese antencion de <?=$container1?>">
									</div>																
								</div>
								<div class="col-md-6">		
									<label class="font-style-form" for="atencion2">Atenciones de <?=$container2?></label>		
									<div class="input-group" id="contentSearch">
										<span class="input-group-addon">
											<i class="material-icons" >attach_money</i>
										</span>
										<input type="number" class="form-control" id="atencion2" placeholder="Ingrese antencion de <?=$container2?>">
									</div>																
								</div>
								<div class="col-md-12">
									<hr class="hrNotvisible">
								</div>
								<div class="col-md-6">	
									<label class="font-style-form" for="atencion3">Atenciones de <?=$container3?></label>		
									<div class="input-group" id="contentSearch">
										<span class="input-group-addon">
											<i class="material-icons" >attach_money</i>
										</span>
										<input type="number" class="form-control" id="atencion3" placeholder="Ingrese antencion de <?=$container3?>">
									</div>																		
								</div>
								<div class="col-md-6">		
									<label class="font-style-form" for="atencion4">Atenciones de <?=$container4?></label>		
									<div class="input-group" id="contentSearch">
										<span class="input-group-addon">
											<i class="material-icons" >attach_money</i>
										</span>
										<input type="number" class="form-control" id="atencion4" placeholder="Ingrese antencion de <?=$container4?>">
									</div>																	
								</div>
								<div class="row"></div>
								<hr>
								<div class="col-md-12">									
									<h5><strong>PROPINA*</strong></h5>
								</div>	
								<div class="col-md-6">	
									<label class="font-style-form" for="valorPropina">Valor de la propina</label>	
									<div class="input-group" id="contentSearch">
										<span class="input-group-addon">
											<i class="material-icons" >attach_money</i>
										</span>
										<input type="number" class="form-control" id="valorPropina" placeholder="Ingrese valor de la propina">
									</div>																		
								</div>
								<div class="col-md-6">	
									<label class="font-style-form" for="cedulaCliente">Cedula del cliente</label>	
									<div class="input-group" id="contentSearch">
										<span class="input-group-addon">
											<i class="material-icons" >person_pin</i>
										</span>
										<input type="number" class="form-control" id="cedulaCliente" placeholder="Ingrese cedula del cliente">
									</div>																		
								</div>
								<div class="col-md-12">
									<hr class="hrNotvisible">
								</div>
								<div class="col-md-12">	
									<button class="btn btn-primary" id="btnFacturar" onclick="visualizaFactura()" style="width: 100%">FACTURAR</button>																		
								</div>
							</div>
						</div>
					</div>
				</div>


					
				
			<!-- Modal HISTORIAL -->
        		<div id="ModalContent" class="modal fade" role="dialog" >
  					<div class="modal-dialog modal-lg">
    					<div class="modal-content">
      						<div class="modal-header text-center">
        						<!--<h4 class="modal-tittle"><strong id="tituloModal">DETALLE DE DOCUMENTO</strong></h4>-->
      						</div>
							 <div class="modal-body">
						 		<div class="container-fluid" id="contenidoModal">
						 			<a class="pull-right btn btn-raised btn-success btn-radius btn-inline" onclick="imprimirFactura()" id="impFacBtn" style="z-index: 2;">
										<i class="material-icons">print</i> Imprimir
									</a>
						 			<div id="headContModal"></div>						 				
						 			<hr>
						 			<div id="bodyContModal">
						 				<h4 class="modal-tittle"><strong>PLATOS VENDIDOS</strong></h4>
						 				<table class="table table-striped" id="dataTable4" style="width: 100%;overflow-x:auto;">
						 					<thead  class="thead">
						 						<th>PRODUCTO</th>
												<th>CANTIDAD</th>
												<th>PRECIO UNIDAD*</th>
												<th>IMPUESTO</th>
												<th>PRECIO VENTA</th>				 												 						
						 					</thead>
						 					<tbody>
						 						
						 					</tbody>
						 				</table>
						 				*No incluye impuesto
						 			</div>
						 			<hr>						 			
						 			<div id="footContModal">						 				
						 				<!--TABLA DE ATENCIONES-->
						 				<h4 class="modal-tittle"><strong>ATENCIONES</strong></h4>
										<table class="table table-striped" id="tableDetAtencion" style="width: 100%;overflow-x:auto;">
											<thead class="thead">
												<tr>
													<th>NIT</th>
													<th>EMPRESA</th>
													<th>VALOR</th>													
												</tr>
											</thead>
											<tbody>
												
											</tbody>
										</table>

										<hr>
						 				<!--TABLA DE TOTALES-->
						 				<h4 class="modal-tittle"><strong>TOTALES</strong></h4>
						 				<table class="table table-striped" style="width: 100%">
											<thead class="thead">
												<tr>
													<th>SUBTOTAL*</th>
													<th>PROPINA</th>
													<th>IMPUESTOS</th>
													<th>ATENCIONES</th>
													<th>TOTAL</th>
												</tr>
											</thead>
											<tbody>
												<tr>					
													<td><h4 id="idDocDetSub">$0</h4></td>
											    	<td><h4 id="idDocDetPro">$0</h4></td>
											    	<td><h4 id="idDocDetImp">$0</h4></td>
											    	<td><h4 id="idDocDetAtn">$0</h4></td>
											    	<td>
  														<h4 id="idDocDetTot" style="height:30px;width:112px;display:table-cell;text-align:center;vertical-align:middle;border-radius:50%;background: #ef1818;">
  															<strong>$0</strong>
  														</h4>
  													</td>
											    </tr>
											</tbody>
										</table>
										*No incluye impuesto
										<hr>	

										<a class="pull-rigth btn btn-raised btn-success btn-radius btn-inline" onclick="actionDetalleFac(1)" id="detalleFacBtn">
											<i class="material-icons">expand_more</i> detalle
										</a>									

										<!--GANANCIAS POR CONTAINER-->
										<div id="detailFacDoc">
							 				<h4 id="titleDetailFac" class="modal-tittle"><strong>VENTA POR CONTAINER</strong></h4>
							 				<table id="tableDetailFac" class="table table-striped" style="width: 100%">
												<thead class="thead">
													<tr>
														<th>NIT</th>
														<th>EMPRESA</th>
														<th>SUBTOTAL*</th>													
														<th>IMPUESTOS</th>
														<th>ATENCIONES</th>
														<th>TOTAL</th>
													</tr>
												</thead>
												<tbody>
													<tr>					
														
												    </tr>
												</tbody>
											</table>
											*No incluye impuesto
										</div>
						 			</div>
						 			
								</div>
							</div>      						
    						<div class="modal-footer">
      							<button type="button" class="btn btn-default" data-dismiss="modal">
    								<span class="glyphicon glyphicon-remove"></span>
                        			<span class="hidden-xs"> Cerrar</span> 
    							</button>         
    						</div>
      						
    					</div>
  					</div>
				</div>

			<!-- Modal CIERRE -->
        		<div id="ModalContent2" class="modal fade" role="dialog" >
  					<div class="modal-dialog modal-lg">
    					<div class="modal-content">
      						<div class="modal-header text-center">
        						<h4 class="modal-tittle"><strong id="tituloModal2">DETALLE DE CIERRE</strong></h4>
      						</div>
							 <div class="modal-body">
						 		<div class="container-fluid" id="contenidoModal2">
						 			<div id="headContModal2">
						 				<table class="table table-striped">			
											<thead class="thead">
												<th>SUB TOTAL</th>
												<th>PROPINAS</th>
												<th>IMPUESTOS</th>
												<th>ATENCIONES</th>
												<th>TOTAL</th>
											</thead>							
											<tbody>
												<tr>
													<td>$<span id="subtotalCierre"></span></td>											
													<td>$<span id="propinaCierre"></span></td>	
													<td>$<span id="impuestosCierre"></span></td>		
													<td>$<span id="descuentosCierre"></span></td>									
													<td><strong>$<span id="netoCierre"></span></strong></td>
												</tr>
											</tbody>
										</table>
						 			</div>
						 			<hr>
						 			<div id="bodyContModal2">
						 				<table class="table table-striped table-responsive" id="dataTable5" style="width: 100%;overflow-x:auto;">
						 					<thead  class="thead">
						 						<th>NIT</th>
												<th>EMPRESA</th>
												<th>CODIGO PRODUCTO</th>
												<th>NOMBRE PRODUCTO</th>
												<th>CANTIDAD</th>
												<th>TOTAL</th>				 												 						
						 					</thead>
						 					<tbody id="bodyTableModal2">
						 						
						 					</tbody>
						 				</table>
						 			</div>
						 			<hr>
						 			<div id="footContModal2"></div>
						 			
								</div>
							</div>      						
    						<div class="modal-footer">
      							<button type="button" class="btn btn-default" data-dismiss="modal">
    								<span class="glyphicon glyphicon-remove"></span>
                        			<span class="hidden-xs"> Cerrar</span> 
    							</button>      							        
    						</div>
      						
    					</div>
  					</div>
				</div>

			<!--MODAL DE EDITAR CATEGORIA-->
				<div id="ModalContent3" class="modal fade" role="dialog" >
  					<div class="modal-dialog modal-lg">
    					<div class="modal-content">
      						<div class="modal-header text-center">
        						<h4 class="modal-tittle"><strong id="tituloModal3">EDITAR CATEGORIA</strong></h4>
      						</div>
							 <div class="modal-body">
						 		<div class="container-fluid" id="contenidoModal3">
						 			<div id="headContModal3">
						 				
						 			</div>
						 			<hr>
						 			<div id="bodyContModal3">
						 				<div class="form-group" id="codigoCategoria">
											<label class="font-style-form" for="nomCategoria">Codigo de la categoria</label>    								    				
											<div class="row">										
												<div class="col-md-12">
													<input type="text" class="form-control" id="codCategoria" placeholder="Ingrese nombre de la categoria" disabled>
												</div>												
											</div>						    				
						    			</div>
						 				<div class="form-group" id="empreNewCat">
											<label class="font-style-form" for="empresaCat">Empresa de la categoria</label>											
											<br>											
						    				<select id="empCategoria" class="form-control">
						    					<option id="defaultEmpCat" selected="selected" value="default">Selecciona una empresa</option>
						    					<?php for ($i=0 ; $i<count($empresas['GEN_EMP_COD']) ; $i++): ?>
						    						<option id="<?=$empresas["GEN_EMP_COD"][$i]?>" value="<?=$empresas["GEN_EMP_COD"][$i]?>"><?=$empresas["GEN_EMP_NOM"][$i]?></option>	
						    					<?php endfor ?>													
											</select>							    				
						    			</div>	
						 				<div class="form-group">
											<label class="font-style-form" for="nomCategoria">Nombre de la categoria</label>    								    				
											<div class="row">										
												<div class="col-md-12">
													<input type="text" class="form-control" id="nomCategoria" placeholder="Ingrese nombre de la categoria">
												</div>												
											</div>						    				
						    			</div>		
						    			<div class="form-group">						    				
											<div class="col-md-6">
												<label class="font-style-form" for="imgCategoria">Imagen de la categoria</label>
												<br>											
							    				<select id="imgCategoria" class="form-control">
							    					<option id="defaultImgCat" selected="selected" value="default">Selecciona una imagen</option>
							    					<?php for ($i=2 ; $i<count($imgcategorias) ; $i++): ?>
							    						<option id="<?=substr($imgcategorias[$i],0,strrpos($imgcategorias[$i],'.'))?>" value="<?=substr($imgcategorias[$i],0,strrpos($imgcategorias[$i],'.'))?>">Imagen <?=$i-1?> - <?=substr($imgcategorias[$i],0,strpos($imgcategorias[$i],'_',0))?></option>	
							    					<?php endfor ?>													
												</select>

											</div>
											<div class="col-md-6">												
												<center>
													<img id="imgEditCat" src="img/categorias/especiales_cat_icon.png" align="middle">
												</center>
											</div>
						    			</div>				    			
						    			
						 			</div>
						 			<hr>
						 			<div id="footContModal3">
						 				
						 			</div>						 			
								</div>
							</div>      						
    						<div class="modal-footer">
      							<button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarEditCateg">
    								<span class="glyphicon glyphicon-remove"></span>
                        			<span class="hidden-xs"> Cerrar</span> 
    							</button>         
    							<button type="button" class="btn btn-default" onclick="accionBtnEditCateg()" id="btnSaveCateg">
    								<span class="glyphicon glyphicon-floppy-saved"></span>
                        			<span class="hidden-xs"> Guardar</span> 
    							</button> 
    						</div>
      						
    					</div>
  					</div>
				</div>

			<!--EDITAR PLATOS-->
				<div id="ModalContent4" class="modal fade" role="dialog" >
  					<div class="modal-dialog modal-lg">
    					<div class="modal-content">
      						<div class="modal-header text-center">
        						<h4 class="modal-tittle"><strong id="tituloModal4">EDITAR PLATO</strong></h4>
      						</div>
							 <div class="modal-body">
						 		<div class="container-fluid" id="contenidoModal4">
						 			<div id="headContModal4">
						 				
						 			</div>
						 			<hr>
						 			<div id="bodyContModal4">
						 				<div class="form-group">
											<label class="font-style-form" for="empresaPlato">Empresa del plato</label>											
											<br>											
						    				<select id="empPlato" class="form-control">
						    					<option id="defaultEmpPl" selected="selected" value="default">Selecciona una empresa</option>
						    					<?php for ($i=0 ; $i<count($empresas['GEN_EMP_COD']) ; $i++): ?>
						    						<option id="<?=$empresas["GEN_EMP_COD"][$i]?>" value="<?=$empresas["GEN_EMP_COD"][$i]?>"><?=$empresas["GEN_EMP_NOM"][$i]?></option>	
						    					<?php endfor ?>													
											</select>							    				
						    			</div>	
						    			<div class="form-group">
											<label id="labelcodPlato" class="font-style-form" for="nomPlato">Codigo del plato</label>    								    				
											<div class="row">										
												<div class="col-md-12">
													<input type="text" class="form-control" id="codPlato" placeholder="" disabled="disabled">
												</div>												
											</div>						    				
						    			</div>	
						 				<div class="form-group">
											<label class="font-style-form" for="nomPlato">Nombre del plato</label>    								    				
											<div class="row">										
												<div class="col-md-12">
													<input type="text" class="form-control" id="nomPlato" placeholder="Ingrese nombre del plato">
												</div>												
											</div>						    				
						    			</div>								    			
						    			<div class="form-group">
											<label class="font-style-form" for="empresaPlato">Categoria del plato</label>											
											<br>											
						    				<select id="catPlato" class="form-control">
						    					<option id="defaultCatPl" selected="selected" value="default">Selecciona una categoria</option>
						    					<?php for ($i=0 ; $i<count($categorias) ; $i++): ?>
						    						<option id="<?=$categorias[$i]["COD_CATEGORIA"]?>" value="<?=$categorias[$i]["COD_CATEGORIA"]?>"><?=$categorias[$i]["DESCRIPCION"]?></option>	
						    					<?php endfor ?>													
											</select>																						
						    			</div>	
						    			<div class="form-group">
											<label class="font-style-form" for="descplato">Descripcion del plato</label>    								    				
											<div class="row">										
												<div class="col-md-12">													
													<textarea class="form-control" id="descplato"></textarea>
												</div>												
											</div>						    				
						    			</div>	
						    			<div class="form-group">
						    				<div class="row">
												<div class="col-md-6">
							    					<label class="font-style-form" for="tiempoPre">Tiempo de preparacion</label>    								    				
													<div class="row">										
														<div class="col-md-12">
															<input type="number" class="form-control" id="tiempoPre" placeholder="0">
														</div>												
													</div>						    				
							    				</div>		
							    				<div class="col-md-6">
							    					<label class="font-style-form" for="unidadTiempo">Unidad de medida</label>											
													<br>											
								    				<select id="uniTimePl" class="form-control">								    					
								    					<option id="segundos" selected="selected" value="seg">Segundos</option>
								    					<option id="minutos" value="min">Minutos</option>
								    					<option id="horas" value="hor">Horas</option>
													</select>							    				
							    				</div>											
							    			</div>
						    			</div>								    			
						    			<div class="form-group">
						    				<div class="row">
						    					<div class="col-md-6">
							    					<label class="font-style-form" for="preNetPlato">Precio neto del plato</label>    								    				
													<div class="row">										
														<div class="col-md-12">
															<input type="number" class="form-control" id="preNetPlato" placeholder="0">
														</div>												
													</div>						    				
							    				</div>		
							    				<div class="col-md-6">
							    					<label class="font-style-form" for="precBruPlato">Precio bruto del plato (sin impuesto)</label>    								    				
													<div class="row">										
														<div class="col-md-12">
															<input type="number" class="form-control" id="precBruPlato" placeholder="0" disabled="disabled">
														</div>												
													</div>						    				
							    				</div>		
						    				</div>									
						    			</div>	
						 			</div>
						 			<hr>
						 			<div id="footContModal4">
						 				
						 			</div>						 			
								</div>
							</div>      						
    						<div class="modal-footer">
      							<button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarEditPlato">
    								<span class="glyphicon glyphicon-remove"></span>
                        			<span class="hidden-xs"> Cerrar</span> 
    							</button>         
    							<button type="button" class="btn btn-default" onclick="accionBtnEditPlato()" id="btnSavePlato">
    								<span class="glyphicon glyphicon-floppy-saved"></span>
                        			<span class="hidden-xs" > Guardar</span> 
    							</button> 
    						</div>
      						
    					</div>
  					</div>
				</div>
			
			<!--ELIMINAR CATEGORIA-->
				<div id="ModalContent5" class="modal fade" role="dialog" >
  					<div class="modal-dialog modal-lg">
    					<div class="modal-content">
      						<div class="modal-header text-center">
        						<h4 class="modal-tittle"><strong id="tituloModal5">ELIMINAR CATEGORIA</strong></h4>
      						</div>
							 <div class="modal-body">
						 		<div class="container-fluid" id="contenidoModal5">
						 			<div id="headContModal5">
						 				<h5>Selecciones la empresa a la que desea eliminar la categoria</h5>
						 			</div>
						 			<hr>
						 			<div id="bodyContModal5">	
						 				<table class="table table-striped">
						 					<thead>
						 						<tr>
						 							<th>Check</th>
						 							<th>NIT</th>
						 							<th>EMPRESA</th>
						 						</tr>
						 						<tbody>						 							
						 							<?php for ($i=0 ; $i<count($empresas['GEN_EMP_COD']) ; $i++): ?>
						 								<tr>
								    						<div class="form-check">
												 				<td>
												 					<input class="form-check-input" type="radio" name="opciones" value="<?=$empresas['GEN_EMP_COD'][$i]?>" checked>
												 				</td>
												 				<td>
												 					<?=$empresas['GEN_EMP_COD'][$i]?>
												 				</td>
												 				<td>
												 					<?=$empresas['GEN_EMP_NOM'][$i]?>
												 				</td>												 				
												 			</div>	
												 		</tr>
								    				<?php endfor ?>						 														 							
						 						</tbody>
						 					</thead>
						 				</table>						 				
						 			</div>
						 			<hr>
						 			<div id="footContModal5">
						 				
						 			</div>						 			
								</div>
							</div>      						
    						<div class="modal-footer">
      							<button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarDelCateg">
    								<span class="glyphicon glyphicon-remove"></span>
                        			<span class="hidden-xs"> Cerrar</span> 
    							</button>         
    							<button type="button" class="btn btn-default" onclick="accionBtnDelCateg()" id="btnDelCateg">
    								<span class="glyphicon glyphicon-trash"></span>
                        			<span class="hidden-xs"> Eliminar</span> 
    							</button> 
    						</div>
      						
    					</div>
  					</div>
				</div>

			<!--MODAL DE EDITAR CATEGORIA-->
				<div id="ModalContent6" class="modal fade" role="dialog" >
  					<div class="modal-dialog modal-lg">
    					<div class="modal-content">
      						<div class="modal-header text-center">
        						<h4 class="modal-tittle"><strong id="tituloModal6">EDITAR NOTAS</strong></h4>
      						</div>
							 <div class="modal-body">
						 		<div class="container-fluid" id="contenidoModal6">
						 			<div id="headContModal6">
						 				
						 			</div>
						 			<hr>
						 			<div id="bodyContModal6">
						 				<script type="text/javascript">
						 					console.log('<?php echo json_encode($platos)?>');
						 					console.log('<?php echo json_encode($codPlatos)?>');
						 				</script>	

										
										<div class="col-md-12">
											<label class="font-style-form" for="codOptionNewNote">Codigo plato o categoria</label>
											<input type="text" class="form-control" id="codOptionNewNote">
										</div>	

										<div class="col-md-12">
											<label class="font-style-form" for="optionNewNote">Plato o categoria para asignarle una nota</label>
											<input type="text" class="form-control" id="optionNewNote">
										</div>	
											
						 			</div>
						 			<hr>
						 			<div id="footContModal6">
						 				
						 			</div>						 			
								</div>
							</div>      						
    						<div class="modal-footer">
      							<button type="button" class="btn btn-default" data-dismiss="modal" id="cerrarEditNotas">
    								<span class="glyphicon glyphicon-remove"></span>
                        			<span class="hidden-xs"> Cerrar</span> 
    							</button>         
    							<button type="button" class="btn btn-default" id="btnSaveNotas">
    								<span class="glyphicon glyphicon-floppy-saved"></span>
                        			<span class="hidden-xs"> Guardar</span> 
    							</button> 
    						</div>
      						
    					</div>
  					</div>
				</div>
			</div>				
		<?php $this->endBody() ?>		

		
	</body>
</html>
<?= Html::cssFile('@web/css/dataTables.bootstrap4.css')?>
<?= Html::jsFile('@web/js/jquery.dataTables.js') ?>
<?= Html::jsFile('@web/js/dataTables.bootstrap4.js') ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	



<script type="text/javascript">
	$(document).ready(function(){      

        $("#dataTable2").dataTable({
        	responsive: true,	    	
        	scrollX: true,
        	scrollY: true,
        	scrollCollapse: true,
        	"language": {
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "zeroRecords": "Lo sentimos no hay nada para mostrar",
                    "info": "Pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "Registros no disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros)",
                    "paginate": {
                      "previous": "Previo",
                      "next": "Siguiente",
                    },
                    "search": "Buscar:"
                }
        });
        
        $("#dataTable4").dataTable({
        	responsive: true,	    	
        	scrollX: true,
        	scrollY: true,
        	scrollCollapse: true,
        	"language": {
                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
                    "zeroRecords": "Lo sentimos no hay nada para mostrar",
                    "info": "Pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "Registros no disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros)",
                    "paginate": {
                      "previous": "Previo",
                      "next": "Siguiente",
                    },
                    "search": "Buscar:"
                }
        });
       
    });
</script>


<script type="text/javascript">
	var rolIniciado = "<?=$rol?>";
	var movCategoria = "<?=$movcat?>";

	var nombreContainer1 = "<?=$nitcontainer1?>";
	var nombreContainer2 = "<?=$nitcontainer2?>";
	var nombreContainer3 = "<?=$nitcontainer3?>";
	var nombreContainer4 = "<?=$nitcontainer4?>";

	//carga inicial
	$(showForm('CAT'));
	$(checkCierre(0));	
	$(movimientoCategoria());

	function movimientoCategoria(){
		if(movCategoria == 1){
			$("#tab3Click").click();
		}
	}

	function showForm(form){
		switch(form){
			case 'CAT':
				$('#catForm').show();
				$('#plaForm').hide();	
				$('#notaForm').hide();
				break;
			case 'PLA':
				$('#catForm').hide();
				$('#plaForm').show();
				$('#notaForm').hide();
				break;
			case 'NTS':
				$('#catForm').hide();
				$('#plaForm').hide();
				$('#notaForm').show();
				break;
		}
	}

	function checkCierre(action){				
		switch(action){
			case 0:
				$("#confirmCierre").attr('onclick', 'checkCierre(1)');
				$("#btnCierre").prop("disabled",true);		
				$("#fecIniCierre").attr("disabled",false);
				$("#fecFinCierre").attr("disabled",false);
				$("#horaIniCierre").attr("disabled",false);
				$("#horaFinCierre").attr("disabled",false);				
				break;
			case 1:
				var fecha1 = $("#fecIniCierre").val();
				var fecha2 = $("#fecFinCierre").val();
				var time1 = $("#horaIniCierre").val();
				var time2 = $("#horaFinCierre").val();

				var tamano = fecha1.length * fecha2.length * time1.length * time2.length;

				if(tamano == 0){
					swal("Campos vacios","Compete los campos para generar el cierre","info");
					$("#confirmCierre").attr("checked",false);
				}
				else{
					var hora1 = time1.substring(0,2);
					var minuto1 = time1.substring(3,5);
					var hora2 = time2.substring(0,2);
					var minuto2 = time2.substring(3,5);

					var date1 = new Date(fecha1);
					date1.setHours(hora1);
					date1.setMinutes(minuto1);
					var date2 = new Date(fecha2);
					date2.setHours(hora2);
					date2.setMinutes(minuto2);					

					if(date1 > date2){
						swal("Fechas erroneas","La fecha inicial debe ser menor a la final","info");
						$("#confirmCierre").attr("checked",false);

						$("#fecIniCierre").attr("disabled",false);
						$("#fecFinCierre").attr("disabled",false);
						$("#horaIniCierre").attr("disabled",false);
						$("#horaFinCierre").attr("disabled",false);						
					}else{
						$("#fecIniCierre").attr("disabled",true);
						$("#fecFinCierre").attr("disabled",true);
						$("#horaIniCierre").attr("disabled",true);
						$("#horaFinCierre").attr("disabled",true);
						
						$("#confirmCierre").attr('onclick', 'checkCierre(0)');
						$("#btnCierre").prop("disabled",false);
					}
				}
				break;
		}
	}

	function salir(){
		if(rolIniciado.localeCompare("ADMINISTRADOR") == 0){
			var urlCerrar = "<?php echo Url::toRoute(['site/salida'])?>";
			location.href = urlCerrar;			
		}else{
			var urlPlaza = "<?php echo Url::toRoute(['site/plaza'])?>";
			location.href = urlPlaza;
		}
			
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$("#detailFacDoc").hide();

	function imprimirFactura(documento){
		$.ajax({
			url:'<?php echo Url::toRoute(['site/imprimirfactura']); ?>',
			dataType:'json',
			method: "GET",
			data: {
				'codigoFactura':documento,			
			}		
		});
	}
	
	function mostrarDetallesVentas(posicion){
		var codigoVenta = $("#histdoc"+posicion).html();
		var codigoEmp = $("#histnit"+posicion).html();
		var nomEmp = $("#histemp"+posicion).html();
		var subtotalFac = $("#histsub"+posicion).html();
		var propinaFac = $("#histpro"+posicion).html();
		var impuestoFac = $("#histimp"+posicion).html();
		var atencionFac = $("#histatn"+posicion).html();
		var valorFac = $("#histval"+posicion).html();

		if(codigoVenta.localeCompare("N/A") != 0){
			$('#ModalContent').modal('show');
			actionDetalleFac(0);
			//$("#tituloModal").html("DETALLE DOCUMENTO");

			/*******************************************/			
			/*CABECERA DEL DETALLE*/
			var tableCabecera = 
				'<table>'+
					'<tbody>'+
						'<tr>'+
							'<td><strong>'+nomEmp+'</strong></td>'+
						'</tr>'+
						'<tr>'+
							'<td><strong>NIT '+codigoEmp+'</strong></td>'+
						'</tr>'+
						'<tr>'+
							'<td><strong>DOC-'+codigoVenta+'</strong></td>'+
						'</tr>'+
					'</tbody>'+
				'</table>';		

			$("#headContModal").html(tableCabecera);
			$("#impFacBtn").attr("onclick","imprimirFactura("+codigoVenta+")");

			/*******************************************/
			/*DETALLE DE PLATOS*/
			$("#dataTable4").dataTable({
				responsive: true,	    	
	        	scrollX: true,
	        	scrollY: true,
	        	scrollCollapse: true,	
				"destroy":true,
		    	"ajax":{
		    		"url":"<?php echo Url::toRoute(['site/detalledocumentos']); ?>",
		    		"method":"GET",
		    		"data":{		    			
		    			"documento":codigoVenta
		    		}
		    	},
		    	"language": {
		                "lengthMenu": "Mostrar _MENU_ registros por pagina",
		                "zeroRecords": "Lo sentimos no hay nada para mostrar",
		                "info": "Pagina _PAGE_ de _PAGES_",
		                "infoEmpty": "Registros no disponibles",
		                "infoFiltered": "(filtrado de _MAX_ registros)",
		                "paginate": {
		                  "previous": "Previo",
		                  "next": "Siguiente",
		                },
		                "search": "Buscar:"
		            }
		    });	

			/*******************************************/
			/*ATENCIONES*/
		    $("#tableDetAtencion").dataTable({	
		    	responsive: true,	    	
	        	scrollX: true,
	        	scrollY: true,
	        	scrollCollapse: true,
				"destroy":true,
		    	"ajax":{
		    		"url":"<?php echo Url::toRoute(['site/detalleatencion']); ?>",
		    		"method":"GET",
		    		"data":{		    			
		    			"documento":codigoVenta
		    		}
		    	},
		    	"language": {
		                "lengthMenu": "Mostrar _MENU_ registros por pagina",
		                "zeroRecords": "Lo sentimos no hay nada para mostrar",
		                "info": "Pagina _PAGE_ de _PAGES_",
		                "infoEmpty": "Registros no disponibles",
		                "infoFiltered": "(filtrado de _MAX_ registros)",
		                "paginate": {
		                  "previous": "Previo",
		                  "next": "Siguiente",
		                },
		                "search": "Buscar:"
		            }
		    });	

		    /*******************************************/
			/*VALORES POR EMPRESA*/
		   	$("#tableDetailFac").dataTable({	
		   		responsive: true,	    	
		    	scrollX: true,
		    	scrollY: true,
		    	scrollCollapse: true,
				"destroy":true,
		    	"ajax":{
		    		"url":"<?php echo Url::toRoute(['site/detallexempresa']); ?>",
		    		"method":"GET",
		    		"data":{		    			
		    			"documento":codigoVenta
		    		}
		    	},
		    	"language": {
		                "lengthMenu": "Mostrar _MENU_ registros por pagina",
		                "zeroRecords": "Lo sentimos no hay nada para mostrar",
		                "info": "Pagina _PAGE_ de _PAGES_",
		                "infoEmpty": "Registros no disponibles",
		                "infoFiltered": "(filtrado de _MAX_ registros)",
		                "paginate": {
		                  "previous": "Previo",
		                  "next": "Siguiente",
		                },
		                "search": "Buscar:"
		            }
		    });	

			/*******************************************/
			/*TOTALES*/
		    $("#idDocDetSub").html("$"+subtotalFac);
			$("#idDocDetPro").html("$"+propinaFac);
			$("#idDocDetImp").html("$"+impuestoFac);
			$("#idDocDetAtn").html("$"+atencionFac);
			$("#idDocDetTot").html("<strong style='color:white;'>$"+valorFac+"</strong>");
			
		}
	}

	function actionDetalleFac(action){	
		
		if(action == 1){
			$("#detailFacDoc").show();
			$("#detalleFacBtn").attr("onclick","actionDetalleFac(0)");
			$("#detalleFacBtn").html("<i class='material-icons'>expand_less</i> detalle");
		}else{			
			$("#detailFacDoc").hide();
			$("#detalleFacBtn").attr("onclick","actionDetalleFac(1)");
			$("#detalleFacBtn").html("<i class='material-icons'>expand_more</i> detalle");
		}
			
	}

	$("#fechaHist").change(function(){
		fecha = formato(this.value);	

		$("#dataTable2").dataTable({				
			"destroy":true,
	    	"ajax":{
	    		"url":"<?php echo Url::toRoute(['site/documentos']); ?>",
	    		"method":"GET",
	    		"data":{
	    			"fechaHist":fecha
	    		}
	    	},
	    	responsive: true,	    	
        	scrollX: true,
        	scrollY: true,
        	scrollCollapse: true,
	    	"language": {
	                "lengthMenu": "Mostrar _MENU_ registros por pagina",
	                "zeroRecords": "Lo sentimos no hay nada para mostrar",
	                "info": "Pagina _PAGE_ de _PAGES_",
	                "infoEmpty": "Registros no disponibles",
	                "infoFiltered": "(filtrado de _MAX_ registros)",
	                "paginate": {
	                  "previous": "Previo",
	                  "next": "Siguiente",
	                },
	                "search": "Buscar:"
	            }
	    });	
	});

	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$(cargarCierres());

	function cargarCierres(){
		$("#dataTable3").dataTable({				
			responsive: true,	    	
        	scrollX: true,
        	scrollY: true,
        	scrollCollapse: true,
			"destroy":true,
	    	"ajax":{
	    		"url":"<?php echo Url::toRoute(['site/cierres']); ?>"    		
	    	},
	    	"language": {
	                "lengthMenu": "Mostrar _MENU_ registros por pagina",
	                "zeroRecords": "Lo sentimos no hay nada para mostrar",
	                "info": "Pagina _PAGE_ de _PAGES_",
	                "infoEmpty": "Registros no disponibles",
	                "infoFiltered": "(filtrado de _MAX_ registros)",
	                "paginate": {
	                  "previous": "Previo",
	                  "next": "Siguiente",
	                },
	                "search": "Buscar:"
	            }
	    });	
	}
	
	function mostrarDetalleCierre(posicion){
		$('#ModalContent2').modal('show');
		$("#tituloModal2").html("DETALLE DE CIERRE");

		var codigoCierre = $("#cierreId"+posicion).html();
		
		$.ajax({
			url:'<?php echo Url::toRoute(['site/detallecierres']); ?>',
			dataType:'json',
			method: "GET",
			data: {'codigo':codigoCierre,"opcion":1},
			success: function (data) {						
				//cantidad de datos que contiene cada array del json	
				//var tamano = Object.keys(data.MESCODUNI).length;			
				//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
				var arrayDatos = $.map(data, function(value, index) {
	    			return [value];
				});	
				
				var impuestos = arrayDatos[0];
				var subTotal = arrayDatos[1];
				var propinaVol = arrayDatos[2];
				var descuentos = arrayDatos[3];
				var totalNeto = arrayDatos[4];				

				$('#subtotalCierre').html(formatoMoneda(subTotal));
				$('#propinaCierre').html(formatoMoneda(propinaVol));
				$('#impuestosCierre').html(formatoMoneda(impuestos));
				$('#descuentosCierre').html(formatoMoneda(descuentos));
				$('#netoCierre').html(formatoMoneda(totalNeto));				
			}
		});	


		$("#dataTable5").dataTable({				
			"destroy":true,
	    	"ajax":{
	    		"url":"<?php echo Url::toRoute(['site/detallecierres']); ?>",
	    		"method":"GET",
	    		"data":{
	    			"codigo":codigoCierre,
					"opcion":2
	    		}
	    	},
	    	responsive: true,	    	
        	scrollX: true,
        	scrollY: true,
        	scrollCollapse: true,
	    	"language": {
	                "lengthMenu": "Mostrar _MENU_ registros por pagina",
	                "zeroRecords": "Lo sentimos no hay nada para mostrar",
	                "info": "Pagina _PAGE_ de _PAGES_",
	                "infoEmpty": "Registros no disponibles",
	                "infoFiltered": "(filtrado de _MAX_ registros)",
	                "paginate": {
	                  "previous": "Previo",
	                  "next": "Siguiente",
	                },
	                "search": "Buscar:"
	            }
	    });	


	}

	function realizarCierre(){
		var fechaInicioCierre = formato($("#fecIniCierre").val());
		var horaInicioCierre = $("#horaIniCierre").val()+":00";
		var fechaFinCierre = formato($("#fecFinCierre").val());
		var horaFinCierre = $("#horaFinCierre").val()+":00";

		var tamano = fechaInicioCierre.length * horaInicioCierre.length * fechaFinCierre.length * horaFinCierre.length;

		if(tamano == 0){
			swal("Campos vacíos","Llene los campos faltantes para realizar el cierre","info");
		}else{						

			$.ajax({
				url:'<?php echo Url::toRoute(['site/realizacierre']); ?>',
				method: "GET",
				data: {'fechaIni':fechaInicioCierre,'horaIni':horaInicioCierre,'fechaFin':fechaFinCierre,'horaFin':horaFinCierre},			
				success: function (data) {	
					var mensajes = JSON.parse(data);

					if(mensajes[0].localeCompare("1") == 0){
						swal("Cierre completado", "El detalle del cierre se encuentra en el historial con codigo "+mensajes[1], "success");
						cargarCierres();
					}else{
						swal("Fechas repetidas","Las fechas ingresadas están en rango de cierres ya realizados. Verifica en el historial que las fechas seleccionadas no estén dentro del rango de otros cierres.","info");
					}

					
				}
			});
		}			

	}

	$("#fecIniCierre").change(function(){
		var date = new Date();

		if(date.getMonth() < 10){
			var fechaLimite = date.getFullYear()+"-0"+(date.getMonth()+1)+"-"+date.getDate();
		}else{
			var fechaLimite = date.getFullYear()+"-"+(date.getMonth()+1)+"-"+date.getDate();
		}
		
		var fechaIngresda = this.value;
		//fecha minima de fin de cierre
		$("#fecFinCierre").val(fechaIngresda);
		$("#fecFinCierre").attr("min",fechaIngresda);
		$("#fecFinCierre").attr("max",fechaLimite);
		$("#fecFinCierre").attr("disabled",false);
		//hora minima de inicio de cierre
		$("#horaIniCierre").attr("disabled",false);
		$("#horaIniCierre").val("00:00");

		//hora minima de inicio de cierre
		$("#horaFinCierre").attr("disabled",false);
		$("#horaFinCierre").val("23:59");
	});


	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$(cargarMenus());
	$(cargarPlatos());
	$(cargarNotas());

	function cargarMenus(){
		$("#dataTable6").dataTable({				
			"destroy":true,
	    	"ajax":{
	    		"url":"<?php echo Url::toRoute(['site/adminmenus']); ?>",
	    		"method":"GET",
	    		"data":{
					"opcion":1
	    		}
	    	},
	    	responsive: true,
	    	"language": {
	                "lengthMenu": "Mostrar _MENU_ registros por pagina",
	                "zeroRecords": "Lo sentimos no hay nada para mostrar",
	                "info": "Pagina _PAGE_ de _PAGES_",
	                "infoEmpty": "Registros no disponibles",
	                "infoFiltered": "(filtrado de _MAX_ registros)",
	                "paginate": {
	                  "previous": "Previo",
	                  "next": "Siguiente",
	                },
	                "search": "Buscar:"
	            }
	    });	
	}

	function editarCategoria(codigo){
		// id del tag 
		var idTag = "#categoriaId"+codigo;
		// codigo de la categoria seleccionado
		var codigoCategoria = $(idTag).html();

		switch(codigo){
			case 'nuevo':
				// cambia el titulo del modal
				$("#tituloModal3").html("NUEVA CATEGORIA");
				//se limpian el formulario
				$("#nomCategoria").val("");				
				$("#imgEditCat").hide();				
				$("option[value='default']").prop('selected', function() {
			        return this.defaultSelected;
			    });
			    //se cambia la accion del boton 
			    $("#btnSaveCateg").attr('onclick', 'accionBtnEditCateg("NEW")');
			    //se muestra el formulario
				$("#empreNewCat").show();
				$("#codigoCategoria").hide();
				break;
			default:
				$("#tituloModal3").html("EDITAR CATEGORIA");
				//codigo de la categoria
				var codigoCategoria = $("#categoriaId"+codigo).html();
				//
				$("#codCategoria").val(codigoCategoria);
				// nombre de la categoria seleccionada
				var nombreCategoria = $("#nombreCatId"+codigo).html();
				//se imprime el nombre
				$("#nomCategoria").val(nombreCategoria);
				// imagen que posee la categoria
				var rutaImgCategoria = $("#imgCat"+codigo).attr("src");				
				//
				$("#imgEditCat").attr("src",rutaImgCategoria);
				$("#imgEditCat").show();
				//nombre de la categoria
				var nomImgCategoria = rutaImgCategoria.substring(rutaImgCategoria.indexOf("/")+1); // quita el primer /	
				nomImgCategoria = nomImgCategoria.substring(nomImgCategoria.indexOf("/")+1); // quita el segundo /
				nomImgCategoria = nomImgCategoria.substring(0,nomImgCategoria.indexOf(".")); // quia el .png
				//se selecciona la imagen
				$("option[value='"+nomImgCategoria+"']").attr('selected','selected');		
				//
				$("#btnSaveCateg").attr('onclick', 'accionBtnEditCateg("EDIT")');		
				//se muestra e formulario				
				$("#empreNewCat").hide();
				$("#codigoCategoria").show();
				break;
		}

		$('#ModalContent3').modal('show');
	}

	$("#imgCategoria").change(function(){
		if(this.value.localeCompare("default") == 0){
			$("#imgEditCat").hide();
		}else{
			var imagenNew = 'img/categorias/'+this.value+'.png';
			$("#imgEditCat").show();
			$("#imgEditCat").attr("src",imagenNew);
		}			
	});

	function eliminarCategoria(codigo){		

		$("#ModalContent5").modal('show');
		$("#btnDelCateg").attr("onclick","accionBtnDelCateg("+codigo+")");

	}

	function cargarPlatos(){
		$("#dataTable7").dataTable({				
			"destroy":true,
	    	"ajax":{
	    		"url":"<?php echo Url::toRoute(['site/adminmenus']); ?>",
	    		"method":"GET",
	    		"data":{
					"opcion":2
	    		}
	    	},	    	
	    	responsive: true,	    	
        	scrollX: true,
        	scrollY: true,
        	scrollCollapse: true,
	    	"language": {
	                "lengthMenu": "Mostrar _MENU_ registros por pagina",
	                "zeroRecords": "Lo sentimos no hay nada para mostrar",
	                "info": "Pagina _PAGE_ de _PAGES_",
	                "infoEmpty": "Registros no disponibles",
	                "infoFiltered": "(filtrado de _MAX_ registros)",
	                "paginate": {
	                  "previous": "Previo",
	                  "next": "Siguiente",
	                },
	                "search": "Buscar:"
	            }
	    });	

		
	}


	function editarPlato(codigo){
		// id del tag 
		var idTag = "#platoId"+codigo;
		// codigo de la categoria seleccionado
		var codigoPlato = $(idTag).html();

		switch(codigo){
			case 'nuevo':
				// cambia el titulo del modal
				$("#tituloModal4").html("NUEVO PLATO");
				//se limpian el formulario
				$("#nomCategoria").val("");
				$("option[value='default']").prop('selected', function() {
			        return this.defaultSelected;
			    });
			    $("#btnSavePlato").attr('onclick', 'accionBtnEditPlato("NEW")');
				$("#nomPlato").val("");
				$("#tiempoPre").val("");				
				$("#preNetPlato").val("");
				$("#precBruPlato").val("");			
				$("#descplato").val("")	;
				$("#labelcodPlato").hide();
				$("#codPlato").hide();
				break;
			default:				
				$("#tituloModal4").html("EDITAR PLATO");
				$("#labelcodPlato").show();
				$("#codPlato").show();				
				//Empresa a la que pertenece el plato
				var empresaPlato = $("#nitEmpPlatoId"+codigo).html();
				//se selecciona la imagen
				$("option[value='"+empresaPlato+"']").attr('selected','selected');

				// nombre de la categoria seleccionada
				var codigoePlato = $("#platoId"+codigo).html();
				//se imprime el nombre
				$("#codPlato").val(codigoePlato);

				// nombre de la categoria seleccionada
				var nombrePlato = $("#nombrePlaId"+codigo).html();
				//se imprime el nombre
				$("#nomPlato").val(nombrePlato);

				//categoria a la que pertence el plato
				var categoriaPlato = $("#codigoCatPlId"+codigo).html();
				//se muestra la categoria 
				$("option[value="+categoriaPlato+"]").attr('selected','selected');

				// descripcion del plato
				var descripPlato = $("#descPlatoId"+codigo).html();
				//se imprime la descripcion
				$("#descplato").val(descripPlato);

				// tiempo del plato
				var tiempoPlato = $("#tiempoPlaId"+codigo).html();
				//tiempo del plato
				$("#tiempoPre").val(tiempoPlato);				
				//se selecciona la imagen
				$("option[value=min]").attr('selected','selected');

				//precio del plato neto 
				var precioNetoPlato = $("#precioFullId"+codigo).html();				
				precioNetoPlato = precioNetoPlato.replace(",","");
				//imprimo el precio
				$("#preNetPlato").val(parseFloat(precioNetoPlato)); 

				//precio del plato bruto 
				var precioBrutoPlato = $("#precioId"+codigo).html();
				precioBrutoPlato = precioBrutoPlato.replace(",","");
				//imprimo el precio
				$("#precBruPlato").val(parseFloat(precioBrutoPlato));
				
				$("#btnSavePlato").attr('onclick', 'accionBtnEditPlato("EDIT")');
				break;
		}

		$('#ModalContent4').modal('show');
	}

	function eliminarPlato(codigo){

		var nombrePlato = $("#nombrePlaId"+codigo).html();

		swal({
			title: 'Seguro desea eliminar el plato '+nombrePlato,
			text: '',
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

	  			var idPlato = $("#platoId"+codigo).html();
	  			var empresaPlato = $("#nitEmpPlatoId"+codigo).html();
	  			
				$.ajax({
					url:'<?php echo Url::toRoute(['site/funcionesplatos']); ?>',							
					method: "GET",
					data: {'opcion':'DELET','plato':idPlato,'empresa':empresaPlato},
					success: function (data) {	
						
						if(data.localeCompare("ok") == 0){
							$("#cerrarDelCateg").click();
							cargarPlatos();
							swal("Eliminado","El plato ha sido eliminada correctamente ","success");
						}
					},
					error: function (error){
						swal("Error al eliminar","Vuelve a intentarlo o comunica con el administrador","error");
					}
				});			
	  		}
		  		
		});
	}

	function cargarNotas(){
		$("#dataTable9").dataTable({				
			"destroy":true,
	    	"ajax":{
	    		"url":"<?php echo Url::toRoute(['site/notasadmin']); ?>",
	    		"method":"GET",
	    		"data":{
					"opcion":2
	    		}
	    	},	    	
	    	responsive: true,	    	
        	scrollX: true,
        	scrollY: true,
        	scrollCollapse: true,
	    	"language": {
	                "lengthMenu": "Mostrar _MENU_ registros por pagina",
	                "zeroRecords": "Lo sentimos no hay nada para mostrar",
	                "info": "Pagina _PAGE_ de _PAGES_",
	                "infoEmpty": "Registros no disponibles",
	                "infoFiltered": "(filtrado de _MAX_ registros)",
	                "paginate": {
	                  "previous": "Previo",
	                  "next": "Siguiente",
	                },
	                "search": "Buscar:"
	            }
	    });	
	}

	function editarNota(codigo){
		// id del tag 
		var idTag = "#platoId"+codigo;
		// codigo de la categoria seleccionado
		var codigoPlato = $(idTag).html();

		switch(codigo){
			case 'nuevo':
				
				break;
			default:				
				
				break;
		}

		$('#ModalContent6').modal('show');
	}


	$(document).ready(function(){

		var arrayPhpNotas1 = new Array();
		var arrayPhpNotas2 = new Array();

		arrayPhpNotas1 = '<?php echo json_encode($platos)?>';
		arrayPhpNotas2 = '<?php echo json_encode($codPlatos)?>';

		var opcionCodNotanueva = JSON.parse(arrayPhpNotas1);
		var opcionNotanueva = JSON.parse(arrayPhpNotas2);

		$("#optionNewNote").autocomplete({
	  		source: opcionCodNotanueva,
	  		select: function (e, ui) {		       
		        var value = ui.item.value;		        
		        for (var i=0 ; i<opcionNotanueva.length ; i++){			        	
					if(value.localeCompare(opcionCodNotanueva[i]) == 0){
						$("#codOptionNewNote").focusin();
						$("#codOptionNewNote").val(opcionNotanueva[i]);
					}
				}	
			}
		});		
	});	

	function accionBtnEditCateg(action){				
		//accion correspondiente
		switch(action){
			case 'EDIT':
				//captura de datos
				var codigoCategoria = $("#codCategoria").val();
				if(codigoCategoria.localeCompare("default") == 0){
					codigoCategoria = "";
				}
				var editNameCat = $("#nomCategoria").val();
				var editImageCat = $("#imgCategoria").val()+".png";
				if(editImageCat.localeCompare("default.png") == 0){
					editImageCat = "";
				}
				// identificar que no hay datos nulos
				var tamano = codigoCategoria.length * editNameCat.length * editImageCat.length;

				if(tamano == 0){
					swal("Campos vacíos","Por favor complete los campos faltantes","error");
				}else{
					$.ajax({
						url:'<?php echo Url::toRoute(['site/funcionescategorias']); ?>',							
						method: "GET",
						data: {'opcion':'EDIT','codigo':codigoCategoria,'nombre':editNameCat,'imagen':editImageCat},
						success: function (data) {	

							if(data.localeCompare("ok") == 0){
								$("#cerrarEditCateg").click();
								cargarMenus();
								swal("Editada","La categoría '"+editNameCat+"' ha sido editada correctamente ","success");
								$(".confirm").click(function(){
									window.location.href = window.location.href + "&movcat=true";
								});
							}
						},
						error: function (error){
							swal("Error al editar","Vuelve a intentarlo o comunica con el administrador","error");
						}
					});	
				}
				break;

			case 'NEW':
				//captura los datos
				var newCodEmpCat = $("#empCategoria").val();
				if(newCodEmpCat.localeCompare("default") == 0){
					newCodEmpCat = "";
				}
				var newNameCat = $("#nomCategoria").val();
				var newImgCat = $("#imgCategoria").val()+".png";
				if(newCodEmpCat.localeCompare("default.png") == 0){
					newCodEmpCat = "";
				}
				// identificar que no hay datos nulos
				var tamano = newCodEmpCat.length * newNameCat.length * newImgCat.length;

				if(tamano == 0){
					swal("Campos vacíos","Por favor complete los campos faltantes","error");					
				}else{
					$.ajax({
						url:'<?php echo Url::toRoute(['site/funcionescategorias']); ?>',							
						method: "GET",
						data: {'opcion':'NEW','nombre':newNameCat,'empresa':newCodEmpCat,'imagen':newImgCat},
						success: function (data) {	

							if(data.localeCompare("ok") == 0){
								$("#cerrarEditCateg").click();
								cargarMenus();
								swal("Creada","La categoría '"+newNameCat+"' ha sido creada correctamente ","success");
								$(".confirm").click(function(){
									window.location.href = window.location.href + "&movcat=true";
								});
							}
						},
						error: function (error){
							swal("Error al guardar","Vuelve a intentarlo o comunica con el administrador","error");
						}
					});	
				}
				break;
			default:
				console.log("default");
				break;
		}
	}

	function accionBtnDelCateg(codigo){
		var idTag = "#categoriaId"+codigo;
		var codigoCategoria = $(idTag).html();		
		var empresaCategoria = $('input[name=opciones]:checked').val(); 

		$.ajax({
			url:'<?php echo Url::toRoute(['site/funcionescategorias']); ?>',							
			method: "GET",
			data: {'opcion':'DELET','categoria':codigoCategoria,'empresa':empresaCategoria},
			success: function (data) {	
				
				if(data.localeCompare("ok") == 0){
					$("#cerrarDelCateg").click();
					cargarMenus();
					swal("Eliminada","La categoría ha sido eliminada correctamente ","success");
				}
			},
			error: function (error){
				swal("Error al eliminar","Vuelve a intentarlo o comunica con el administrador","error");
			}
		});			
		
	}

	function accionBtnEditPlato(action){
		// captura los datos de las empresas
		var empresaPlato = $("#empPlato").val();
		if(empresaPlato.localeCompare("default") == 0){
			empresaPlato = "";
		}
		//nombre de pato asginado
		var nombrePlato = $("#nomPlato").val();
		if(nombrePlato.localeCompare("default") == 0){
			nombrePlato = "";
		}
		//categoria asignada
		var catePlato = $("#catPlato").val();
		if(catePlato.localeCompare("default") == 0){
			catePlato = "";
		}

		//descripcion del plato
		var descPlato = $("#descplato").val();
		if(descPlato.localeCompare("default") == 0){
			descPlato = "";
		}

		//tiempo asignado
		var tiempoPlato = $("#tiempoPre").val();
		if(tiempoPlato.localeCompare("default") == 0){
			tiempoPlato = "";
		}
		//unidad de tiempo señalado
		var unidadTiempoPl = $("#uniTimePl").val();
		if(unidadTiempoPl.localeCompare("default") == 0){
			unidadTiempoPl = "";
		}
		//precio del plato
		var precioPlato = $("#preNetPlato").val();
		if(precioPlato.localeCompare("default") == 0){
			precioPlato = "";
		}
		// identificar que no hay datos nulos
		var tamano = empresaPlato.length * nombrePlato.length * catePlato.length * tiempoPlato.length * unidadTiempoPl.length * precioPlato.length * descPlato.length;

		if(tamano == 0){
			swal("Campos vacíos","Por favor complete los campos faltantes","error");
		}else{
			// accion 
			switch(action){
				case 'EDIT':
					var codigoPlato = $("#codPlato").val();

					$.ajax({
						url:'<?php echo Url::toRoute(['site/funcionesplatos']); ?>',							
						method: "GET",
						data: {'opcion':'EDIT','codigo':codigoPlato,'nombre':nombrePlato,'precio':precioPlato,'categoria':catePlato,'descripcion':descPlato,'tiempo':tiempoPlato,'empresa':empresaPlato,'unidadT':unidadTiempoPl},
						success: function (data) {	

							if(data.localeCompare("ok") == 0){
								$("#cerrarEditPlato").click();
								cargarPlatos();
								swal("Editado","El plato '"+nombrePlato+"' ha sido editado correctamente ","success");								
							}
						},
						error: function (error){
							swal("Error al editar","Vuelve a intentarlo o comunica con el administrador","error");
						}
					});		
					break;
				case 'NEW':	
					$.ajax({
						url:'<?php echo Url::toRoute(['site/funcionesplatos']); ?>',							
						method: "GET",
						data: {'opcion':'NEW','empresa':empresaPlato,'nombre':nombrePlato,'categoria':catePlato,'tiempo':tiempoPlato,'unidadT':unidadTiempoPl,'precio':precioPlato,'desc':descPlato},
						success: function (data) {	

							if(data.localeCompare("ok") == 0){
								$("#cerrarEditPlato").click();
								cargarPlatos();
								swal("Creada","El plato '"+nombrePlato+"' ha sido creada correctamente ","success");								
							}
						},
						error: function (error){
							swal("Error al guardar","Vuelve a intentarlo o comunica con el administrador","error");
						}
					});			

					break;
			}
		}			
		console.log(empresaPlato+", "+nombrePlato+", "+catePlato+", "+tiempoPlato+", "+unidadTiempoPl+", "+precioPlato+", "+descPlato);
	}	

	// CALCULAR EL VALOR SIN IMPUESTO
	var typingTimer;                //timer identifier
	var doneTypingInterval = 1000;  //time in ms, 5 second for example
	var $input = $('#preNetPlato');

	//on keyup, start the countdown
	$("#preNetPlato").on('keyup', function () {
		clearTimeout(typingTimer);
		typingTimer = setTimeout(doneTyping, doneTypingInterval);
	});

	//on keydown, clear the countdown 
	$("#preNetPlato").on('keydown', function () {
		clearTimeout(typingTimer);
	});

	//user is "finished typing," do something
	function doneTyping () {
		var valorPlato = $("#preNetPlato").val();
		var precioBruto = parseFloat(valorPlato / 1.08).toFixed(2);;
		
		$("#precBruPlato").val(precioBruto);
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/*var dateNow = new Date();
	var today = dateNow.getDate()+"/"+(dateNow.getMonth()+1)+"/"+dateNow.getFullYear();*/	
	if(rolIniciado.localeCompare("ADMINISTRADOR") != 0){		
		//activacion de tab
		$("#tab1").removeClass("active");
		$("#tab3").addClass("active");
		//ejecuta la consulta de la cuentas
		$(consultaCuenta());	
		setInterval(consultaCuenta, 5000);
		//
		$("#btnSalida").html("volver");
	}else{
		$(consultaCuenta());	
		setInterval(consultaCuenta, 5000);
	}
	
	$("#fechaCuenta").change(function(){
		var fecha = formato(this.value);	

		consultaCuenta();
	});

	function consultaCuenta(){	

		var fecha = formato(document.getElementById("fechaCuenta").value);		

		$.ajax({
			url:'<?php echo Url::toRoute(['site/detalleempresa']); ?>',	
			dataType:'json',								
			method: "GET",
			data: {'fecha':fecha},
			success: function (data) {	
				//un arrray contiene en arrays de cada columna devuelta por el json (consulta hecha a base de datos)
				var arrayDatos = $.map(data, function(value, index) {
	    			return [value];
				});					

				var detalleEmp = arrayDatos[0];				
				var totales = arrayDatos[1];	
				var acumuMes = arrayDatos[2];				
				var acumuAno = arrayDatos[3];
				var acumuSem = arrayDatos[4];

				var detalleTable = '';				

				for (var i=0 ; i<detalleEmp['NIT'].length; i++) {
					detalleTable = detalleTable +
						'<tr>'+														
							'<td>'+detalleEmp['EMPRESA'][i]+'</td>'+
							'<td class="centerTbody">$'+formatoMoneda(detalleEmp['TOTAL'][i])+'</td>'+
							'<td class="centerTbody">'+detalleEmp['PORC_DIA'][i]+'%</td>'+
							'<td class="centerTbody">$'+formatoMoneda(acumuSem['ACUM_SEMA'][i])+'</td>'+
							'<td class="centerTbody">'+acumuSem['PORC_SEMA'][i]+'%</td>'+
							'<td class="centerTbody">$'+formatoMoneda(acumuMes['ACUM_MES'][i])+'</td>'+
							'<td class="centerTbody">'+acumuMes['PORC_MES'][i]+'%</td>'+
							'<td class="centerTbody">$'+formatoMoneda(acumuAno['ACUM_YEAR'][i])+'</td>'+							
							'<td class="centerTbody">'+acumuAno['PORC_YEAR'][i]+'%</td>'+
							'<td class="centerTbody">$'+formatoMoneda(detalleEmp['SUBTOTAL'][i])+'</td>'+
							'<td class="centerTbody">$'+formatoMoneda(detalleEmp['IMPUESTOS'][i])+'</td>'+
							'<td class="centerTbody">$'+formatoMoneda(detalleEmp['ATENCIONES'][i])+'</td>'+							
						'</tr>';					
				}				

				detalleTable = detalleTable +
					'<tr>'+														
						'<th>TOTALES</th>'+
						'<th class="centerTbody">$'+formatoMoneda(totales['VALOR'][0])+'</th>'+
						'<th class="centerTbody">100%</th>'+
						'<th class="centerTbody">$'+formatoMoneda(detalleEmp['TOTAL_SEMA'][0])+'</th>'+
						'<th class="centerTbody">100%</th>'+
						'<th class="centerTbody">$'+formatoMoneda(detalleEmp['TOTAL_MES'][0])+'</th>'+
						'<th class="centerTbody">100%</th>'+
						'<th class="centerTbody">$'+formatoMoneda(detalleEmp['TOTAL_YEAR'][0])+'</th>'+						
						'<th class="centerTbody">100%</th>'+
						'<th class="centerTbody">$'+formatoMoneda(totales['SUBTOTAL'][0])+'</th>'+
						'<th class="centerTbody">$'+formatoMoneda(totales['IMPUESTO'][0])+'</th>'+
						'<th class="centerTbody">$'+formatoMoneda(totales['ATENCIONES'][0])+'</th>'+							
					'</tr>';	

				
				//totales['PROPINA'][0]
				$("#bodyCuenta1").html(detalleTable);					

				/*$("#dataTable8").dataTable({
		        	responsive: true,	    	
		        	scrollX: true,
		        	scrollY: true,
		        	scrollCollapse: true,
		        	"destroy":true,
		        	"language": {
		                    "lengthMenu": "Mostrar _MENU_ registros por pagina",
		                    "zeroRecords": "Lo sentimos no hay nada para mostrar",
		                    "info": "Pagina _PAGE_ de _PAGES_",
		                    "infoEmpty": "Registros no disponibles",
		                    "infoFiltered": "(filtrado de _MAX_ registros)",
		                    "paginate": {
		                      "previous": "Previo",
		                      "next": "Siguiente",
		                    },
		                    "search": "Buscar:"
		                },
		            "bLengthChange" : false, 
		            "bPaginate": false,
		            "bFilter": false,
		            "bInfo":false

		        });*/
				

			}
		});	
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$(document).ready(function(){

		var arrayPhp1 = new Array();
		var arrayPhp2 = new Array();

		arrayPhp1 = '<?php echo json_encode($platos)?>';
		arrayPhp2 = '<?php echo json_encode($codPlatos)?>';

		var platosFactura = JSON.parse(arrayPhp1);
		var codPlatosFactura = JSON.parse(arrayPhp2);

		$("#platosFactura").autocomplete({
	  		source: platosFactura,
	  		select: function (e, ui) {		       
		        var value = ui.item.value;		        
		        for (var i=0 ; i<codPlatosFactura.length ; i++){			        	
					if(value.localeCompare(platosFactura[i]) == 0){
						$("#codPlatosFactura").focusin();
						$("#codPlatosFactura").val(codPlatosFactura[i]);
					}
				}	
			}
		});		
	});	

	var rowCont = 0;

	function anadirPlato(){
		var codigo = $("#codPlatosFactura").val();
		var nombre = $("#platosFactura").val();
		var cantidad = $("#cantidadPlato").val();

		var tamano = codigo.length * nombre.length * cantidad.length;

		if(tamano == 0){
			swal("Campos vacíos","Llene los campos para agregar al pedido","info");
		}else{
			$("#tablePedido").append('<tr id="row'+rowCont+'"><td class="codigoPlatoRow">'+codigo+'</td><td>'+nombre+'</td><td class="cantidadPlatoRow">'+cantidad+'</td><td><i class="material-icons deleteIcon btn-link" onclick="quitarRow('+rowCont+')">close</i></td></tr>').addClass("filaPlatosFactura");

			rowCont++;

			$("#codPlatosFactura").val("");
			$("#platosFactura").val("");
			$("#cantidadPlato").val("1");
		}			
	}

	function quitarRow(id){
		$("#row"+id).remove();		
	}

	$("#autorizacionContent").hide();

	$("#formaPagos").change(function(event) {
		if(this.value.localeCompare("02") == 0 || this.value.localeCompare("03") == 0){
			$("#autorizacionContent").show();
			$("#numAutorizacion").show();			
		}else{
			$("#autorizacionContent").hide();
			$("#numAutorizacion").hide();			
		}
	});
	
	function visualizaFactura(){
		// fecha de proceso
		var fechaFacturacion = $("#fechaFactura").val();
		fechaFacturacion = formato(fechaFacturacion);
		// hora de procesor
		var horaFacturacion = $("#horaFactura").val();
		// codigos de los platos 
		var platosFacturacion = new Array();
		//
		var puestosFacturacion = new Array();
		var terminosFacturacion = new Array();

		$(".codigoPlatoRow").each(function(){
			platosFacturacion.push($(this).html());	
			puestosFacturacion.push("01");
			terminosFacturacion.push("");
		});
		// cantidad de los platos
		var cantidadFacturacion = new Array();
		 
		$(".cantidadPlatoRow").each(function(){
			cantidadFacturacion.push($(this).html());			
		});
		// cedula del mesero
		var meseroFacturacion = $("#meseroFactura").val();
		// numero de mesa
		var mesaFacturacion = $("#codigoMesa").val();
		// forma de pago
		var formPagoFacturacion = $("#formaPagos").val();
		// numero de autorizcion
		var numAutFacturacion = $("#numAutorizacion").val();
		// atencion 1
		var atencion1Facturacion = $("#atencion1").val();
		// atencion 2
		var atencion2Facturacion = $("#atencion2").val();
		// atencion 3
		var atencion3Facturacion = $("#atencion3").val();
		// atencion 4
		var atencion4Facturacion = $("#atencion4").val();
		// propina 
		var propinaFacturacion = $("#valorPropina").val();
		// cedula cliente
		var cedulaFacturacion = $("#cedulaCliente").val();


		if(formPagoFacturacion.localeCompare("02") == 0 || formPagoFacturacion.localeCompare("03") == 0){
			var camposObligados = fechaFacturacion.length * horaFacturacion.length * platosFacturacion.length * cantidadFacturacion.length * meseroFacturacion.length * mesaFacturacion.length * propinaFacturacion.length * numAutFacturacion.length;		
		}else{
			var camposObligados = fechaFacturacion.length * horaFacturacion.length * platosFacturacion.length * cantidadFacturacion.length * meseroFacturacion.length * mesaFacturacion.length * propinaFacturacion.length;
		}

		if(camposObligados == 0){
			swal("Campos vacíos","Los campos indicados con * son obligatorios, por favor complételos","info");
		}else{
			// saber si han atenciones
			var camposAtencion = atencion1Facturacion.length + atencion2Facturacion.length + atencion3Facturacion.length + atencion4Facturacion.length;

			if(camposAtencion == 0){
				var atencionFacturacion = new Array("0");
				var empresasFacturacion = new Array("0");
			}else{
				var atenciones = new Array(atencion1Facturacion,atencion2Facturacion,atencion3Facturacion,atencion4Facturacion);

				var atencionFacturacion = new Array();
				var empresasFacturacion = new Array();

				for(var i=0 ; i < atenciones.length ; i++){
					if(atenciones[i].localeCompare("") != 0){
						atencionFacturacion.push(atenciones[i]);
						switch(i){
							case 0:
								empresasFacturacion.push(nombreContainer1);
								break;
							case 1:
								empresasFacturacion.push(nombreContainer2);
								break;
							case 2:
								empresasFacturacion.push(nombreContainer3);
								break;
							case 3:
								empresasFacturacion.push(nombreContainer4);
								break;						
						}
					}
				}
			}

			$.ajax({
				url:'<?php echo Url::toRoute(['site/facturaretrasada']); ?>',				
				method: "GET",
				data: {
					'fecha':fechaFacturacion,
					'hora':horaFacturacion+":00",
					'puestos':puestosFacturacion,
					'productos':platosFacturacion,
					'cantidad':cantidadFacturacion,
					'termino':terminosFacturacion,
					'mesero':meseroFacturacion,
					'mesa':mesaFacturacion,
					'cliente':cedulaFacturacion,
					'formapago':formPagoFacturacion,
					'numautorizacion':numAutFacturacion,
					'valoratencion':atencionFacturacion,
					'empresaatencion':empresasFacturacion,
					'propina':propinaFacturacion
				},
				success: function (data) {											
					swal("Factura ingresada correctamente","EL número de la factura ingresa es "+data,"success");
					//limpiar el formulario
					$("#fechaFactura").val("");
					$("#horaFactura").val("");
					$("#meseroFactura").val("");
					$("#codigoMesa").val("");
					$("#formaPagos").val("");
					$("#numAutorizacion").val("");
					$("#atencion1").val("");
					$("#atencion2").val("");
					$("#atencion3").val("");
					$("#atencion4").val("");
					$("#valorPropina").val("");
					$("#cedulaCliente").val("");										

				},
				error: function(error) {
					swal("Error al ingresar factura","Vuelve a intentarlo o comunícate con el administrador","error");
				}
			});	

		}
		
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function formato(texto){
	  return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
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
	
	//////////////////////////////////////////////////////////////////////////////////////////////////
	
	$(document).ready(function(){
		/*setTimeout(function(){
			$(".order-data-tables").click();
  		}, 5000);*/
		
		$(".click-order-table").click(function(){
			$(".order-data-tables").click();
		});

	});
</script>

<?php $this->endPage() ?>

