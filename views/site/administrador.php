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

			#fechaCuenta{
				width: 185px;
    			height: 31px;
			}

			#fechaHist{
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

			#btnCierre {
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
		</style>

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
								<a href="#" class="btn btn-raised btn-organge-grad btn-radius btn-inline" onclick="salir()">
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
									<a href="#tab3" data-toggle="tab">									
										<i class="material-icons icon-btn">&#xE561;</i> MENU RESTAURANTES
									</a>
								</li>
								<li class="divider"><div class="ln"></div></li>
								<li >
									<a href="#tab4" data-toggle="tab">
										<i class="material-icons">&#xE8A1;</i> CIERRES
									</a>
								</li>		
							<?php else: ?>
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
									<table class="table table-striped">
										<thead class="thead">
											<tr>
												<th>NIT</th>
												<th>EMPRESA</th>
												<th>TOTAL BRUTO*</th>												
												<th>TOTAL IMPUESTOS</th>
												<th>TOTAL ATENCIONES</th>
												<th>TOTAL NETO</th>
											</tr>
										</thead>
										<tbody id="bodyCuenta1">											

										</tbody>
									</table>
									*No incluye impuesto
									<br><br><br>
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
												<td>$<span id="subtotalCuenta"></span></td>
												<td>$<span id="propinaCuenta"></span></td>
												<td>$<span id="impuestosCuenta"></span></td>
												<td>$<span id="atencionesCuenta"></span></td>
												<td><strong>$<span id="netoCuenta"></span></strong></td>
											</tr>
										</tbody>
									</table>

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
									<table class="table table-striped" id="dataTable2">
										<thead class="thead">
											<tr>
												<th scope="col"></th>
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
												<button class="btn btn-link" onclick="showForm('CAT')">CATEGORIA</button>
												<button class="btn btn-link" onclick="showForm('PLA')">Platos</button>
											</div>																						
										</div>
										<div class="row">
											<div id="catForm" class="col-md-12">	
												<hr>
												<div class="col-md-12">
													<h4><strong>LISTA DE CATEGORIAS</strong></h4>	
													<a class="pull-right btn btn-raised btn-success btn-radius btn-inline" onclick="editarCategoria('nuevo')">
														<i class="material-icons">add</i> crear
													</a>												
												</div>												
												<div class="col-md-12">													
													<table class="table table-striped" id="dataTable6" style="width: 100%">
														<thead class="thead">
															<tr>
																<th>CODIGO</th>
																<th>NOMBRE</th>
																<th>IMAGEN</th>
																<th>EDITAR</th>
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
													<a class="pull-right btn btn-raised btn-success btn-radius btn-inline" onclick="editarPlato('nuevo')">
														<i class="material-icons">add</i> crear
													</a>												
												</div>												
												<div class="col-md-12">													
													<table class="table table-striped" id="dataTable7" style="width: 100%">
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
																<th>EDITAR</th>
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
									<table class="table table-striped">
										<thead class="thead">
											<tr>
												<th scope="col">TIPO DE CIERRE</th>
												<th scope="col">CONFIRMAR</th>
											</tr>
										</thead>
										<tbody>
											<tr>																								
												<td>													
													TOTAL
												</td>
												<td>
													<input type="checkbox" id="confirmCierre" onclick="checkCierre(1)">													
												</td>
										    </tr>	
										</tbody>
									</table>									
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
									<table class="table table-striped" id="dataTable3" style="width: 100%">
										<thead class="thead">
											<tr>
												<th scope="col"></th>
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
						 			<div id="headContModal"></div>
						 			<hr>
						 			<div id="bodyContModal">
						 				<h4 class="modal-tittle"><strong>PLATOS VENDIDOS</strong></h4>
						 				<table class="table table-striped" id="dataTable4" style="width: 100%">
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
										<table class="table table-striped" id="tableDetAtencion" style="width: 100%">
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
												<th>TOTAL</th>
											</thead>							
											<tbody>
												<tr>
													<td>$<span id="subtotalCierre"></span></td>											
													<td>$<span id="propinaCierre"></span></td>	
													<td>$<span id="impuestosCierre"></span></td>											
													<td><strong>$<span id="netoCierre"></span></strong></td>
												</tr>
											</tbody>
										</table>
						 			</div>
						 			<hr>
						 			<div id="bodyContModal2">
						 				<table class="table table-striped" id="dataTable5" style="width: 100%">
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
			</div>				
		<?php $this->endBody() ?>

		
	</body>
