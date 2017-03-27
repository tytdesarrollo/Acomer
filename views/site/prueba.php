<?php
	use yii\helpers\Url;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
	use yii\data\Pagination;
	use yii\widgets\LinkPager; //links de paginacion
?>

<a href="<?= Url::toRoute("site/create")?>">Crea rnuevo alumno</a>

<?php
	$f = ActiveForm::begin([
			"method" => "get",
			"action" => Url::toRoute("site/view"),
			"enableClientValidation" => true
		]);
?>
	<div class="form-group">
		<?= $f->field($form, "q")->input("search") ?>		
	</div>

	<?= Html::submitButton("Buscar",["class" => "btn btn-primary"]) ?>

<?php $f->end() ?>

<h3><?= $search ?></h3>

<h1>Lista de </h1>
<table class="table table-bordered">
	<tr>
		<th>Id </th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Clase</th>


	</tr>

	<?php foreach($model as $row): ?>
		<tr>
			<td><?=$row->TERCOD?></td>
			<td><?=$row->TERRAZ?></td>
			<td><?=$row->TERDIR?></td>
			<td><?=$row->TERTEL?></td>


		</tr>
	<?php endforeach ?>
</table>
<?= LinkPager::widget([
	"pagination" => $pages
]);?>