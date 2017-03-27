<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>
 
<a href="<?= Url::toRoute("site/create") ?>">Crear un nuevo alumno</a>
 
<?php $f = ActiveForm::begin([
    "method" => "get",
    "action" => Url::toRoute("site/view"),
    "enableClientValidation" => true,
]);
?>
 
<div class="form-group">
    <?= $f->field($form, "q")->input("search") ?>
</div>
 
<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"]) ?>
 
<?php $f->end() ?>
 
<h3><?= $search ?></h3>
 
<h3>Lists</h3>
<table class="table table-bordered">
    <tr>
        <th>Id </th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>ADS</th>
        <th>SDFASF </th>
        <th></th>
        <th></th>
    </tr>
    <?php foreach($model as $row): ?>
    <tr>
        <td><?= $row->id_alumno ?></td>
        <td><?= $row->nombre ?></td>
        <td><?= $row->apellidos ?></td>
        <td><?= $row->clase ?></td>
        <td><?= $row->nota_final ?></td>
        <td><a href="<?= Url::toRoute(["site/update", "id_alumno"=>$row->id_alumno])?>">Editar</a></td>
        <td>
            <a href="#" data-toggle="modal" data-target="#id_alumno_<?= $row->id_alumno ?>">Eliminar</a>
            <div class="modal fade" role="dialog" aria-hidden="true" id="id_alumno_<?= $row->id_alumno ?>">
                      <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Eliminar alumno</h4>
                              </div>
                              <div class="modal-body">
                                    <p>¿Realmente deseas eliminar al alumno con id <?= $row->id_alumno ?>?</p>
                              </div>
                              <div class="modal-footer">
                              <?= Html::beginForm(Url::toRoute("site/delete"), "POST") ?>
                                    <input type="hidden" name="id_alumno" value="<?= $row->id_alumno ?>">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                              <?= Html::endForm() ?>
                              </div>
                            </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </td>
    </tr>
    <?php endforeach ?>
</table>

<?= LinkPager::widget([
    "pagination" => $pages,
]);