</html>
<?= Html::cssFile('@web/css/dataTables.bootstrap4.css')?>
<?= Html::jsFile('@web/js/jquery.dataTables.js') ?>
<?= Html::jsFile('@web/js/dataTables.bootstrap4.js') ?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){      

        $("#dataTable2").dataTable({
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
	//carga inicial
	$(showForm('CAT'));
	$(checkCierre(0));	

	function showForm(form){
		switch(form){
			case 'CAT':
				$('#catForm').show();
				$('#plaForm').hide();
				break;
			case 'PLA':
				$('#catForm').hide();
				$('#plaForm').show();
				break;
		}
	}

	function checkCierre(action){
		switch(action){
			case 0:
				$("#confirmCierre").attr('onclick', 'checkCierre(1)');
				$("#btnCierre").prop("disabled",true);						
				break;
			case 1:
				$("#confirmCierre").attr('onclick', 'checkCierre(0)');
				$("#btnCierre").prop("disabled",false);
				break;
		}
	}

	function salir(){
		var urlCerrar = "<?php echo Url::toRoute(['site/salida'])?>";
		location.href = urlCerrar;
	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$("#detailFacDoc").hide();
	
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

			/*******************************************/
			/*DETALLE DE PLATOS*/
			$("#dataTable4").dataTable({	
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
				var totalNeto = arrayDatos[3];				

				$('#subtotalCierre').html(formatoMoneda(subTotal));
				$('#propinaCierre').html(formatoMoneda(propinaVol));
				$('#impuestosCierre').html(formatoMoneda(impuestos));
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
		$.ajax({
			url:'<?php echo Url::toRoute(['site/realizacierre']); ?>',							
			success: function (data) {	
				swal("Cierre completado", "El detalle del cierre se encuentra en el historial", "success");
				cargarCierres();
			}
		});	

	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$(cargarMenus());
	$(cargarPlatos());

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
				break;
			default:				
				$("#tituloModal4").html("EDITAR PLATO");

				//Empresa a la que pertenece el plato
				var empresaPlato = $("#nitEmpPlatoId"+codigo).html();
				//se selecciona la imagen
				$("option[value='"+empresaPlato+"']").attr('selected','selected');

				// nombre de la categoria seleccionada
				var nombrePlato = $("#nombrePlaId"+codigo).html();				
				//se imprime el nombre
				$("#nomPlato").val(nombrePlato);

				//categoria a la que pertence el plato
				var categoriaPlato = $("#codigoCatPlId"+codigo).html();
				//se muestra la categoria 
				$("option[value="+categoriaPlato+"]").attr('selected','selected');

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
		// id del tag 
		var idTag = "#platoId"+codigo;
		// codigo de la categoria seleccionado
		var codigoPlato = $(idTag).html();
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
	  			alert("eliminado");
	  		}
		  		
		});
	}

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
									location.reload();
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
		var tamano = empresaPlato.length * nombrePlato.length * catePlato.length * tiempoPlato.length * unidadTiempoPl.length * precioPlato.length;

		if(tamano == 0){
			swal("Campos vacíos","Por favor complete los campos faltantes","error");
		}else{
			// accion 
			switch(action){
				case 'EDIT':
					
					break;
				case 'NEW':				

					break;
			}
		}			
		//console.log(empresaPlato+", "+nombrePlato+", "+catePlato+", "+tiempoPlato+", "+unidadTiempoPl+", "+precioPlato+", "+tamano);

	}	

	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/*var dateNow = new Date();
	var today = dateNow.getDate()+"/"+(dateNow.getMonth()+1)+"/"+dateNow.getFullYear();*/

	if(rolIniciado.localeCompare("ADMINISTRADOR") == 0){		
		//activacion de tab
		$("#tab1").removeClass("active");
		$("#tab3").addClass("active");
		//ejecuta la consulta de la cuentas
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

				var detalleTable = '';				

				for (var i=0 ; i<detalleEmp['NIT'].length; i++) {
					detalleTable = detalleTable +
						'<tr>'+							
							'<td>'+detalleEmp['NIT'][i]+'</td>'+
							'<td>'+detalleEmp['EMPRESA'][i]+'</td>'+
							'<td>$'+formatoMoneda(detalleEmp['SUBTOTAL'][i])+'</td>'+
							'<td>$'+formatoMoneda(detalleEmp['IMPUESTOS'][i])+'</td>'+
							'<td>$'+formatoMoneda(detalleEmp['ATENCIONES'][i])+'</td>'+
							'<td>$'+formatoMoneda(detalleEmp['TOTAL'][i])+'</td>'+
						'</tr>';					
				}				

				
				$("#bodyCuenta1").html(detalleTable);					
				$("#subtotalCuenta").html(formatoMoneda(totales['SUBTOTAL'][0]));
				$("#propinaCuenta").html(formatoMoneda(totales['PROPINA'][0]));
				$("#impuestosCuenta").html(formatoMoneda(totales['IMPUESTO'][0]));
				$("#atencionesCuenta").html(formatoMoneda(totales['ATENCIONES'][0]));
				$("#netoCuenta").html(formatoMoneda(totales['VALOR'][0]));
				

			}
		});	
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
</script>

<?php $this->endPage() ?>

