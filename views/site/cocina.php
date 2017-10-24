<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="row">
	<div class="col-sm-6 pedidos_list-view">
		<div class="content-pedido__item">
			<div class="pedido__item">
				<div class="lb-m">
					<span>Mesa #1</span>
				</div>
				<div class="pedido__item-info">
					<p class="fnt__Medium">Churrasco</p>
				</div>
				<a href="#" class="pedido__item-cnt-btn">
					<i class="material-icons">&#xE876;</i>
				</a>
				<div class="pedido__item-mesa">
					<i class="n"><span>x</span>1</i>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-6 text-center">
		<div class="content-pedido__detail">
			<h3 class="text-center fnt__Medium pedido__view-title">Nombre del plato</h3>
			<div class="pedido__detail-img">
				<img src="img/items/hamburguesa.png" alt="Imagen plato" class="img-responsive">
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