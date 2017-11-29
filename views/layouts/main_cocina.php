<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\bootstrap\Dropdown;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);
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
</head>
<body class="bg-acomer">
	<?php $this->beginBody() ?>
	<?php @$events = $this->params['customParam']; ?>
<header id="header" class="clearfix">
	<nav id="menu" class="navbar">
		<div class="container-fluid text-center">
			<div class="content__logo pull-left">
				<?= Html::img('@web/img/logo_small.png', ['alt' => 'Acomer', 'height' => '24px']) ?>
			</div>
			<div class="content__nom-emp dis-inline-block">
				<h3 class="nom-emp" id="tituloCocina">SMILLE CITY</h3>
			</div>
			<div class="pull-right">
				<a href="" class="btn btn-raised btn-organge-grad btn-radius btn-inline" data-toggle="modal" data-target="#historialPedidos" onclick="consultarHistorial()">
					<i class="material-icons icon-btn">&#xE889;</i>Historial
				</a>
				<div class="content__icon-menu__aux">
					<div class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle menu-trigger menu-user"><i class="btn-menu-profile glyphicon glyphicon-option-vertical icon__24"></i></a>
						<ul class="dropdown-menu menu-profile">
							<li>
								<div class="dis-inline-block">
									<p class="txt-name fnt__Medium">usuario</p>
									<p class="txt-email">john.doe@hello.com</p>
								</div>
								<div class="dis-inline-block pull-right">
									<div class="content-avatar__menu-profile">
										<?= Html::img('@web/img/avatar.png', ['alt' => 'avatar', 'class' => 'img-avatar img-circle']) ?>
									</div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<p class="txt-cargo fnt__Medium">Profesional Nómina</p>
								<p class="txt-info">C.C. 52513735</p>
								<p class="txt-info">BOGOTÁ</p>
							</li>
							<li>
								<p class="txt-subcat fnt__Medium">Jefe Inmediato:</p>
								<p class="txt-info">Luis Alejandro Galindo Ramirez</p>
							</li>
							<li>
								<p class="txt-subcat fnt__Medium">Regional:</p>
								<p class="txt-info">Administración Central</p>
							</li>
							<li class="divider"></li>
							<li>
								<div class="pull-left">
									<button class="btn btn-raised btn-default btn-sm">Actualizar</button>
								</div>
								<div class="pull-right">
								<?= Html::beginForm(['/site/salida'],
								'post', 
								['class' => 'form-inline']); ?>								
								<?= Html::submitButton('Salir',['class' => 'btn btn-raised btn-default btn-sm']) ?>
								<?= Html::endForm() ?>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>
<section class="scroller-inner full-height p-t-80">
	<section id="content">
		<div class="container-fluid main-content main-cocina">
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>
			<?= $content ?>
		</div>
	</section>
</section>
<div class="modal modal_full-view fade" id="historialPedidos" tabindex="-1" role="dialog" aria-labelledby="pedidoModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div class="container-fluid">
					<div class="row">
						<div class="pull-right">
							<a href="#" class="btn btn-raised btn-organge-grad btn-radius btn-inline" data-dismiss="modal" aria-label="Close" onclick="salirHistorial()">
								<i class="material-icons icon-btn">&#xE14C;</i>Salir
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<h2 class="text-center">Historial de pedidos</h2>
				<div class="row">
					<div class="col-xs-12">
						<div class="content-fact">
							<div class="table-responsive" id="tablaHistorial">
								<table class="table table-hover" >
									<thead>
										<tr>
											<th>Plato</th>
											<th>Cantidad</th>
											<th>Fecha</th>
											<th>Hora terminado</th>
										</tr>
									</thead>
									<tbody id="cuerpoHistroial">
										<tr>
											<td>info 1</td>
											<td>info 2</td>
											<td>Hora ingreso</td>
											<td>Hora salida</td>
										</tr>
										<tr>
											<td>info 1</td>
											<td>info 2</td>
											<td>Hora ingreso</td>
											<td>Hora salida</td>
										</tr>
										<tr>
											<td>info 1</td>
											<td>info 2</td>
											<td>Hora ingreso</td>
											<td>Hora salida</td>
										</tr>
										<tr>
											<td>info 1</td>
											<td>info 2</td>
											<td>Hora ingreso</td>
											<td>Hora salida</td>
										</tr>
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
	<?php $this->endBody() ?>
</body>
</html>
	<?php $this->endPage() ?>
<script>
  $(function () {
    $.material.init();
	$('[data-toggle="tooltip"]').tooltip();
  });
</script>
<script>
	$(function () {
  
	// /////
	// MAD-SELECT
		var madSelectHover = 0;
		$(".mad-select").each(function() {
			var $input = $(this).find("input"),
				$ul = $(this).find("> ul"),
				$ulDrop =  $ul.clone().addClass("mad-select-drop");

			$(this)
			  .append('<i class="material-icons">arrow_drop_down</i>', $ulDrop)
			  .on({
			  hover : function() { madSelectHover ^= 1; },
			  click : function() { $ulDrop.toggleClass("show");}
			});

			// PRESELECT
			$ul.add($ulDrop).find("li[data-value='"+ $input.val() +"']").addClass("selected");

			// MAKE SELECTED
			$ulDrop.on("click", "li", function(evt) {
			  evt.stopPropagation();
			  $input.val($(this).data("value")); // Update hidden input value
			  $ul.find("li").eq($(this).index()).add(this).addClass("selected")
				.siblings("li").removeClass("selected");
			});
			// UPDATE LIST SCROLL POSITION
			$ul.on("click", function() {
			  var liTop = $ulDrop.find("li.selected").position().top;
			  $ulDrop.scrollTop(liTop + $ulDrop[0].scrollTop);
			});
		});

		$(document).on("mouseup", function(){
			if(!madSelectHover) $(".mad-select-drop").removeClass("show");
		});
		  
	});
</script>