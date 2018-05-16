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
							<!--<li class="divider"><div class="ln"></div></li>							
							<li >								
								<a href="#tab3" data-toggle="tab">									
									<i class="material-icons icon-btn">&#xE561;</i> MENU RESTAURANTES
								</a>
							</li>-->
							<li class="divider"><div class="ln"></div></li>
							<li >
								<a href="#tab4" data-toggle="tab">
									<i class="material-icons">&#xE8A1;</i> CIERRES
								</a>
							</li>									
														
						</ul>
					</div>
					<div class="tab-content">						

					<!--CUENTAS-->
						<div class="tab-pane fade active in" id="tab1">
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
											<th>TOTAL</th>
										</thead>							
										<tbody>
											<tr>
												<td>$<span id="subtotalCuenta"></span></td>											
												<td>$<span id="propinaCuenta"></span></td>	
												<td>$<span id="impuestosCuenta"></span></td>											
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
													<td><span id='histval<?=$i?>'><?=number_format($documentos['VALOR'][$i], 2)?></span></td>
											    </tr>	
											<?php endfor ?>											
										</tbody>
									</table>
								</div>
							</div>
						</div>

					<!--MENU DE RESTAURANTE-->
						<div class="tab-pane fade in" id="tab3">
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
													<!--<div class="form-group">
														<label for="nombreEmpresa" >Nombre de la empresa</label>
														<select id="nombreEmpresa" class="form-control" class="custom-select custom-select-sm">												  	
														  	<option value="1" selected>Container 1</option>
														  	<option value="2">Container 2</option>
														  	<option value="2">Container 3</option>
														  	<option value="2">Container 4</option>
														</select>
													</div>-->
												</div>
											</div>
											<div id="plaForm" class="col-md-12">
												formulario Platos
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
        						<h4 class="modal-tittle"><strong id="tituloModal">DETALLE DE DOCUMENTO</strong></h4>
      						</div>
							 <div class="modal-body">
						 		<div class="container-fluid" id="contenidoModal">
						 			<div id="headContModal"></div>
						 			<hr>
						 			<div id="bodyContModal">
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
						 			</div>
						 			<hr>
						 			<div id="footContModal"></div>
						 			
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
						 				<div class="form-group">
											<label class="font-style-form" for="nomCategoria">Nombre de la categoria</label>    								    				
											<div class="row">										
												<div class="col-md-12">
													<input type="text" class="form-control" id="nomCategoria" placeholder="Ingrese nombre de la categoria">
												</div>												
											</div>						    				
						    			</div>		
						    			<div class="form-group">						    				
											<label class="font-style-form" for="imgCategoria">Imagen de la categoria</label>
											<br>											
						    				<select id="imgCategoria" class="form-control">
												<option value="arroz_cat_icon">Imagen 1</option>
												<option value="aves_cat_icon">Imagen 2</option>
												<option value="bebidas_cat_icon">Imagen 3</option>
												<option value="carnes_cat_icon">Imagen 4</option>
												<option value="especiales_cat_icon">Imagen 5</option>
												<option value="mar_cat_icon">Imagen 6</option>
												<option value="pastas_cat_icon">Imagen 7</option>
												<option value="vegetales_cat_icon">Imagen 8</option>
											</select>
						    			</div>				    			
						    			<img id="imgEditCat" src="img/categorias/especiales_cat_icon.png">
						 			</div>
						 			<hr>
						 			<div id="footContModal2">
						 				
						 			</div>						 			
								</div>
							</div>      						
    						<div class="modal-footer">
      							<button type="button" class="btn btn-default" data-dismiss="modal">
    								<span class="glyphicon glyphicon-remove"></span>
                        			<span class="hidden-xs"> Cerrar</span> 
    							</button>         
    							<button type="button" class="btn btn-default">
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
	function mostrarDetallesVentas(posicion){
		var codigoVenta = $("#histdoc"+posicion).html();
		var codigoEmp = $("#histnit"+posicion).html();
		var nomEmp = $("#histemp"+posicion).html();
		var valorFac = $("#histval"+posicion).html();

		if(codigoVenta.localeCompare("N/A") != 0){
			$('#ModalContent').modal('show');
			$("#tituloModal").html("DETALLE DOCUMENTO");

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

			$("#dataTable4").dataTable({	
				"destroy":true,
		    	"ajax":{
		    		"url":"<?php echo Url::toRoute(['site/detalledocumentos']); ?>",
		    		"method":"GET",
		    		"data":{
		    			"empresa":codigoEmp,
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

			var tablePie =
				'<table>'+
					'<tbody>'+
						'<tr>'+
							'<td><h3><strong>TOTAL: </strong>$'+formatoMoneda(valorFac)+'</h3></td>'+
					    '</tr>'+
					'</tbody>'+
				'</table>';

			$("#headContModal").html(tableCabecera);			
			$("#footContModal").html(tablePie);
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
				cargarCierre();
			}
		});	

	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	$(cargarMenus());

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
		var idTag = "#categoriaId"+codigo;
		var codigoCategoria = $(idTag).html();

		switch(codigo){
			case 'nuevo':
				alert("crear una categoria");
				break;
			default:
				var nombreCategoria = $("#nombreCatId"+codigo).html();
				$("#nomCategoria").val(nombreCategoria);
				break;
		}

		$('#ModalContent3').modal('show');
	}

	function eliminarCategoria(codigo){
		var idTag = "#categoriaId"+codigo;
		var codigoCategoria = $(idTag).html();

		alert(codigoCategoria);

	}

	////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/*var dateNow = new Date();
	var today = dateNow.getDate()+"/"+(dateNow.getMonth()+1)+"/"+dateNow.getFullYear();*/

	$(consultaCuenta());	
	
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
				var totalPropina = arrayDatos[1];
				var totalNeto = arrayDatos[2];

				
				var codigos  = detalleEmp['EMPRESA'];
				var nombres = detalleEmp['GEN_EMP_NOM'];
				var impuestos = detalleEmp['IMPUESTOS'];
				var total = detalleEmp['TOTAL'];
				var bruto = detalleEmp['TOTAL_SIN_IMPUESTOS'];


				var detalleTable = '';
				var subtotal = 0;
				var totalImpuestos = 0;

				for (var i=0 ; i<codigos.length; i++) {
					detalleTable = detalleTable +
						'<tr>'+							
							'<td>'+codigos[i]+'</td>'+
							'<td>'+nombres[i]+'</td>'+
							'<td>$'+formatoMoneda(bruto[i])+'</td>'+
							'<td>$'+formatoMoneda(impuestos[i])+'</td>'+
							'<td>$'+formatoMoneda(total[i])+'</td>'+
						'</tr>';

					if(codigos[i].localeCompare("N/A") != 0){
						subtotal = subtotal + parseFloat(bruto[i]);
						totalImpuestos = totalImpuestos + parseFloat(impuestos[i]);
					}
				}				

				
				$("#bodyCuenta1").html(detalleTable);	
				$("#subtotalCuenta").html(formatoMoneda(subtotal.toString()));
				$("#propinaCuenta").html(formatoMoneda(totalPropina));
				$("#impuestosCuenta").html(formatoMoneda(totalImpuestos.toString()));
				$("#netoCuenta").html(formatoMoneda(totalNeto));
				

			}
		});	
	}setInterval(consultaCuenta, 5000);

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

