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
<html lang="<?= Yii::$app->language ?>" class="no-js">
	<head>
	    <meta charset="<?= Yii::$app->charset ?>">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <?= Html::csrfMetaTags() ?>
	    <title><?= Html::encode($this->title) ?></title>
	    <?php $this->head() ?>
		<script src="js/modernizr-custom.js"></script>
	</head>
	<body class='bg-acomer'>
	<?php $this->beginBody() ?>
		<div class="compare-basket">
			<button class="actions action--button action--compare"><i class="fa fa-check"></i><span class="action__text">Agregar al pedido</span></button>
		</div>
		<div class="content-main">
			<div id="slideshow" class="slideshow">
				<div class="slide">
					<h2 class="slide__title slide__title--preview">Comida a la Parrilla</h2>
					<div class="slide__item">
						<div class="slide__inner">
							<img class="slide__img slide__img--small" src="img/categorias/parrilla.png" alt="Carnes a la Parrilla" />
							<button class="action action--open" aria-label="View details"><i class="material-icons">&#xE145;</i></button>
						</div>
					</div>
					<div class="slide__content">
						<div class="slide__content-scroller">
							<div class="slide__details">
								<h2 class="slide__title slide__title--main">Comida a la Parrilla</h2>
								<p class="slide__description">Descripción comida a la parrilla</p>
							</div><!-- /slide__details 1 -->
							<div class="content">
								<div class="grid">
									<div class="product">
										<div class="product__info">
											<img class="product__image" src="img/items/carne.png" alt="Carne" />
											<h3 class="product__title">Churrasco</h3>
											<span class="product__year extra highlight">2011</span>
											<span class="product__region extra highlight">Douro</span>
											<span class="product__varietal extra highlight">Touriga Nacional</span>
											<span class="product__alcohol extra highlight">13%</span>
											<span class="product__price highlight">$55.000</span>
											<div class="content-count" id="0">
												<div class="input-group">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
															<span class="glyphicon glyphicon-minus"></span>
														</button>
													</span>
													<input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default btn-number plus" data-type="plus" data-field="quant[1]">
															  <span class="glyphicon glyphicon-plus"></span>
														</button>
													</span>
												</div>
											</div>
											<label class="actions action--button action--compare-add" id="45"><input class="check-hidden" type="checkbox" /><i class="fa fa-plus"></i><i class="fa fa-check"></i><span class="action__text">Agregar</span></label>
										</div>
									</div><!-- /product 1 -->
									<div class="product">
										<div class="product__info">
											<img class="product__image" src="img/items/carne.png" alt="Carne" />
											<h3 class="product__title">Punta de Anca</h3>
											<span class="product__year extra highlight">2013</span>
											<span class="product__region extra highlight">California</span>
											<span class="product__varietal extra highlight">Pinot Noir</span>
											<span class="product__alcohol extra highlight">12%</span>
											<span class="product__price highlight">$19.000</span>
											<div class="content-count" id="1">
												<div class="input-group">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[2]">
															<span class="glyphicon glyphicon-minus"></span>
														</button>
													</span>
													<input type="text" name="quant[2]" class="form-control input-number" value="1" min="1" max="10">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default btn-number plus" data-type="plus" data-field="quant[2]">
															  <span class="glyphicon glyphicon-plus"></span>
														</button>
													</span>
												</div>
											</div>										
											<label class="actions action--button action--compare-add"><input class="check-hidden" type="checkbox" /><i class="fa fa-plus"></i><i class="fa fa-check"></i><span class="action__text">Agregar</span></label>
										</div>
									</div><!-- /product 2 -->
									<div class="product">
										<div class="product__info">
											<img class="product__image" src="img/items/carne.png" alt="Carne" />
											<h3 class="product__title">Baby Beef</h3>
											<span class="product__year extra highlight">2013</span>
											<span class="product__region extra highlight">Argentina</span>
											<span class="product__varietal extra highlight">Cabernet Sauvignon </span>
											<span class="product__alcohol extra highlight">12%</span>
											<span class="product__price highlight">$15.000</span>
											<div class="content-count" id="2">
												<div class="input-group">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[3]">
															<span class="glyphicon glyphicon-minus"></span>
														</button>
													</span>
													<input type="text" name="quant[3]" class="form-control input-number" value="1" min="1" max="10">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default btn-number plus" data-type="plus" data-field="quant[3]">
															  <span class="glyphicon glyphicon-plus"></span>
														</button>
													</span>
												</div>
											</div>										
											<label class="actions action--button action--compare-add"><input class="check-hidden" type="checkbox" /><i class="fa fa-plus"></i><i class="fa fa-check"></i><span class="action__text">Agregar</span></label>
										</div>
									</div><!-- /product 3 -->
									<div class="product">
										<div class="product__info">
											<img class="product__image" src="img/items/carne.png" alt="Carne" />
											<h3 class="product__title">Roast Beef</h3>
											<span class="product__year extra highlight">2012</span>
											<span class="product__region extra highlight">Washington</span>
											<span class="product__varietal extra highlight">Sangiovese</span>
											<span class="product__alcohol extra highlight">13%</span>
											<span class="product__price highlight">$85.000</span>
											<div class="content-count" id="3">
												<div class="input-group">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[4]">
															<span class="glyphicon glyphicon-minus"></span>
														</button>
													</span>
													<input type="text" name="quant[4]" class="form-control input-number" value="1" min="1" max="10">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default btn-number plus" data-type="plus" data-field="quant[4]">
															  <span class="glyphicon glyphicon-plus"></span>
														</button>
													</span>
												</div>
											</div>										
											<label class="actions action--button action--compare-add"><input class="check-hidden" type="checkbox" /><i class="fa fa-plus"></i><i class="fa fa-check"></i><span class="action__text">Agregar</span></label>
										</div>
									</div><!-- /product 4 -->
								</div><!-- grid -->
							</div><!-- content -->
							<section class="compare">
								<button class="actions action--close-compare"><i class="fa fa-remove"></i><span class="action__text action__text--invisible">Close comparison overlay</span></button>
							</section>
						</div><!-- slide__content-scroller 1 -->
					</div><!-- slide__content 1 -->
				</div>
				<div class="slide">
					<h2 class="slide__title slide__title--preview">Comida Rápida</h2>
					<div class="slide__item">
						<div class="slide__inner">
							<img class="slide__img slide__img--small" src="img/categorias/rapida.png" alt="Comida Rápida" />
							<button class="action action--open" aria-label="View details"><i class="material-icons">&#xE145;</i></button>
						</div>
					</div>
					<div class="slide__content">
						<div class="slide__content-scroller">
							<div class="slide__details">
								<h2 class="slide__title slide__title--main">Comida Rápida</h2>
								<p class="slide__description">Descripción comida a la Rápida</p>
							</div><!-- /slide__details 1 -->
							<div class="content">
								<div class="grid">
									<div class="product">
										<div class="product__info">
											<img class="product__image" src="img/items/hamburguesa.png" alt="Hamburguesa" />
											<h3 class="product__title">Hamburguesa</h3>
											<span class="product__year extra highlight">2011</span>
											<span class="product__region extra highlight">Douro</span>
											<span class="product__varietal extra highlight">Touriga Nacional</span>
											<span class="product__alcohol extra highlight">13%</span>
											<span class="product__price highlight">$15.000</span>
											<div class="content-count" id="4">
												<div class="input-group">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[5]">
															<span class="glyphicon glyphicon-minus"></span>
														</button>
													</span>
													<input type="text" name="quant[5]" class="form-control input-number" value="1" min="1" max="10">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default btn-number plus" data-type="plus" data-field="quant[5]">
															  <span class="glyphicon glyphicon-plus"></span>
														</button>
													</span>
												</div>
											</div>
											<label class="actions action--button action--compare-add"><input class="check-hidden" type="checkbox" /><i class="fa fa-plus"></i><i class="fa fa-check"></i><span class="action__text">Agregar</span></label>
										</div>									
									</div><!-- /product 1 -->
									
									<div class="product">
										<div class="product__info">
											<img class="product__image" src="img/items/hamburguesa.png" alt="Hot Dog" />
											<h3 class="product__title">Hot Dog</h3>
											<span class="product__year extra highlight">2013</span>
											<span class="product__region extra highlight">California</span>
											<span class="product__varietal extra highlight">Pinot Noir</span>
											<span class="product__alcohol extra highlight">12%</span>
											<span class="product__price highlight">$10.000</span>
											<div class="content-count" id="5">
												<div class="input-group">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[6]">
															<span class="glyphicon glyphicon-minus"></span>
														</button>
													</span>
													<input type="text" name="quant[6]" class="form-control input-number" value="1" min="1" max="10">
													<span class="input-group-btn">
														<button type="button" class="btn btn-default btn-number plus" data-type="plus" data-field="quant[6]">
															  <span class="glyphicon glyphicon-plus"></span>
														</button>
													</span>
												</div>
											</div>										
											<label class="actions action--button action--compare-add"><input class="check-hidden" type="checkbox" /><i class="fa fa-plus"></i><i class="fa fa-check"></i><span class="action__text">Agregar</span></label>
										</div>
									</div><!-- /product 2 -->
									<div class="product">
										<div class="product__info">
											<img class="product__image" src="img/items/hamburguesa.png" alt="Pizza" />
											<h3 class="product__title">Pizza</h3>
											<span class="product__year extra highlight">2013</span>
											<span class="product__region extra highlight">Argentina</span>
											<span class="product__varietal extra highlight">Cabernet Sauvignon </span>
											<span class="product__alcohol extra highlight">12%</span>
											<span class="product__price highlight">$12.000</span>
											<label class="actions action--button action--compare-add"><input class="check-hidden" type="checkbox" /><i class="fa fa-plus"></i><i class="fa fa-check"></i><span class="action__text">Agregar</span></label>
										</div>
									</div><!-- /product 3 -->
									<div class="product">
										<div class="product__info">
											<img class="product__image" src="img/items/hamburguesa.png" alt="Sandwish" />
											<h3 class="product__title">Sandwish</h3>
											<span class="product__year extra highlight">2012</span>
											<span class="product__region extra highlight">Washington</span>
											<span class="product__varietal extra highlight">Sangiovese</span>
											<span class="product__alcohol extra highlight">13%</span>
											<span class="product__price highlight">$15.000</span>
											<label class="actions action--button action--compare-add"><input class="check-hidden" type="checkbox" /><i class="fa fa-plus"></i><i class="fa fa-check"></i><span class="action__text">Agregar</span></label>
										</div>
									</div><!-- /product 4 -->
								</div><!-- grid -->
							</div><!-- content -->
							<section class="compare">
								<button class="actions action--close-compare"><i class="fa fa-remove"></i><span class="action__text action__text--invisible">Close comparison overlay</span></button>
							</section>
						</div><!-- slide__content-scroller 2 -->
					</div><!-- slide__content 2 -->
				</div>
				<div class="slide">
					<h2 class="slide__title slide__title--preview">Comida Oriental</h2>
					<div class="slide__item">
						<div class="slide__inner">
							<img class="slide__img slide__img--small" src="img/categorias/oriental.png" alt="Comida Oriental" />
							<button class="action action--open" aria-label="View details"><i class="material-icons">&#xE145;</i></button>
						</div>
					</div>
					<div class="slide__content">
						<div class="slide__content-scroller">
							<img class="slide__img slide__img--large" src="img/categorias/oriental.png" alt="Comida Oriental" />
							<div class="slide__details">
								<h2 class="slide__title slide__title--main">Jojoba Skin Oil</h2>
								<p class="slide__description">Protection for sensitive skin</p>
								<div>
									<span class="slide__price slide__price--large">$35</span>
									<button class="button button--buy">Add to cart</button>
								</div>
							</div><!-- /slide__details 3 -->
						</div><!-- slide__content-scroller 3 -->
					</div><!-- slide__content 3 -->
				</div>
				<div class="slide">
					<h2 class="slide__title slide__title--preview">Bebidas</h2>
					<div class="slide__item">
						<div class="slide__inner">
							<img class="slide__img slide__img--small" src="img/categorias/bebidas.png" alt="Bebidas" />
							<button class="action action--open" aria-label="View details"><i class="material-icons">&#xE145;</i></button>
						</div>
					</div>
					<div class="slide__content">
						<div class="slide__content-scroller">
							<img class="slide__img slide__img--large" src="img/categorias/bebidas.png" alt="Bebidas" />
							<div class="slide__details">
								<h2 class="slide__title slide__title--main">Amaranth Skin Oil</h2>
								<p class="slide__description">Rich hydration for mature skin</p>
								<div>
									<span class="slide__price slide__price--large">$29</span>
									<button class="button button--buy">Add to cart</button>
								</div>
							</div><!-- /slide__details 4 -->
						</div><!-- slide__content-scroller 4 -->
					</div><!-- slide__content 4 -->
				</div>
				<div class="slide">
					<h2 class="slide__title slide__title--preview">Postres</h2>
					<div class="slide__item">
						<div class="slide__inner">
							<img class="slide__img slide__img--small" src="img/categorias/postres.png" alt="Postres" />
							<button class="action action--open" aria-label="View details"><i class="material-icons">&#xE145;</i></button>
						</div>
					</div>
					<div class="slide__content">
						<div class="slide__content-scroller">
							<img class="slide__img slide__img--large" src="img/categorias/postres.png" alt="Postres" />
							<div class="slide__details">
								<h2 class="slide__title slide__title--main">Argan Skin Oil</h2>
								<p class="slide__description">Moisture for problematic &amp; dry skin</p>
								<div>
									<span class="slide__price slide__price--large">$59</span>
									<button class="button button--buy">Add to cart</button>
								</div>
							</div><!-- /slide__details 5 -->
						</div><!-- slide__content-scroller 5 -->
					</div><!-- slide__content 5 -->
				</div>
				<button class="action action--close" aria-label="Close"><i class="material-icons">&#xE317;</i></button>
			</div>
		</div>
	<?php $this->endBody() ?>
		<script>
			(function() {
				var slideshow = new CircleSlideshow(document.getElementById('slideshow'));
			})();
		</script>
	</body>
</html>
<?php $this->endPage() ?>