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
	<script src="../web/js/modernizr.custom.js"></script>
</head>
<body class="bg-green cd-section">
	<?php $this->beginBody() ?>
	<?php @$events = $this->params['customParam']; ?>
<header id="header" class="clearfix">
	<nav id="menu" class="navbar">
		<div class="container-fluid">
			<!--<div class="content__icon-menu__ham pull-left">
				<a href="#" id="trigger" class="menu-trigger">
					<div class="line-wrap">
						<div class="line top"></div>
						<div class="line center"></div>
						<div class="line bottom"></div>
					</div>
				</a>
			</div>-->
			<div class="content__icon-menu__ham cd-modal-action pull-left">
				<a href="#" class="menu-trigger" data-type="modal-trigger">
					<div class="food-menu">
						<div class="item one">
							<?xml version="1.0" encoding="utf-8"?>
							<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
							<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 width="24px" height="24px" viewBox="12 12 24 24" enable-background="new 12 12 24 24" xml:space="preserve">
							<g>
								<path fill="#FFFFFF" d="M19.161,25.299l3.256-3.256l-8.07-8.07c-1.795,1.795-1.795,4.711,0,6.506
									C14.346,20.479,19.161,25.299,19.161,25.299z"/>
								
									<rect x="22.822" y="28.522" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 27.5311 70.7509)" fill="#FFFFFF" width="11.193" height="2.302"/>
							</g>
							</svg>
						</div>
						<div class="item two">
							<?xml version="1.0" encoding="utf-8"?>
							<!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
							<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 width="24px" height="24px" viewBox="12 12 24 24" enable-background="new 12 12 24 24" xml:space="preserve">
							<path fill="#FFFFFF" d="M26.966,23.211c1.754,0.823,4.234,0.242,6.063-1.588c2.203-2.203,2.623-5.349,0.938-7.035
								c-1.691-1.685-4.843-1.265-7.041,0.938c-1.829,1.829-2.404,4.308-1.588,6.063c-2.56,2.554-11.234,11.228-11.234,11.228l1.628,1.628
								C15.732,34.445,26.966,23.211,26.966,23.211z"/>
							</svg>
						</div>
					</div>
				</a>
				<span class="cd-modal-bg"></span>
			</div>
			<!--<div class="content__logo pull-left">
				<?= Html::img('@web/img/logo_small.svg', ['alt' => 'Auto Gestión Web', 'height' => '38px']) ?>
				<div class="hidden-xs" style="margin-top: 10px;"><p>Mesa Centro de servicios compartidos.</p></div>
			</div>-->
			<div class="pull-right">
				<div class="content__icon-menu__aux hidden-xxs">
					<a id="search" href="#" class="menu-trigger"><i class="material-icons icon__26">&#xE8B6;</i></a>
				</div>
				<div class="content__icon-menu__aux">
					<div id="avatar" class="content-avatar__nav hidden-xs">
						<?= Html::img('@web/img/avatar.png', ['alt' => 'avatar', 'class' => 'img-avatar img-circle']) ?>
					</div>
				</div>
				<div class="content__icon-menu__aux">
					<div class="dropdown">
						<a href="#" data-toggle="dropdown" class="dropdown-toggle menu-trigger"><i class="btn-menu-profile glyphicon glyphicon-option-vertical icon__24"></i></a>
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
	<div class="top-search-content"><div class="search-content"><i id="search-close" class="material-icons clear-icon">&#xE14C;</i><input type="text" class="search-input"><i class="material-icons search-icon">&#xE8B6;</i></div></div>
</header>
<div class="cd-modal">
	<div class="cd-modal-content">
		<ul class="food-menu-list text-center">
			<li>A la parrila</li>
			<li>Ensaladas</li>
			<li>Postres</li>
			<li>Bebidas</li>
		</ul>
		<div class="content-grid-products">
			<div class="grid-products">
				<div class="grid-item"></div>
				<div class="grid-item"></div>
				<div class="grid-item"></div>
				<div class="grid-item"></div>
			</div>
		</div>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab error reiciendis sapiente iure. Dolore, quo sed dolores ipsum necessitatibus asperiores illo sapiente velit magni accusantium fugit a natus expedita obcaecati!</p>
	</div>
