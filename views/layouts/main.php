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
	<?= Html::jsFile('@web/js/modernizr.custom.js') ?>
</head>
<body class="bg-green cd-section">
	<?php $this->beginBody() ?>
	<?php @$events = $this->params['customParam']; ?>
<header id="header" class="clearfix">
	<nav id="menu" class="navbar">
		<div class="container-fluid">
			<div class="pull-right">
				
				<div class="content__icon-menu__aux">
					<div class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle btn-menu-helper">
							<svg version="1.1" id="Help" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
								<g id="gCircleH">
									<path id="circleH" class="circleH" d="M25,49.009C11.761,49.009,0.991,38.239,0.991,25S11.761,0.991,25,0.991S49.009,11.761,49.009,25
										S38.239,49.009,25,49.009z"/>
									<path id="shdwCircleH" class="shdwCircleH" d="M28.839,47.682C39.705,45.849,48.009,36.379,48.009,25c0-11.38-8.305-20.851-19.172-22.683
										C38.238,5.572,45.009,14.506,45.009,25C45.009,35.493,38.239,44.426,28.839,47.682z"/>
								</g>
								<g id="gi">
									<path id="shdwIB" class="shdwIB" d="M25.089,30.953c0.201-0.933,0.576-2.67,0.983-4.607c0.001-0.004,0.002-0.009,0.003-0.013
										c0.416-2.093,0.087-3.925-0.951-5.296c-0.937-1.238-2.419-1.997-4.175-2.137c-2.596-0.208-5.312,1.342-6.144,2.867
										c-0.385,0.676-0.2,1.225-0.055,1.493c0.18,0.332,0.442,0.518,0.633,0.654c0.295,0.209,0.986,0.7,0.33,3.962
										c-0.061,0.298-0.977,4.951-1.097,5.612c-0.001,0.004-0.002,0.009-0.002,0.013c-0.361,2.104-0.004,3.942,1.089,5.269
										c1.76,2.138,4.439,2.035,4.544,2.035c2.497,0,4.993-1.551,5.753-3.035c0.367-0.686,0.169-1.229,0.016-1.494
										c-0.188-0.327-0.455-0.506-0.65-0.637c-0.3-0.201-1.002-0.672-0.435-3.942C24.943,31.626,25,31.362,25.089,30.953z"/>
									<path id="shdwIH" class="shdwIH" d="M26.498,10.044c-0.968-1.089-2.478-1.713-4.143-1.713c-2.973,0-5.63,2.03-5.924,4.527
										C16.3,14,16.655,15.109,17.43,15.979c0.953,1.069,2.449,1.682,4.106,1.682c3.05,0,5.668-1.989,5.961-4.525
										C27.629,12.014,27.274,10.916,26.498,10.044z"/>
									<path id="iBody" class="iBody" d="M29.364,35.639c-0.3-0.201-1.002-0.672-0.435-3.942c0.015-0.071,0.071-0.335,0.16-0.744
										c0.201-0.933,0.576-2.67,0.983-4.607c0.001-0.004,0.002-0.009,0.003-0.013c0.416-2.093,0.087-3.925-0.951-5.296
										c-0.937-1.238-2.42-1.997-4.175-2.137c-2.596-0.208-5.312,1.342-6.144,2.867c-0.385,0.676-0.2,1.225-0.055,1.493
										c0.18,0.332,0.442,0.518,0.633,0.654c0.295,0.209,0.986,0.7,0.33,3.962c-0.061,0.298-0.976,4.951-1.097,5.612
										c-0.001,0.004-0.002,0.009-0.002,0.013c-0.361,2.104-0.004,3.942,1.089,5.269c1.76,2.138,4.439,2.035,4.544,2.035
										c2.497,0,4.993-1.551,5.753-3.035c0.367-0.686,0.169-1.229,0.016-1.494C29.826,35.949,29.559,35.769,29.364,35.639z"/>
									<path id="iHead" class="iHead" d="M30.498,10.044c-0.968-1.089-2.478-1.713-4.143-1.713c-2.973,0-5.63,2.03-5.924,4.527
										C20.3,14,20.655,15.109,21.43,15.979c0.953,1.069,2.449,1.682,4.106,1.682c3.05,0,5.668-1.989,5.961-4.525
										C31.629,12.014,31.274,10.916,30.498,10.044z"/>
									<path id="lghtIB" class="lghtIB" d="M24.557,19.634c-0.028,0-0.056-0.003-0.084-0.003c-2.15,0-4.366,1.315-5.01,2.495
										c-0.164,0.288-0.18,0.545-0.054,0.776c0.097,0.179,0.255,0.291,0.408,0.399c0.639,0.453,1.199,1.33,0.732,4.127
										C22.429,25.302,23.696,22.498,24.557,19.634z"/>
									<path id="lghtIH" class="lghtIH" d="M21.177,12.945c-0.107,0.926,0.182,1.826,0.813,2.534c0.759,0.851,1.946,1.344,3.276,1.407
										c0.654-3.009,0.921-5.851,1.024-7.8C23.713,9.115,21.425,10.832,21.177,12.945z"/>
								</g>
							</svg>
						</a>
						<ul class="dropdown-menu menu-profile menu-helper">
							<li class="mrg__bottom-5">
									<p class="sub-title text-center fnt__Medium">Notificaciones</p>
							</li>
							<li class="divider"></li>
							<li>
								<p class="sub-title cat-helper fnt__Medium">Mesas</p>
							</li>
							<li class="cnt-notification-helper">
								<div class="dis-inline-block">
									<p class="lb-notification-helper">Mesa libre</p>
								</div>
								<div class="dis-inline-block pull-right">
									<div class="notification-helper null"></div>
								</div>
							</li>
							<li class="cnt-notification-helper">
								<div class="dis-inline-block">
									<p class="lb-notification-helper">Mesa ocupada</p>
								</div>
								<div class="dis-inline-block pull-right">
									<div class="notification-helper full"></div>
								</div>
							</li>
							<li class="cnt-notification-helper">
								<div class="dis-inline-block">
									<p class="lb-notification-helper">0-15 minutos de retraso</p>
								</div>
								<div class="dis-inline-block pull-right">
									<div class="notification-helper warning"></div>
								</div>
							</li>
							<li class="cnt-notification-helper">
								<div class="dis-inline-block">
									<p class="lb-notification-helper">+15 minutos de retraso</p>
								</div>
								<div class="dis-inline-block pull-right">
									<div class="notification-helper danger"></div>
								</div>
							</li>
							<li class="divider cat-helper"></li>
							<li>
								<p class="sub-title cat-helper fnt__Medium">Restaurantes</p>
							</li>
							<li class="cnt-notification-helper">
								<div class="dis-inline-block">
									<p class="lb-notification-helper">Pedido listo</p>
								</div>
								<div class="dis-inline-block pull-right">
									<div class="notification-helper c-full"></div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="content__icon-menu__aux">
					<div class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle menu-trigger menu-user">
							<svg version="1.1" id="Menu_Waiter" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
								<g id="gCircleW">
									<path id="circleW" class="circleW" d="M25,49.009C11.761,49.009,0.991,38.239,0.991,25S11.761,0.991,25,0.991S49.009,11.761,49.009,25
										S38.239,49.009,25,49.009z"/>
									<path id="shdwCircleW" class="shdwCircleW" d="M28.839,47.682C39.705,45.849,48.009,36.379,48.009,25c0-11.38-8.305-20.851-19.172-22.683
										C38.238,5.572,45.009,14.506,45.009,25C45.009,35.493,38.239,44.426,28.839,47.682z"/>
								</g>
								<g id="Waiter">
									<path id="shdwW" class="shdwW" d="M25,48.009c5.185,0,9.973-1.725,13.825-4.629v-3.286c-0.001-4.94-3.353-9.227-8.143-10.427
										l-3.54-0.885c1.464-1.301,2.648-3.091,3.438-5.065c1.173-0.212,2.272-1.144,2.449-3.283c0.17-2.068-0.51-2.921-1.383-3.262
										c-0.023-0.661-0.108-1.275-0.142-1.854c-0.395-6.532-3.678-9.405-8.986-8.836c-0.696,0.075-1.377,0.118-2.068,0.006
										c-2.772-0.455-5.665,1.673-7.074,3.892c-1.825,2.873-1.128,6.73-1.133,6.857c-0.8,0.379-1.395,1.247-1.234,3.198
										c0.171,2.07,1.205,3.01,2.335,3.26c0.806,1.981,2.012,3.788,3.491,5.1l-3.511,0.875c-3.85,0.964-6.769,3.921-7.77,7.607
										C9.636,43.719,16.824,48.009,25,48.009z"/>
									<path id="baseW" d="M33.682,29.666l-3.54-0.885c1.464-1.301,2.648-3.091,3.438-5.065c1.173-0.212,2.272-1.144,2.449-3.283
										c0.17-2.068-0.51-2.921-1.383-3.262c-0.023-0.661-0.108-1.275-0.142-1.854c-0.395-6.532-3.678-9.405-8.986-8.836
										c-0.696,0.075-1.377,0.118-2.068,0.006c-2.772-0.455-5.665,1.673-7.074,3.892c-1.825,2.873-1.128,6.73-1.133,6.857
										c-0.8,0.379-1.395,1.247-1.234,3.198c0.171,2.07,1.205,3.01,2.335,3.26c0.806,1.981,2.012,3.788,3.491,5.1l-3.511,0.875
										c-4.792,1.2-8.149,5.485-8.149,10.423v2.014c4.336,4.265,10.277,6.902,16.825,6.902s12.489-2.637,16.825-6.902v-2.013
										C41.824,35.153,38.472,30.866,33.682,29.666z"/>
									<path id="tShW" class="tShW" d="M10.044,40.093v2.37c1.216,1.043,2.538,1.965,3.954,2.739V32.719
										C11.592,34.331,10.044,37.063,10.044,40.093z"/>
									<path id="tShW2" class="tShW2" d="M39.955,40.092c0-3.006-1.512-5.717-3.883-7.333v12.404c1.389-0.766,2.687-1.673,3.883-2.698
										V40.092z"/>
									<path id="tShW3" class="tShW3" d="M25.693,47.207h-1.352l-6.437-15.991l4.02-1.012c0.946,0.454,1.96,0.71,3.02,0.71
										c1.098,0,2.142-0.261,3.109-0.726l4.088,1.036L25.693,47.207z"/>
									<circle id="btnW" cx="24.987" cy="42.095" r="1.068"/>
									<circle id="btnW2" cx="24.987" cy="38.286" r="1.068"/>
									<path id="bwtW" d="M28.164,31.795l-1.924,0.557c-0.03,0.007-0.059,0.015-0.09,0.02c-0.311-0.273-0.715-0.454-1.16-0.454
										s-0.848,0.18-1.16,0.454c-0.03-0.005-0.06-0.012-0.089-0.02l-1.917-0.558c-0.574-0.166-1.119,0.267-1.119,0.865v2.181
										c0,0.599,0.546,1.031,1.122,0.864l2.002-0.584c0.311,0.277,0.715,0.449,1.161,0.462c0.447-0.013,0.852-0.185,1.164-0.462
										l2.007,0.584c0.574,0.166,1.13-0.265,1.13-0.864v-2.181C29.292,32.06,28.739,31.629,28.164,31.795z"/>
									<path id="headW" class="headW" d="M17.093,18.241c0-0.275,0.041-0.545,0.122-0.809c0.217-0.703,0.496-1.304,0.772-1.792
										c0.478-0.844,1.252-1.482,2.172-1.789c0.028-0.009,0.056-0.019,0.083-0.028c0.324-0.111,0.68,0.012,0.866,0.298
										c0.186,0.286,0.153,0.663-0.079,0.913c-0.044,0.047-0.088,0.094-0.133,0.138c-0.14,0.145-0.172,0.364-0.079,0.542
										c0.094,0.179,0.292,0.277,0.49,0.244c1.94-0.32,5.338-1.171,7.894-3.375c0.678-0.584,1.694-0.526,2.301,0.132
										c0.575,0.625,0.947,1.4,1.074,2.24c0.143,0.938,0.219,2.026,0.219,3.285c0,4.894-3.502,10.805-7.852,10.805
										C20.595,29.045,17.093,23.135,17.093,18.241z"/>
									<path id="lghtHeadW" class="lghtHeadW" d="M25.282,17.004c-0.079-0.566-0.193-1.275-0.319-2.005c-1.389,0.514-2.7,0.803-3.656,0.961
										c-0.198,0.033-0.396-0.065-0.49-0.244c-0.094-0.179-0.062-0.397,0.079-0.542c0.045-0.045,0.089-0.092,0.133-0.138
										c0.233-0.25,0.266-0.627,0.079-0.913s-0.542-0.41-0.866-0.298c-0.027,0.009-0.055,0.019-0.083,0.028
										c-0.92,0.307-1.695,0.945-2.172,1.789c-0.276,0.488-0.555,1.089-0.772,1.792c-0.08,0.264-0.122,0.534-0.122,0.809
										c0,3.617,1.916,7.783,4.669,9.714C24.738,24.843,25.858,20.886,25.282,17.004z"/>
								</g>
							</svg>
						</a>
						<ul class="dropdown-menu menu-profile">
							<li>
								<div class="text-right">
									<p class="txt-name fnt__Bold">Usuario</p>
									<p class="txt-email fnt__Medium" id="idUsuario">Id usuario</p>
									<p class="txt-email fnt__Medium" id="idPerfil">Nombre Perfil</p>
								</div>
							</li>
							<li class="divider"></li>											
							<li>								
								<div class="pull-right">
									<div class="form-inline">										
										<button class="btn btn-raised btn-default btn-sm" onclick="opcionesPlaza()">Opciones</button>						
									</div>	
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</nav>
</header>
<section class="scroller-inner">
	<section id="content">
		<div class="fluid-container main-content">
			<?= Breadcrumbs::widget([
				'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			]) ?>
			<?= $content ?>
		</div>
	</section>
</section>
<div id="notificacionesDivModal" class="side-notifications">
	<div class="side-body">
		<div class="side-header">
			<span class="glyphicon glyphicon-refresh" onClick="realEntregar()"></span>
			<h3 class="side-title text-center fnt__Medium">Pedidos listos</h3>
		</div>
		<div class="list-group" id="listaEntrega">
			<div class="list-group-item" id="lgi1">
				<div class="row-picture" onClick="rowPicture(1)">
					<div class="item-icon-pl">
						<div class="not-item-icon"></div>
					</div>
					<div class="item-icon-pe">
						<svg version="1.1" id="iconCheck1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" style="" xml:space="preserve" class="icon-check">
							<path id="circle" class="circle xokfQlnb_0" d="M36.337,4.991C32.991,3.091,29.124,2,25,2C12.297,2,2,12.297,2,25c0,12.703,10.297,23,23,23
								s23-10.297,23-23c0-3.274-0.688-6.385-1.921-9.204"></path>
							<path id="check" class="check xokfQlnb_1" d="M47.599,6.084L26.945,35.449c-0.26,0.37-0.773,0.459-1.144,0.199L11.528,25.609
								c-1.203-0.846-1.493-2.513-0.647-3.716c0.423-0.602,1.051-0.975,1.724-1.092c0.673-0.117,1.39,0.022,1.992,0.445l8.526,5.997
								c0.549,0.386,1.216,0.536,1.878,0.42c0.662-0.115,1.239-0.481,1.625-1.031L43.236,3.015c0.846-1.203,2.513-1.493,3.716-0.647
								C48.154,3.214,48.445,4.881,47.599,6.084z"></path>
						</svg>
					</div>
				</div>
				<div class="row-content" id="rc1">
					<div class="item-desc">
						<h4 class="list-group-item-heading fnt__Medium">Mesa #1</h4>
						<div class="list-group-item-desc">
							<p class="list-group-item-text dis-inline-block">Plato</p>
							<p class="list-group-item-text dis-inline-block pull-right">x1</p>
						</div>
					</div>
					<div class="item-confirm-pe text-center">
						<h4 class="item-confirm-heading fnt__Medium">¿Confirmar entrega?</h4>
						<a href="#" class="btn btn-danger btn-radius btn-inline cancelPe" onClick="cancelPe(1)">
							<i class="material-icons">&#xE14C;</i>
						</a>
						<a href="#" class="btn btn-success btn-radius btn-inline aceptPe" onClick="aceptPe(1)">
							<i class="material-icons">&#xE876;</i>
						</a>
					</div>
				</div>
			</div>
			<div class="list-group-separator"></div>
			<div class="list-group-item" id="lgi2">
				<div class="row-picture" onClick="rowPicture(2)">
					<div class="item-icon-pl">
						<div class="not-item-icon"></div>
					</div>
					<div class="item-icon-pe">
						<svg version="1.1" id="iconCheck2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="50px" height="50px" viewBox="0 0 50 50" style="" xml:space="preserve" class="icon-check">
							<path id="circle" class="circle xokfQlnb_0" d="M36.337,4.991C32.991,3.091,29.124,2,25,2C12.297,2,2,12.297,2,25c0,12.703,10.297,23,23,23
								s23-10.297,23-23c0-3.274-0.688-6.385-1.921-9.204"></path>
							<path id="check" class="check xokfQlnb_1" d="M47.599,6.084L26.945,35.449c-0.26,0.37-0.773,0.459-1.144,0.199L11.528,25.609
								c-1.203-0.846-1.493-2.513-0.647-3.716c0.423-0.602,1.051-0.975,1.724-1.092c0.673-0.117,1.39,0.022,1.992,0.445l8.526,5.997
								c0.549,0.386,1.216,0.536,1.878,0.42c0.662-0.115,1.239-0.481,1.625-1.031L43.236,3.015c0.846-1.203,2.513-1.493,3.716-0.647
								C48.154,3.214,48.445,4.881,47.599,6.084z"></path>
						</svg>
					</div>
				</div>
				<div class="row-content" id="rc2">
					<div class="item-desc">
						<h4 class="list-group-item-heading fnt__Medium">Mesa #1</h4>
						<div class="list-group-item-desc">
							<p class="list-group-item-text dis-inline-block">Plato</p>
							<p class="list-group-item-text dis-inline-block pull-right">x1</p>
						</div>
					</div>
					<div class="item-confirm-pe text-center">
						<h4 class="item-confirm-heading fnt__Medium">¿Confirmar entrega?</h4>
						<a href="#" class="btn btn-danger btn-radius btn-inline cancelPe" onClick="cancelPe(2)">
							<i class="material-icons">&#xE14C;</i>
						</a>
						<a href="#" class="btn btn-success btn-radius btn-inline aceptPe" onClick="aceptPe(2)">
							<i class="material-icons">&#xE876;</i>
						</a>
					</div>
				</div>
			</div>
			<div class="list-group-separator"></div>
		</div>
	</div>
	<div class="btn-side-close" onClick="platosEntregar()">
		<a id="sideClose" class="icon-bell">
			<svg version="1.1" id="Ring_Bell" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="50px" height="50px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve">
				<g id="gCircle">
					<path id="circle" class="circle" d="M25,49.009C11.761,49.009,0.991,38.239,0.991,25S11.761,0.991,25,0.991S49.009,11.761,49.009,25
						S38.239,49.009,25,49.009z"/>
					<path id="shdwCircle" class="shdwCircle" d="M28.839,47.682C39.705,45.849,48.009,36.379,48.009,25c0-11.38-8.305-20.851-19.172-22.683
						C38.238,5.572,45.009,14.506,45.009,25C45.009,35.493,38.239,44.426,28.839,47.682z"/>
				</g>
				<g id="Bell">
					<path id="shdwB" class="shdwB" d="M34.745,34.272h-1.283c0-0.534-0.107-0.321-0.107-0.428c0-4.81-3.42,0.053-4.489-11.491v-2.084
						c0-4.222-3.26-7.696-7.482-7.696s-7.482,3.42-7.482,7.696v2.084c-1.069,11.597-4.489,6.681-4.489,11.544
						c0,0.107-0.107-0.107-0.107,0.428H8.022c-0.641,0-1.069,0.267-1.069,0.909v0.802c0,0.588,0.428,0.909,1.069,0.909h26.722
						c0.641,0,1.069-0.321,1.069-0.962V35.18C35.813,34.539,35.386,34.272,34.745,34.272z"/>
					<path id="clapper" class="clapper" d="M29.396,35.169v1.099c0,2.428-1.968,4.396-4.396,4.396c-0.566,0.004-1.128-0.108-1.648-0.33
						c-1.657-0.67-2.744-2.278-2.747-4.066v-1.099H29.396z"/>
					<path id="shdwCl" class="shdwCl" d="M28.646,36.269v-0.35h-2.547v0.349c-0.003,1.439-0.715,2.752-1.854,3.563
						c0.238,0.052,0.48,0.083,0.726,0.083h0.023C27.01,39.914,28.646,38.278,28.646,36.269z"/>
					<path id="shdwCl2" class="shdwCl2" d="M21.426,36.934c0.084,0.44,0.242,0.856,0.472,1.23h6.201c0.229-0.372,0.39-0.788,0.476-1.23
						H21.426z"/>
					<path id="asa" class="asa" d="M25.06,8.515c-1.294,0-2.372,1.078-2.372,2.372s0,2.662,2.372,2.662s2.372-1.368,2.372-2.662
						S26.354,8.515,25.06,8.515z"/>
					<path id="mdB" class="mdB" d="M37.945,33.595h-1.243c0-0.518-0.104-0.311-0.104-0.414c0-4.66-3.314,0.052-4.349-11.132v-2.019
						c0-4.09-3.158-7.456-7.249-7.456s-7.249,3.314-7.249,7.456v2.019c-1.036,11.236-4.349,6.472-4.349,11.184
						c0,0.104-0.104-0.104-0.104,0.414h-1.243c-0.621,0-1.036,0.259-1.036,0.88v0.777c0,0.57,0.414,0.88,1.036,0.88h25.889
						c0.621,0,1.036-0.311,1.036-0.932v-0.777C38.98,33.854,38.566,33.595,37.945,33.595z"/>
					<path id="shdwMd" class="shdwMd" d="M14.048,33.855v0.542h-1.993c-0.18,0-0.259,0.032-0.281,0.043
						c0.001,0.007-0.004,0.035-0.004,0.087v0.776c0.021,0.085,0.101,0.131,0.286,0.131h25.889c0.286,0,0.286-0.061,0.286-0.183v-0.776
						c0-0.059-0.008-0.087-0.011-0.097h-0.001c-0.012,0-0.091-0.033-0.274-0.033h-1.992v-0.517l-0.015-0.422H14.047L14.048,33.855z"/>
					<path id="lghtMd" class="lghtMd" d="M18.501,20.029v2.02c-0.647,7.057-2.221,8.224-3.391,9.03c7.845-1.553,11.899-6.905,12.168-12.81
						c0.066-1.224,0.104-3.116,0.091-4.495c-0.732-0.288-1.528-0.451-2.369-0.451C21.355,13.323,18.501,16.269,18.501,20.029z"/>
				</g>
				<g id="Close">
					<line id="dDer" class="st9" x1="15.666" y1="34.25" x2="34.25" y2="15.666"/>
					<line id="dIzq" class="st9" x1="34.25" y1="34.25" x2="15.666" y2="15.666"/>
				</g>
			</svg>
			<!--<div class="icon-bell">
				<?= Html::img('@web/img/bell.svg', ['alt' => 'bell', 'class' => 'img-circle img-responsive']) ?>
			</div>-->
		</a>
	</div>
</div>
	<?php $this->endBody() ?>
</body>
</html>
	<?php $this->endPage() ?>
<?= Html::jsFile('@web/js/main.js') ?>
<script>
	/*
	 * Detectar Navegador móvil
	 */
	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	   $('html').addClass('mobile');
	}
</script>
<script>
  $(function () {
    $.material.init();
	$('[data-toggle="tooltip"]').tooltip();
  });
</script>
<script>
	$("#sideOpen").click(function(){
		$(".side-notifications").addClass("side-visible");
		$(".btn-side-close").addClass("v-btn-close");		
	});
	$("#sideClose").click(function(){
		$(".side-notifications").toggleClass("side-visible");
		$(".btn-side-close").toggleClass("v-btn-close");
	});
	/*
	var self;
	$(".row-picture").click(function(){		
		self = $(this);
		// console.log(self);
		$(this).parent(".list-group-item").addClass("cheked");
		$(this).find("#iconCheck").addClass("start");
		$(this).next(".row-content").addClass("confirm");
	});
	// función para la confirmación de entrega
	$(".aceptPe").click(function(){
		$(self).next(".row-content").removeClass("confirm");
	});
	// función para la cancelación de entrega
	$(".cancelPe").click(function(){
		$(self).parent(".list-group-item").removeClass("cheked");
		$(self).find("#iconCheck").removeClass("start");
		// $(".list-group-item").find("#iconCheck").removeClass("start");
		$(self).next(".row-content").removeClass("confirm");
	});*/
	
	function rowPicture(id){
		$("#lgi"+id).addClass("cheked");
		$("#iconCheck"+id).addClass("start");
		$("#rc"+id).addClass("confirm");
	}
	
	function aceptPe(id){
		$("#rc"+id).removeClass("confirm");
		$("#lgi"+id).addClass("ok");
	}
	
	function cancelPe(id){
		$("#lgi"+id).removeClass("cheked");
		$("#lgi"+id).removeClass("ok");
		$("#iconCheck"+id).removeClass("start");
		// $(".list-group-item").find("#iconCheck").removeClass("start");
		$("#rc"+id).removeClass("confirm");
	}
</script>
<script>
		$('.ag-carousel.sec').flickity({
		  // options
		  setGallerySize: false,
		  cellAlign: 'left',
		  initialIndex: 0,
		  // contain: true,
		  pageDots: false,
		  dragThreshold: 10,
		});
		$('.ag-carousel').flickity({
		  // options
		  setGallerySize: false,
		  cellAlign: 'left',
		  initialIndex: 1,
		  // contain: true,
		  pageDots: false,
		  dragThreshold: 10,
		});		
</script>
