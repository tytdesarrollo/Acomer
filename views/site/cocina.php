<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>	
	<?= Html::jsFile('@web/js/jquery.min.js') ?>
	<?= Html::jsFile('@web/js/ciclosession.js') ?>
</head>
<body>
	<div class="row">
		<div class="col-sm-6 pedidos_list-view">
			<div id="conjunto">
				
			</div>
		</div>
		<div class="col-sm-6 text-center pedidos_view">
			<div class="content-pedido__detail" id="detallePlato">
				<h3 class="text-center fnt__Medium pedido__view-title">Nombre del plato</h3>
				<div class="pedido__detail-img">
					<?= Html::img('@web/img/categorias/carnes_cat_icon.png', ['alt' => 'Imagen plato', 'class' => 'img-responsive']) ?>
				</div>
				<div class="pedido__detail-info">
					<div class="notes mrg__top-30 text-left">
						<h4 class="fnt__Medium">Notas</h4>
						<div class="notes-box">
							<p class="fnt__Medium">Notas del plato.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	var generalDetallePlato = 0;
	var generalPrimerItem = 0;
</script>

<script type="text/javascript">			
		//funciones que debe cargar una vez este listo el documento 
	    $(cargarPedidos());	

	    $(document).ready(function() {	
	    	document.getElementById("tituloCocina").innerHTML = "<?=$nomcocina?>";
	    	document.getElementById("idUsuario").innerHTML = "CC."+"<?=Yii::$app->session['cedula']?>";
	    	document.getElementById("idPerfil").innerHTML = "<?=ucwords(strtolower($rol))?>";
	    });
		
		function cargarPedidos(){
			$.ajax({
				url:'<?php echo Url::toRoute(['site/pedidoscocina']); ?>',
				dataType:'json',				
				success: function (data) {						
					// tranforma el json en array
					var arrayDatos = $.map(data, function(value, index) {
		    			return [value];
					});	


					// valores que trae el procedimiento
					var conjunto = arrayDatos[0];
					var mesas = arrayDatos[1];
					var pedidos = arrayDatos[2];

					//datos necesarios para el detalle del plato al pulsar sobre el
					generalDetallePlato = arrayDatos[2];

					//esquema que se va a mostrar
					var esquema = '';
					var esquema2 = '';

					// si no hay pedidos para el restaurante indica en pantalla
					if(pedidos['PLATO'][0] == 'SIN PEDIDOS'){
						esquema = 
							'<div class="content-pedido__item">'+
							'<div class="pedido__item">'+
								'<div class="lb-m">'+
									'<span></span>'+
								'</div>'+
								'<div class="pedido__item-info">'+
									'<p class="fnt__Medium">No hay pedidos</p>'+
								'</div>'+
								'<a href="#" class="pedido__item-cnt-btn">'+
									'<i class="material-icons"></i>'+
								'</a>'+
								'<div class="pedido__item-mesa">'+
									'<i class="n"><span></span></i>'+
								'</div>'+
							'</div>';

						esquema2 = 
							'<h3 class="text-center fnt__Medium pedido__view-title">Nombre del plato</h3>'+
							'<div class="pedido__detail-img">'+							
							'</div>'+
							'<div class="pedido__detail-info">'+
								'<div class="notes mrg__top-30 text-left">'+
									'<h4 class="fnt__Medium">Notas</h4>'+
									'<div class="notes-box">'+
										'<p class="fnt__Medium">Notas del plato.</p>'+
									'</div>'+
								'</div>'+
							'</div>';

						document.getElementById("detallePlato").innerHTML = esquema2;

					}else{
						for (var i = 0 ; i < conjunto['NOMBRE'].length; i++) {

							esquema = esquema + '<div class="content-pedido__item">';

							for (var j = 0 ; j < mesas['CONJUNTO_PEDIDO'].length; j++) {

								if(conjunto['CONJUNTO'][i] == mesas['CONJUNTO_PEDIDO'][j]){

									for (var k = 0 ; k < pedidos['MESA'].length; k++) {							

										if(pedidos['MESA'][k] == mesas['CODIGO_MESA'][j]){

											esquema = esquema +
												'<div class="pedido__item">'+
													'<div class="lb-m">'+
														'<span>Mesa #'+pedidos['MESA'][k]+'</span>'+
													'</div>'+
													'<div class="pedido__item-info" onclick="verDetallePlato('+k+')">'+
														'<p class="fnt__Medium">'+pedidos['PLATO'][k]+'</p>'+
													'</div>'+
													'<a href="#" class="pedido__item-cnt-btn" onclick="platoListo('+k+')">'+
														'<i class="material-icons">&#xE876;</i>'+
													'</a>'+
													'<div class="pedido__item-mesa">'+
														'<i class="n"><span>x</span>'+pedidos['CANTIDAD'][k]+'</i>'+
													'</div>'+
												'</div>';

											// si es la primera vez que se carga muestra el detalle del primer plato 
											if(generalPrimerItem == 0){
												verDetallePlato(k);
												// se cambia la primera carga a 1
												generalPrimerItem = 1;
											}
										}
									}
								}					
							}
							esquema = esquema + '</div>';							
						}
					}
					
					
					
					document.getElementById("conjunto").innerHTML = esquema;
				}
			});
		}setInterval(cargarPedidos, 1000);

		function verDetallePlato(posicion){
			var nombrePlato = generalDetallePlato['PLATO'];
			var imagenPlato = generalDetallePlato['IMAGEN'];
			var descriPlato = generalDetallePlato['DESCRIPCION'];		

			var detallePedido;

			// acomodar las notas de cada plato 
			var notaPlato = descriPlato[posicion].split("*_");
			// lista de nota para cada plato
			var detalleNota = '<ul>';
			for(var i = 0 ; i < notaPlato.length ; i++){
				detalleNota = detalleNota +
					'<li>'+notaPlato[i]+'</li>';
			}
			detalleNota = detalleNota + '</ul>';
			
			detallePedido = 
				'<h3 class="text-center fnt__Medium pedido__view-title">'+nombrePlato[posicion]+'</h3>'+
				'<div class="pedido__detail-img">'+
					'<img src="img/categorias/'+imagenPlato[posicion]+'" alt="Imagen plato" class="img-responsive">'+
				'</div>'+
				'<div class="pedido__detail-info">'+
					'<div class="notes mrg__top-30 text-left">'+
						'<h4 class="fnt__Medium">Notas</h4>'+
						'<div class="notes-box">'+
							'<p class="fnt__Medium">'+detalleNota+'</p>'+
						'</div>'+
					'</div>'+
				'</div>';

			document.getElementById("detallePlato").innerHTML = detallePedido;

		}

		function platoListo(posicion){		
			
			var empresa  = generalDetallePlato['EMPRESA'][posicion];
			var pednro   = generalDetallePlato['PEDIDO'][posicion];
			var plato    = generalDetallePlato['PLATO'][posicion];	
			var cantidad = generalDetallePlato['CANTIDAD'][posicion];			

			$.ajax({
				url: '<?php echo Url::toRoute(['site/pedidolisto']); ?>',
				method: "GET",
				data: {'empresa':empresa, 'pednro':pednro, 'plato':plato},
				success: function (data) {			
					
				}
			});	

			$.ajax({
				url: '<?php echo Url::toRoute(['site/agregahistorial']); ?>',
				method: "GET",
				data: {'cantidad':cantidad, 'plato':plato},
				success: function (data) {			
					
				}
			});			

		}

		
		function consultarHistorial(){
			$("#tablaHistorial").dataTable({	
					"destroy":true,
			    	"ajax":{
			    		"url":"<?php echo Url::toRoute(['site/historialcocina']); ?>"		    		
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
		

		function salirHistorial(){
			var refreshIntervalId = setInterval(consultarHistorial, 10000);
			clearInterval(refreshIntervalId);
		}		
</script>

	