</div>
<section class="scroller-inner">
	<aside class="mp-pusher" id="mp-pusher">
		<nav id="mp-menu" class="mp-menu">
			<div class="mp-level">
				<p></p>
				<ul>
					<li>
					<?= Html::a('<i class="material-icons">&#xE88A;</i><span>Inicio</span>', ['site/principal']) ?></li>
					<li>
					<?= Html::a('<i class="material-icons">&#xE7EF;</i><span>Equipo de nómina</span>', ['site/equiponomina']) ?></li>
					<li class="divider"></li>
					<li>
						<p class="category">Módulos</p>
					</li>
					<li>
					<?= Html::a('<i class="material-icons">&#xE873;</i><span>Certificado Laboral</span>', ['site/certificadolaboral']) ?></li>
					<li>
					<?= Html::a('<i class="material-icons">&#xE53E;</i><span>Comprobantes de pago</span>', ['site/comprobantespago']) ?></li>
					<li>
					<?= Html::a('<i class="material-icons">&#xE84F;</i><span>Certificado de ingresos y retención</span>', ['site/certificadosretencion']) ?></li>
					<li>
					<?= Html::a('<i class="material-icons">&#xEB48;</i><span>Vacaciones</span>', ['site/vacaciones']) ?></li>
					<li>
					<?= Html::a('<i class="material-icons">&#xE856;</i><span>Trabajo por turnos</span>', ['site/turnos']) ?></li>
					<!--<li>
					<?= Html::a('<i class="material-icons">&#xE3F3;</i><span>Incapacidades</span>', ['site/incapacidades']) ?></li>-->				
					<li class="divider"></li>
					<li>
						<p class="category">Información</p>
					</li>
					<li>
					<?= Html::a('<i class="material-icons">&#xE801;</i><span>Actualidad laboral</span>', ['site/actualidadlaboral']) ?></li>	
					<li>
					<?= Html::a('<i class="material-icons">&#xE916;</i><span>Cronográma cierre de nómina</span>', ['site/cronogramanomina']) ?></li>	
				</ul>
			</div>
		</nav>
	</aside>
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
<script src="../web/js/main.js"></script>
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
	$(".slide-box-back .btn-toggle").click(function(){
	  $(".container-v").toggleClass("sld-in");
	});
	$("#help").modal("show");
	$("#swipeUp").click(function(){
	  $("#modVac").addClass("open-swipeUp");
	});
	$("#swipeDown").click(function(){
	  $("#modVac").removeClass("open-swipeUp");
	});
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
<script>
	(function(){
        $('body').on('click', '#search', function(e){
            e.preventDefault();

            $('#header').addClass('search-toggled');
            $('.top-search-content input').focus();
        });

        $('body').on('click', '#search-close', function(e){
            e.preventDefault();

            $('#header').removeClass('search-toggled');
        });
    })();
</script>
<script>
	// new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ), {
		// type : 'cover'
	// } );
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
<script>
	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev',
				center: 'title',
				right: 'next'
			},
			height: 'auto',
			businessHours: true,
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			selectOverlap: false,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
				$('#ModalAdd').modal('show');
				
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');
					
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			
			<?php
				if(isset($events)){			
			?>

			events: [
			
			<?php
								
			foreach($events as $event): 
			
				$start = explode(" ", $event['START']);
				$end = explode(" ", $event['END']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['START'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['END'];
				}
			?>
				{
					id: '<?php echo $event['ID']; ?>',
					title: '<?php echo $event['TITLE']; ?>',
					start: '<?php echo $start; ?>',
					end: '<?php echo $end; ?>',
					color: '<?php echo $event['COLOR']; ?>',
					overlap: false,
					
					
				},
						
			<?php endforeach; ?>
					
			]
			
			<?php }; ?>
		});
		
		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Registro actualizado');
					}else{
						alert('El registro no fue guardado, intente de nuevo.'); 
					}
				}
			});
		}
		
	});

</script>
