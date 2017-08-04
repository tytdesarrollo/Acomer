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
			<div class="main-content-unir-mesa">
				<div class="mrg__bottom-30">
					<div class="container-fluid">
						<div class="pull-right">
							<a href="#" id="cancelMesa" class="btn btn-raised btn-organge-grad btn-radius btn-inline">
								<i class="material-icons">&#xE317;</i>
							</a>
						</div>
					</div>
				</div>
				<div class="text-center">
					<h2 class="txt__light-70">Selecciona una mesa disponible para unir</h2>
				</div>
				<div class="content-unir-mesa">
					<div class="container">
						<div class="row">
							<div class="col-sm-6 col-md-6 divider">
								<ul class="list-mesa__libre text-center">
									<li class="mesa__libre">Mesa libre #1</li>
									<li class="mesa__libre">Mesa libre #2</li>
									<li class="mesa__libre">Mesa libre #2</li>
									<li class="mesa__libre">Mesa libre #4</li>
									<li class="mesa__libre">Mesa libre #5</li>
								</ul>
							</div>
							<div class="col-sm-6 col-md-6">
								<ul class="list-mesa__libre text-center">
									<li class="mesa__libre">Mesa libre #6</li>
									<li class="mesa__libre">Mesa libre #7</li>
									<li class="mesa__libre">Mesa libre #8</li>
									<li class="mesa__libre">Mesa libre #9</li>
									<li class="mesa__libre">Mesa libre #10</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="main-content-mesa">
				<div>
					<div class="container-fluid">
						<div class="pull-right">
							<a href="#" class="btn btn-raised btn-organge-grad btn-radius btn-inline">
								<i class="material-icons icon-btn">&#xE556;</i>Ver pedido
							</a>
							<a href="#" class="btn btn-raised btn-success btn-radius btn-inline">
								<i class="material-icons icon-btn">&#xE8B0;</i>Facturar
							</a>
						</div>
					</div>
				</div>
				<div class="main-content-puestos text-center">
					<div class="content-puestos mesax4p">
						<div class="content-mesa">
							<?= Html::img('@web/img/mesa_4_puestos.svg', ['alt' => 'Mesa 4 puestos', 'class' => 'img-responsive',]) ?>
							<div class="n-mesa">
								<span>#1</span>
							</div>
						</div>
						<div class="content__puesto-1">
							<?= Html::img('@web/img/puesto_left.svg', ['alt' => 'Puesto 1', 'class' => 'img-responsive',]) ?>
							<div class="puesto-libre">
								<div class="cnt">
									<span class="txt-puesto">Puesto</br>#1</span>
								</div>
							</div>
						</div>
						<div class="content__puesto-2">
							<?= Html::img('@web/img/puesto_top.svg', ['alt' => 'Puesto 2', 'class' => 'img-responsive',]) ?>
							<div class="puesto-libre">
								<div class="cnt">
									<span class="txt-puesto">Puesto</br>#2</span>
								</div>
							</div>
						</div>
						<div class="content__puesto-3">
							<?= Html::img('@web/img/puesto_right.svg', ['alt' => 'Puesto 3', 'class' => 'img-responsive',]) ?>
							<div class="puesto-libre">
								<div class="cnt">
									<span class="txt-puesto">Puesto</br>#3</span>
								</div>
							</div>
						</div>
						<div class="content__puesto-4">
							<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 4', 'class' => 'img-responsive',]) ?>
							<div class="puesto-libre">
								<div class="cnt">
									<span class="txt-puesto">Puesto</br>#4</span>
								</div>
							</div>
						</div>
					</div>
					<!--<div class="content-puestos mesax6p">
						<div class="content-mesa">
							<?= Html::img('@web/img/mesa_6_puestos.svg', ['alt' => 'Mesa 6 puestos', 'class' => 'img-responsive',]) ?>
							<div class="n-mesa">
								<span>#1</span>
							</div>
							<div class="n-mesa">
								<span>#2</span>
							</div>
						</div>
						<div class="content__puesto-1">
							<?= Html::img('@web/img/puesto_left.svg', ['alt' => 'Puesto 1', 'class' => 'img-responsive',]) ?>
							<div class="puesto-libre">
								<div class="cnt">
									<span class="txt-puesto">Puesto</br>#1</span>
								</div>
							</div>
						</div>
						<div class="content__puesto-2">
							<?= Html::img('@web/img/puesto_top.svg', ['alt' => 'Puesto 2', 'class' => 'img-responsive',]) ?>
							<div class="puesto-libre">
								<div class="cnt">
									<span class="txt-puesto">Puesto</br>#2</span>
								</div>
							</div>
						</div>
						<div class="content__puesto-3">
							<?= Html::img('@web/img/puesto_right.svg', ['alt' => 'Puesto 3', 'class' => 'img-responsive',]) ?>
							<div class="puesto-libre">
								<div class="cnt">
									<span class="txt-puesto">Puesto</br>#3</span>
								</div>
							</div>
						</div>
						<div class="content__puesto-4">
							<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 4', 'class' => 'img-responsive',]) ?>
							<div class="puesto-libre">
								<div class="cnt">
									<span class="txt-puesto">Puesto</br>#4</span>
								</div>
							</div>
						</div>
						<div class="content__puesto-5">
							<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 5', 'class' => 'img-responsive',]) ?>
							<div class="puesto-libre">
								<div class="cnt">
									<span class="txt-puesto">Puesto</br>#5</span>
								</div>
							</div>
						</div>
						<div class="content__puesto-6">
							<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 5', 'class' => 'img-responsive',]) ?>
							<div class="puesto-libre">
								<div class="cnt">
									<span class="txt-puesto">Puesto</br>#6</span>
								</div>
							</div>
						</div>
					</div>-->
					<!--<div class="content-puestos mesax8p">
						<div class="content-scroll-mesa">
							<div class="content-mesa">
								<?= Html::img('@web/img/mesa_8_puestos.svg', ['alt' => 'Mesa 6 puestos', 'class' => 'img-responsive',]) ?>
								<div class="n-mesa">
									<span>#1</span>
								</div>
								<div class="n-mesa">
									<span>#2</span>
								</div>
								<div class="n-mesa">
									<span>#3</span>
								</div>
							</div>
							<div class="content__puesto-1">
								<?= Html::img('@web/img/puesto_left.svg', ['alt' => 'Puesto 1', 'class' => 'img-responsive',]) ?>
								<div class="puesto-libre">
									<div class="cnt">
										<span class="txt-puesto">Puesto</br>#1</span>
									</div>
								</div>
							</div>
							<div class="content__puesto-2">
								<?= Html::img('@web/img/puesto_top.svg', ['alt' => 'Puesto 2', 'class' => 'img-responsive',]) ?>
								<div class="puesto-libre">
									<div class="cnt">
										<span class="txt-puesto">Puesto</br>#2</span>
									</div>
								</div>
							</div>
							<div class="content__puesto-3">
								<?= Html::img('@web/img/puesto_right.svg', ['alt' => 'Puesto 3', 'class' => 'img-responsive',]) ?>
								<div class="puesto-libre">
									<div class="cnt">
										<span class="txt-puesto">Puesto</br>#3</span>
									</div>
								</div>
							</div>
							<div class="content__puesto-4">
								<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 4', 'class' => 'img-responsive',]) ?>
								<div class="puesto-libre">
									<div class="cnt">
										<span class="txt-puesto">Puesto</br>#4</span>
									</div>
								</div>
							</div>
							<div class="content__puesto-5">
								<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 5', 'class' => 'img-responsive',]) ?>
								<div class="puesto-libre">
									<div class="cnt">
										<span class="txt-puesto">Puesto</br>#5</span>
									</div>
								</div>
							</div>
							<div class="content__puesto-6">
								<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 6', 'class' => 'img-responsive',]) ?>
								<div class="puesto-libre">
									<div class="cnt">
										<span class="txt-puesto">Puesto</br>#6</span>
									</div>
								</div>
							</div>
							<div class="content__puesto-7">
								<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 7', 'class' => 'img-responsive',]) ?>
								<div class="puesto-libre">
									<div class="cnt">
										<span class="txt-puesto">Puesto</br>#7</span>
									</div>
								</div>
							</div>
							<div class="content__puesto-8">
								<?= Html::img('@web/img/puesto_bottom.svg', ['alt' => 'Puesto 8', 'class' => 'img-responsive',]) ?>
								<div class="puesto-libre">
									<div class="cnt">
										<span class="txt-puesto">Puesto</br>#8</span>
									</div>
								</div>
							</div>
						</div>
					</div>-->
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
			$(".main-content-unir-mesa").addClass("in");
		});
		$(".mesa__libre").click(function(){
			$(".main-content-unir-mesa").addClass("out");
			$(".main-content-mesa").addClass("in");
		});
		$("#cancelMesa").click(function(){
			$(".main-content-unir-mesa").removeClass("in");
			$(".main-content-select-puestos").removeClass("out");
		});
	</script>
</body>
</html>
<?php $this->endPage() ?>