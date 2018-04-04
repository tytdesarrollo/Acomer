<?php
use yii\helpers\Url;
use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
AppAsset::register($this);

$this->title = 'Contratos';
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
	<!--<script src="../web/js/modernizr.custom.js"></script>-->
	<?= Html::jsFile('@web/js/modernizr.custom.js') ?>
</head>
<body class='bg-acomer'>
<?php $this->beginBody() ?>
	<header class="clearfix">
		<div class="container-fluid">
			<div class="row">
				<div class=" col-xs-6">
					<h2 class="txt__light-100">Contratos</h2>
				</div>
				<div class="col-xs-6 text-right">
					<?= Html::img('@web/img/logo_small.png', ['alt' => 'Acomer', 'class' => 'logo-small',]) ?>
				</div>
			</div>
		</div>
	</header>
	<div class="container">
		<div class="table-wrapper txt__light-100">
			<table>
				<thead>
					<tr>
						<th>Empresa</th>
						<th>Código empresa</th>
					</tr>
				</thead>
				<tbody>
					<?php			
						//CARGAN TODAS LAS EMRESAS QUE SE ENCUENTRAN EN LA BASE DE DATOS			
						foreach($empresas as $keye){ //ABRE FOREACH DE EMPRESAS
							//IDENTIFICAR SI ALGUNA EMPRESA NO POSEE UN CONTRATO E INDICAR EN LA VISTA
							$cantidad_contratos = 0;
					?>
					<!--LISTA DE TODAS LAS EMPRESAS Y SU RESPECTIVOS CODIGOS DE IDENTIFICACION-->
					<tr class="default">
						<?php
							echo '<td>'.$keye['NOM_EMPRESA'].'</td>';
							echo '<td>'.$keye['COD_EMPRESA'].'</td>';
						?>
						<td><span class="arrow">arrow</span></td>
					</tr>
					<!--LISTA DE CONTRATOS RESPECTIVA PARA CADA EMPRESA-->
					<tr class="toggle-row">
						<td colspan="5">
							<div class="sub-table-wrap">
								<!--CICLO QUE CARGA CADA UNO DE LOS CONTRATOS QUE SE TIENE CON CADA EMPRESA-->
								<?php
									foreach ($contratos as $keyc) { //ABRE FOREACH DE CONTRATOS
										//IDENTIFICO CON EL ID DE LA EMPRESA CUALES SON SUS CONTRATOS
										$idCompare = strcmp($keyc['COD_EMPRESA'],$keye['COD_EMPRESA']);
										if($idCompare === 0){ // ABRE IF COMParacion 
											//SI LA EMPRESA TIENE UN CONTRATO ENCREMENTO EL CONTADOR 
											$cantidad_contratos = $cantidad_contratos + 1;
								?>
								<div class="full-sub-table">
									<dl class="info-wrapper">
										<dt>Contrato</dt>
										<?php 
											echo '<dd>'.$keyc['COD_CONTRATO'].'</dd>';
										?>
									</dl>
									<dl class="info-wrapper">
										<dt>Valor</dt>
											<?php
							 					echo '<dd>$'.number_format($keyc['VALOR_CONTRATO'],0,',','.').'</dd>';
							 				?>
									</dl>
									<div class="pull-right">
										<dl class="info-wrapper">
											<dt>Fecha</dt>
											<?php 
												echo '<dd>'.$keyc['FECHA_INICIO'].'</dd>';
											?>
										</dl>
										<dl class="info-wrapper">
											<dt>Se vence en</dt>
											<?php
												echo '<dd>'.$keyc['FECHA_FIN'].'</dd>';
											?>
										</dl>
										<dl class="info-wrapper">
											<dt>Se firma el</dt>
											<?php
												echo '<dd>'.$keyc['FECHA_FIRMA'].'</dd>';
											?>
										</dl>
										<dl class="info-wrapper view-zoom">
											<div class="cttos-modal-action">
												<a href="#" class="zoom-btn ctt" data-type="modal-trigger">
													<i class="material-icons">&#xE145;</i>
												</a>
												<span class="cttos-modal-bg"></span>
											</div>
										</dl>
									</div>
									<!--DETALLE DE CONTRATO-->
									<div class="cttos-modal">
										<div class="cttos-modal-content">
											<center class="content-title-ctto">
												<?php
													echo '<h3 class="title-ctto">'.$keyc['COD_CONTRATO'].'</h3>';
												?>
											</center>
											<div class="content-sts mrg__bottom-30">
												<div class="row">
													<div class="col-xs-8 col-sm-4 mrg__bottom-20">
														<span class="icon-sts money">
															<i class="material-icons">&#xE227;</i>
														</span>
														<div class="sts">
															<?php
																echo '<span class="txt-sts">'.number_format($keyc['VALOR_CONTRATO'],0,',','.').'</span>';
															?>
															<span class="label-sts">Valor contrato</span>
														</div>
													</div>
													<div class="col-xs-4 col-sm-2 mrg__bottom-20">
														<span class="icon-sts">
															<i class="material-icons">&#xE02E;</i>
														</span>
														<div class="sts">
															<?php
																echo '<span class="txt-sts">'.$keyc['CUOTAS'].'</span>';
															?>
															<span class="label-sts">Cuotas</span>
														</div>
													</div>
													<div class="col-xs-4 col-sm-2 mrg__bottom-20">
														<span class="icon-sts">
															<i class="material-icons">&#xE878;</i>
														</span>
														<div class="sts">
															<?php
																echo '<span class="txt-sts">'.$keyc['PLAZOS'].'</span>';
															?>
															<span class="label-sts">Plazo</span>
														</div>
													</div>
													<div class="col-xs-8 col-sm-4 mrg__bottom-20">
														<span class="icon-sts money">
															<i class="material-icons">&#xE227;</i>
														</span>
														<div class="sts">
															<?php
																echo '<span class="txt-sts">'.number_format(str_replace(",",".",$keyc['VAL_CUOTA']),0,',','.').'</span>';
															?>
															<span class="label-sts">Valor cuota</span>
														</div>
													</div>
												</div>
											</div>
											<h4 class="subtitle-ctto fnt__Medium">Objeto del contrato</h4>
											<div class="panel">
												<?php
													echo '<div class="panel-body" style="color:#777777">'.$keyc['OBJ_CONTRATO'].'</div>';
												?>
											</div>
											<h4 class="subtitle-ctto fnt__Medium">Facturas</h4>
												<!-- LISTA DE LAS FACTURA DEL CONTRAT-->
												<div class="panel panel-md-table">
													<div class="panel-body table-responsive">
														<table class="table">
															<tbody>
																<?php
																	//CARGO LAS FACTURAS PERTENECIENTES AL CONTRATO 
																	foreach ($facturas as $keyf) { //ABRE FOREACH FACTURAS
																		//COMPARO EL CODIGO DEL CONTRATO COINCIDA CON EL DE LAS FACTURAS 
																		$idCompare = strcmp($keyf['COD_CONTRATO'],$keyc['COD_CONTRATO']);
																		if($idCompare === 0){// ABRE IF COMPARE 2
																?>
																<tr>
																	<th class="content-icon-est">
																		<?php
																			if($keyf['ESTADO'] === 'P'){
																				echo $facturapendiente;
																			}else{
																				echo $facturacancelada;
																			}
																		?>
																	</th>
																	<th>
																		<div class="info-factura">
																			<span class="lable-info">
																				Fecha a facturar
																			</span>
																			<?php
																				echo '<span class="txt-info">'.$keyf['FEC_FACTURA'].'</span>';
																			?>
																		</div>
																	</th>
																	<th>
																		<div class="info-factura text-right">
																			<span class="lable-info">
																				Valor
																			</span>
																			<?php
																				echo '<span class="txt-info">$'.number_format(str_replace(",",".",$keyc['VAL_CUOTA']),0,',','.').'</span>';
																			?>
																		</div>
																	</th>
																</tr>
																<?php
																		}//CIERRA IF COMPARE 2
																	}// CIERA FOREACH DE FACTURAS											
																?>
															</tbody>
														</table>
													</div>
												</div>
										</div>
									</div>
									<a href="#0" class="cttos-modal-close"><i class="material-icons">&#xE14C;</i></a>
								</div>
								<?php
										}// CIERRA IF DE COMPARE
									}//CIERRA FOREACH DE CONTRATOS								
								?>
								<?php
									//SI LA CANTIDAD DE CONTRATOS DE UN EMPRESA EN NULA SE INDICA EN PANTALLA
									if($cantidad_contratos === 0){ //ABRE IF DE CANTIDAD DE CONTRATOS
								?>
								<div class="full-sub-table">
									<dl class="info-wrapper">
										<dt>Contrato</dt>
										<dd>Sin contratos</dd>
									</dl>
									<dl class="info-wrapper">
										<dt>Valor</dt>
						 				<dd>$0</dd>
									</dl>
									<div class="pull-right">
										<dl class="info-wrapper">
											<dt>Fecha</dt>
											<dd>00/00/00</dd>
										</dl>
										<dl class="info-wrapper">
											<dt>Se vence en</dt>
											<dd>00/00/00</dd>
										</dl>
										<dl class="info-wrapper">
											<dt>Se firma el</dt>
											<dd>00/00/00</dd>
										</dl>
										<dl class="info-wrapper view-zoom">
											<div class="cttos-modal-action">
												<a class="zoom-btn ctt" data-type="modal-trigger">
													<i class="material-icons">&#xE14C;</i>
												</a>
												<!--'<span class="cttos-modal-bg"></span>-->
											</div>
										</dl>
									</div>
								</div>
								<?php 
									}// CIERRA IF DE CANTIDAD DE CONTRATOS CONTRATOS												
								?>
							</div>
						</td>
					</tr>
					<?php					
						}//CIERRA FOREAC DE EMPRESAS
					?>
				</tbody>
			</table>
		</div>
	</div>
<?php $this->endBody() ?>
	<!--<script src="../web/js/modal.js"></script>-->
	<?= Html::jsFile('@web/js/modal.js') ?>
	<script>
		$(document).ready(function ($) {
		  $('.default').click(function () {    
			$('.default').not($(this)).removeClass('active');
			$(this).toggleClass('active').next().find('.sub-table-wrap').slideToggle();
			$(".toggle-row").not($(this).next()).find('.sub-table-wrap').slideUp('fast');
		  });
		});
	</script>
	<script>
	  $(function () {
		$.material.init();
	  });
	</script>
</body>
</html>
<?php $this->endPage() ?>