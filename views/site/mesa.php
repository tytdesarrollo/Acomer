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

<?php 
	$this->beginPage() 
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
	<head>
	    <meta charset="<?= Yii::$app->charset ?>">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <?= Html::csrfMetaTags() ?>
	    <title><?= Html::encode($this->title) ?></title>
	    <?php $this->head() ?>
	</head>
	<body class='bg-acomer'>
	<?php $this->beginBody() ?>
		<div class="main-mesa">
			<div class="main-content-select-puestos">
				<div class="mrg__bottom-30">
					<div class="container-fluid">
						<div class="pull-right">
							<a href="#" class="btn btn-raised btn-organge-grad btn-radius btn-inline">
								<i class="material-icons">&#xE14C;</i>
							</a>
						</div>
					</div>
				</div>
				<div class="text-center">
					<h2 class="txt__light-70">Selecciona el número de puestos</h2>
				</div>
				<div class="content-select-puestos mrg__bottom-30">
					<div class="input-group">
						<span class="input-group-btn">
							<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="selectPuestos">
								<span class="glyphicon glyphicon-minus"></span>
							</button>
						</span>
						<input type="text" name="selectPuestos" class="form-control input-number" value="4" min="1" max="12">
						<span class="input-group-btn">
							<button type="button" class="btn btn-default btn-number plus" data-type="plus" data-field="selectPuestos">
								  <span class="glyphicon glyphicon-plus"></span>
							</button>
						</span>
					</div>
				</div>
				<div class="text-center">
					<a id="NPuestos" href="#" class="btn btn-raised btn-success btn-radius btn-inline">
						<i class="material-icons">&#xE5CA;</i>
					</a>
				</div>
			</div>
			<div class="main-content-mesa">
				<div>
					<div class="container-fluid">
						<div class="pull-right">
							<a href="#" class="btn btn-raised btn-organge-grad btn-radius btn-inline">
								<i class="material-icons icon-btn">&#xE56C;</i>Ver pedido
							</a>
							<a href="#" class="btn btn-raised btn-success btn-radius btn-inline">
								<i class="material-icons icon-btn">&#xE8B0;</i>Facturar
							</a>
						</div>
					</div>
				</div>
				<div class="main-content-puestos text-center">
					<div class="content-puestos">
						<div class="content-mesa">
						<?= Html::img('@web/img/mesa_4_puestos.svg', ['alt' => 'Mesa 4 puestos', 'class' => 'img-responsive mesax4p',]) ?>
						</div>
						<div class="content__puesto-1">
							<svg height="100%" width="100%">
							  <circle cx="50%" cy="50%" r="48%" fill="red" />
							</svg>
						</div>
						<div class="content__puesto-2">
							<svg height="100%" width="100%">
							  <circle cx="50%" cy="50%" r="48%" fill="red" />
							</svg>
						</div>
						<div class="content__puesto-3">
							<svg height="100%" width="100%">
							  <circle cx="50%" cy="50%" r="48%" fill="red" />
							</svg>
						</div>
						<div class="content__puesto-4">
							<svg height="100%" width="100%">
							  <circle cx="50%" cy="50%" r="48%" fill="red" />
							</svg>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php $this->endBody() ?>
	<script>
	  $(function () {
		$.material.init();
	  });
	</script>
	<script>
		$("#NPuestos").click(function(){
			$(".main-content-select-puestos").addClass("out");
			$(".main-content-mesa").addClass("in");
		});
	</script>
</body>
</html>
<?php $this->endPage() ?>