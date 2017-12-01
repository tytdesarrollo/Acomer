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
							<i class="material-icons">&#xE8FD;</i>
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
						<a href="#" data-toggle="dropdown" class="dropdown-toggle menu-trigger menu-user"><i class="btn-menu-profile glyphicon glyphicon-option-vertical icon__24"></i></a>
						<ul class="dropdown-menu menu-profile">
							<li>
								<div class="dis-inline-block">
									<p class="txt-name fnt__Medium">usuario</p>
									<p class="txt-email" id="idUsuario">Id usuario</p>
								</div>
								<div class="dis-inline-block pull-right">
									<div class="content-avatar__menu-profile">
										<?= Html::img('@web/img/avatar.png', ['alt' => 'avatar', 'class' => 'img-avatar img-circle']) ?>
									</div>
								</div>
							</li>
							<li class="divider"></li>	
							<li>
								<p class="txt-name fnt__Medium">Perfil</p>
								<p class="txt-email" id="idPerfil">Nombre Perfil</p>	
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
