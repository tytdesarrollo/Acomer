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
				<h3 class="nom-emp" id="tituloCocina">NOMBRE COCINA</h3>
			</div>
			<div class="pull-right">
				<a href="" class="btn btn-raised btn-organge-grad btn-radius btn-inline" data-toggle="modal" data-target="#historialPedidos" onclick="consultarHistorial()">
					<i class="material-icons icon-btn">&#xE889;</i>Historial
				</a>
				<div class="content__icon-menu__aux">
					<div class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle menu-trigger menu-user">
							<svg version="1.1" id="Menu_Chef" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
								<g id="gCircleCh">
									<path id="circleCh" class="circleCh" d="M25,49.009C11.761,49.009,0.991,38.239,0.991,25S11.761,0.991,25,0.991S49.009,11.761,49.009,25
										S38.239,49.009,25,49.009z"/>
									<path id="shdwCircleCh" class="shdwCircleCh" d="M28.839,47.682C39.705,45.849,48.009,36.379,48.009,25c0-11.38-8.305-20.851-19.172-22.683
										C38.238,5.572,45.009,14.506,45.009,25C45.009,35.493,38.239,44.426,28.839,47.682z"/>
								</g>
								<g id="Chef">
									<path id="shdwCh" class="shdwCh" d="M25,48.009c4.831,0,9.317-1.5,13.023-4.054c-1.264-3.099-3.935-5.516-7.341-6.369l-3.54-0.885
										c1.464-1.301,2.648-3.091,3.438-5.065c1.173-0.212,2.272-1.144,2.449-3.283c0.17-2.068-0.51-2.921-1.383-3.262
										c-0.023-0.661-0.108-1.275-0.142-1.854c-0.099-1.633-0.378-3.038-0.825-4.217c1.604-1.18,2.799-3.05,2.799-5.172
										c0-2.802-3.061-6.094-7.142-5.352c-0.417-1.113-1.901-3.524-5.24-3.524c-3.895,0-4.976,2.78-5.415,3.668
										c-3.628-0.7-7.16,1.387-7.16,5.209c0,2.586,1.475,4.816,3.607,5.852v3.035c-0.017,0.398-0.013,0.761,0,1.084v1.403
										c-0.74,0.408-1.272,1.278-1.119,3.132c0.171,2.07,1.205,3.01,2.335,3.26c0.806,1.981,2.012,3.788,3.491,5.1l-3.511,0.875
										c-2.045,0.512-3.814,1.597-5.185,3.044C12.344,45.166,18.345,48.009,25,48.009z"/>
									<path id="baseCh" d="M9.335,43.172c4.208,3.633,9.682,5.837,15.665,5.837c5.983,0,11.457-2.205,15.666-5.838
										c-1.373-2.719-3.871-4.806-6.984-5.586l-3.54-0.885c1.464-1.301,2.648-3.091,3.438-5.065c1.173-0.212,2.272-1.144,2.449-3.283
										c0.17-2.068-0.51-2.921-1.383-3.262c-0.023-0.661-0.108-1.275-0.142-1.854c-0.395-6.532-3.678-9.405-8.986-8.836
										c-0.696,0.075-1.377,0.118-2.068,0.006c-2.772-0.455-5.665,1.673-7.074,3.892c-1.825,2.873-1.128,6.73-1.133,6.857
										c-0.8,0.379-1.395,1.247-1.234,3.198c0.171,2.07,1.205,3.01,2.335,3.26c0.806,1.981,2.012,3.788,3.491,5.1l-3.511,0.875
										C13.21,38.368,10.71,40.454,9.335,43.172z"/>
									<path id="tshCh" class="tshCh" d="M13.998,40.638c-1.101,0.737-2.009,1.717-2.685,2.844c0.852,0.633,1.748,1.208,2.685,1.72V40.638z"
										/>
									<path id="tshCh2" class="tshCh2" d="M38.691,43.48c-0.661-1.106-1.545-2.07-2.619-2.802c-1.03-0.571-2.504-1.068-3.931-1.535
										c-1.002-0.328-4.088-1.036-4.088-1.036c-0.967,0.465-2.011,0.726-3.109,0.726c-1.06,0-2.074-0.256-3.02-0.71
										c0,0-3.02,0.74-4.02,1.012c-1.732,0.471-2.654,0.846-2.654,0.846v5.853c2.963,1.392,6.266,2.174,9.75,2.174
										C30.125,48.009,34.862,46.323,38.691,43.48z"/>
									<circle id="btnCh4" cx="22.987" cy="47.932" r="1.068"/>
									<circle id="btnCh3" cx="18.705" cy="47.932" r="1.068"/>
									<circle id="btnCh2" cx="22.987" cy="44.123" r="1.068"/>
									<circle id="btnCh" cx="18.705" cy="44.123" r="1.068"/>
									<path id="headCh" class="headCh" d="M17.093,26.16c0-0.275,0.041-0.545,0.122-0.809c0.217-0.703,0.496-1.304,0.772-1.792
										c0.478-0.844,1.252-1.482,2.172-1.789c0.028-0.009,0.056-0.019,0.083-0.028c0.324-0.111,0.68,0.012,0.866,0.298
										c0.186,0.286,0.153,0.663-0.079,0.913c-0.044,0.047-0.088,0.094-0.133,0.138c-0.14,0.145-0.172,0.364-0.079,0.542
										c0.094,0.179,0.292,0.277,0.49,0.244c1.94-0.32,5.338-1.171,7.894-3.375c0.678-0.584,1.694-0.526,2.301,0.132
										c0.575,0.625,0.947,1.4,1.074,2.24c0.143,0.938,0.219,2.026,0.219,3.285c0,4.894-3.502,10.805-7.852,10.805
										C20.595,36.964,17.093,31.054,17.093,26.16z"/>
									<path id="lghtHeadCh" class="lghtHeadCh" d="M25.282,24.923c-0.079-0.566-0.193-1.275-0.319-2.005c-1.389,0.514-2.7,0.803-3.656,0.961
										c-0.198,0.033-0.396-0.065-0.49-0.244c-0.094-0.179-0.062-0.397,0.079-0.542c0.045-0.045,0.089-0.092,0.133-0.138
										c0.233-0.25,0.266-0.627,0.079-0.913c-0.187-0.286-0.542-0.41-0.866-0.298c-0.027,0.009-0.055,0.019-0.083,0.028
										c-0.92,0.307-1.695,0.945-2.172,1.789c-0.276,0.488-0.555,1.089-0.772,1.792c-0.08,0.264-0.122,0.534-0.122,0.809
										c0,3.617,1.916,7.783,4.669,9.714C24.738,32.762,25.858,28.805,25.282,24.923z"/>
									<path id="bCh" d="M26.386,33.832c0,0,0.937-0.073,0.863-0.863c-0.073-0.79-1.218-1.213-2.244-1.213s-2.296,0.37-2.367,1.213
										c-0.065,0.769,0.717,0.863,0.717,0.863H26.386z"/>
									<path id="goCh" class="goCh" d="M37.478,13.848c0-2.802-3.061-6.094-7.142-5.352c-0.417-1.113-1.901-3.524-5.24-3.524
										c-3.895,0-4.976,2.78-5.415,3.668c-3.628-0.7-7.16,1.387-7.16,5.209c0,2.586,1.475,4.816,3.607,5.852v5.532h17.501L33.583,19.7
										C35.714,18.664,37.478,16.434,37.478,13.848z"/>
								</g>
							</svg>
						</a>
						<ul class="dropdown-menu menu-profile">
							<li>
								<div class="dis-inline-block">
									<p class="txt-name fnt__Bold">Usuario</p>
									<p class="txt-email fnt__Medium" id="idUsuario">Id usuario</p>
									<p class="txt-email fnt__Medium" id="idPerfil">Nombre Perfil</p>
								</div>				
								<div class="dis-inline-block pull-right">
									<div class="content-avatar__menu-profile">
										<?= Html::img('@web/img/chef.svg', ['alt' => 'avatar', 'class' => 'img-avatar img-circle']) ?>
									</div>
								</div>
							</li>
							<li class="divider"></li>										
							<li>								
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