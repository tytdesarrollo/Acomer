<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="main">
	<img src="img/plaza.png" alt="" class="img-responsive base">
	<div class="content-mesas">
		<div class="mesas mesa__1">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_0-9 null">
				<!--<?= Html::img('@web/img/not__id_1.svg', ['alt' => 'Mesa 1', 'class' => 'img-responsive',]) ?>-->
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not1"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__2">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_0-9 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not2"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__3">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_0-9 warning">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not3"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__4">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_0-9 danger">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not4"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__5">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_0-9 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not5"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__6">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_0-9 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not6"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__7">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_0-9 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not7"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__8">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_0-9 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not8"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__9">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_0-9 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not9"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__10">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_10-20 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not10"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__11">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_10-20 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not11"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__12">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_10-20 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not12"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__13">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_10-20 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not13"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__14">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_10-20 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not14"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__15">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_10-20 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not15"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__16">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_10-20 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not16"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__17">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_10-20 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not17"></use>
				</svg>
			</div>
		</div>
		<div class="mesas mesa__18">
			<img src="img/mesa.svg" alt="" class="img-responsive">
			<div class="notification text_10-20 null">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not18"></use>
				</svg>
			</div>
		</div>
		<div class="containers container__1">
			<div class="notification text_0-9 not-1 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not1-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-2 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not2-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-3 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not3-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-4 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not4-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-5 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not5-rest"></use>
				</svg>
			</div>
		</div>
		<div class="containers container__2">
			<div class="notification text_0-9 not-1 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not1-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-2 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not2-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-3 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not3-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-4 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not4-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-5 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not5-rest"></use>
				</svg>
			</div>
		</div>
		<div class="containers container__3">
			<div class="notification text_0-9 not-1 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not1-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-2 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not2-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-3 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not3-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-4 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not4-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-5 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not5-rest"></use>
				</svg>
			</div>
		</div>
		<div class="containers container__4">
			<div class="notification text_0-9 not-1 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not1-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-2 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not2-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-3 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not3-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-4 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not4-rest"></use>
				</svg>
			</div>
			<div class="notification text_0-9 not-5 full">
				<svg width="50" height="60">
				  <use xlink:href="img/notification_icons.svg#not5-rest"></use>
				</svg>
			</div>
		</div>
	</div>
</div>