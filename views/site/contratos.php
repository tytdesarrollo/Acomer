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
	<script src="../web/js/modernizr.custom.js"></script>
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
					<tr class="default">
						<td>Empresa 1</td>
						<td>codigoempresa1</td>
						<td> <span class="arrow">arrow</span></td>
					</tr>
					<tr class="toggle-row">
						<td colspan="5">
							<div class="sub-table-wrap">
								<div class="full-sub-table">
									<dl class="info-wrapper">
										<dt>Contrato</dt>
										<dd>1</dd>
									</dl>
									<dl class="info-wrapper">
										<dt>Valor</dt>
										<dd>$15.000.000</dd>
									</dl>
									<div class="pull-right">
										<dl class="info-wrapper">
											<dt>Fecha</dt>
											<dd>18/04/2017</dd>
										</dl>
										<dl class="info-wrapper">
											<dt>Se vence en</dt>
											<dd>18/04/2018</dd>
										</dl>
										<dl class="info-wrapper">
											<dt>Se firma el</dt>
											<dd>18/04/2017</dd>
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
									<div class="cttos-modal">
										<div class="cttos-modal-content">
											<center class="content-title-ctto">
												<h3 class="title-ctto">Contrato # 1</h3>
											</center>
											<div class="content-sts mrg__bottom-30">
												<div class="row">
													<div class="col-xs-8 col-sm-4 mrg__bottom-20">
														<span class="icon-sts money">
															<i class="material-icons">&#xE227;</i>
														</span>
														<div class="sts">
															<span class="txt-sts">15.000.000</span>
															<span class="label-sts">Valor contrato</span>
														</div>
													</div>
													<div class="col-xs-4 col-sm-2 mrg__bottom-20">
														<span class="icon-sts">
															<i class="material-icons">&#xE02E;</i>
														</span>
														<div class="sts">
															<span class="txt-sts">6</span>
															<span class="label-sts">Cuotas</span>
														</div>
													</div>
													<div class="col-xs-4 col-sm-2 mrg__bottom-20">
														<span class="icon-sts">
															<i class="material-icons">&#xE878;</i>
														</span>
														<div class="sts">
															<span class="txt-sts">30</span>
															<span class="label-sts">Plazo</span>
														</div>
													</div>
													<div class="col-xs-8 col-sm-4 mrg__bottom-20">
														<span class="icon-sts money">
															<i class="material-icons">&#xE227;</i>
														</span>
														<div class="sts">
															<span class="txt-sts">2.083.333</span>
															<span class="label-sts">Valor cuota</span>
														</div>
													</div>
												</div>
											</div>
											<h4 class="subtitle-ctto fnt__Medium">Objeto del contrato</h4>
											<div class="panel">
												<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis, necessitatibus, deserunt, aliquid, error sint aut commodi iste et incidunt magnam magni cum hic aliquam dicta nulla soluta impedit fugiat non!</div>
											</div>
											<h4 class="subtitle-ctto fnt__Medium">Facturas</h4>
											<div class="panel panel-md-table">
												<div class="panel-body table-responsive">
													<table class="table">
														<tbody>
															<tr>
																<th class="content-icon-est">
																<div class="icon-est-factura">P</div></th>
																<th>
																	<div class="info-factura">
																		<span class="lable-info">
																			Fecha a facturar
																		</span>
																		<span class="txt-info">01/01/17</span>
																	</div>
																</th>
																<th>
																	<div class="info-factura text-right">
																		<span class="lable-info">
																			Valor
																		</span>
																		<span class="txt-info">$2.083.333.33</span>
																	</div>
																</th>
															</tr>
															<tr>
																<th>
																		<div class="icon-est-factura">P</div>
																</th>
																<th>
																	<div class="info-factura">
																		<span class="lable-info">
																			Fecha a facturar
																		</span>
																		<span class="txt-info">31/01/17</span>
																	</div>
																</th>
																<th>
																	<div class="info-factura text-right">
																		<span class="lable-info">
																			Valor
																		</span>
																		<span class="txt-info">$2.083.333.33</span>
																	</div>
																</th>
															</tr>
															<tr>
																<th>
																	<div class="icon-est-factura">P</div>
																</th>
																<th>
																	<div class="info-factura">
																		<span class="lable-info">
																			Fecha a facturar
																		</span>
																		<span class="txt-info">02/03/17</span>
																	</div>
																</th>
																<th>
																	<div class="info-factura text-right">
																		<span class="lable-info">
																			Valor
																		</span>
																		<span class="txt-info">$2.083.333.33</span>
																	</div>
																</th>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<a href="#0" class="cttos-modal-close"><i class="material-icons">&#xE14C;</i></a>
								</div>
								<hr class="divider">
								<div class="full-sub-table">
									<dl class="info-wrapper">
										<dt>Contrato</dt>
										<dd>2</dd>
									</dl>
									<dl class="info-wrapper">
										<dt>Valor</dt>
										<dd>$20.000.000</dd>
									</dl>
									<div class="pull-right">
										<dl class="info-wrapper">
											<dt>Fecha</dt>
											<dd>18/04/2017</dd>
										</dl>
										<dl class="info-wrapper">
											<dt>Se vence en</dt>
											<dd>18/04/2018</dd>
										</dl>
										<dl class="info-wrapper">
											<dt>Se firma el</dt>
											<dd>18/04/2017</dd>
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
									<div class="cttos-modal">
										<div class="cttos-modal-content">
											<center class="content-title-ctto">
												<h3 class="title-ctto">Contrato # 2</h3>
											</center>
											<div class="content-sts mrg__bottom-30">
												<div class="row">
													<div class="col-xs-8 col-sm-4 mrg__bottom-20">
														<span class="icon-sts money">
															<i class="material-icons">&#xE227;</i>
														</span>
														<div class="sts">
															<span class="txt-sts">15.000.000</span>
															<span class="label-sts">Valor contrato</span>
														</div>
													</div>
													<div class="col-xs-4 col-sm-2 mrg__bottom-20">
														<span class="icon-sts">
															<i class="material-icons">&#xE02E;</i>
														</span>
														<div class="sts">
															<span class="txt-sts">6</span>
															<span class="label-sts">Cuotas</span>
														</div>
													</div>
													<div class="col-xs-4 col-sm-2 mrg__bottom-20">
														<span class="icon-sts">
															<i class="material-icons">&#xE878;</i>
														</span>
														<div class="sts">
															<span class="txt-sts">30</span>
															<span class="label-sts">Plazo</span>
														</div>
													</div>
													<div class="col-xs-8 col-sm-4 mrg__bottom-20">
														<span class="icon-sts money">
															<i class="material-icons">&#xE227;</i>
														</span>
														<div class="sts">
															<span class="txt-sts">2.083.333</span>
															<span class="label-sts">Valor cuota</span>
														</div>
													</div>
												</div>
											</div>
											<h4 class="subtitle-ctto fnt__Medium">Objeto del contrato</h4>
											<div class="panel">
												<div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis, necessitatibus, deserunt, aliquid, error sint aut commodi iste et incidunt magnam magni cum hic aliquam dicta nulla soluta impedit fugiat non!</div>
											</div>
											<h4 class="subtitle-ctto fnt__Medium">Facturas</h4>
											<div class="panel panel-md-table">
												<div class="panel-body table-responsive">
													<table class="table">
														<tbody>
															<tr>
																<th class="content-icon-est">
																<div class="icon-est-factura">P</div></th>
																<th>
																	<div class="info-factura">
																		<span class="lable-info">
																			Fecha a facturar
																		</span>
																		<span class="txt-info">01/01/17</span>
																	</div>
																</th>
																<th>
																	<div class="info-factura text-right">
																		<span class="lable-info">
																			Valor
																		</span>
																		<span class="txt-info">$2.083.333.33</span>
																	</div>
																</th>
															</tr>
															<tr>
																<th>
																		<div class="icon-est-factura">P</div>
																</th>
																<th>
																	<div class="info-factura">
																		<span class="lable-info">
																			Fecha a facturar
																		</span>
																		<span class="txt-info">31/01/17</span>
																	</div>
																</th>
																<th>
																	<div class="info-factura text-right">
																		<span class="lable-info">
																			Valor
																		</span>
																		<span class="txt-info">$2.083.333.33</span>
																	</div>
																</th>
															</tr>
															<tr>
																<th>
																	<div class="icon-est-factura">P</div>
																</th>
																<th>
																	<div class="info-factura">
																		<span class="lable-info">
																			Fecha a facturar
																		</span>
																		<span class="txt-info">02/03/17</span>
																	</div>
																</th>
																<th>
																	<div class="info-factura text-right">
																		<span class="lable-info">
																			Valor
																		</span>
																		<span class="txt-info">$2.083.333.33</span>
																	</div>
																</th>
															</tr>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
									<a href="#0" class="cttos-modal-close"><i class="material-icons">&#xE14C;</i></a>
								</div>
							</div>
						</td>
					</tr>
					<tr class="default">
						<td>Empresa 2</td>
						<td>codigoempresa2</td>
						<td> <span class="arrow">arrow</span></td>
					</tr>
					<tr class="toggle-row">
						<td colspan="5">
							<div class="sub-table-wrap">
								<div class="full-sub-table">
									<dl class="info-wrapper">
										<dt>Valor</dt>
										<dd>1</dd>
									</dl>
									<dl class="info-wrapper">
										<dt>Valor</dt>
										<dd>2</dd>
									</dl>
									<dl class="info-wrapper">
										<dt>Valor</dt>
										<dd>3</dd>
									</dl>
									<dl class="info-wrapper">
										<dt>Valor</dt>
										<dd>4</dd>
									</dl>
								</div>
							</div>
						</td>
					</tr>
					<tr class="default">
						<td>Empresa 3</td>
						<td>codigoempresa3</td>
						<td> <span class="arrow">arrow</span></td>
					</tr>
					<tr class="toggle-row">
						<td colspan="5">
							<div class="sub-table-wrap">
								<div class="full-sub-table">
									<dl class="info-wrapper">
										<dt>Valor</dt>
										<dd>1</dd>
									</dl>
									<dl class="info-wrapper">
										<dt>Valor</dt>
										<dd>2</dd>
									</dl>
									<dl class="info-wrapper">
										<dt>Valor</dt>
										<dd>3</dd>
									</dl>
									<dl class="info-wrapper">
										<dt>Valor</dt>
										<dd>4</dd>
									</dl>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
<?php $this->endBody() ?>
	<script src="../web/js/modal.js"></script>
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