<?php
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Url;

AppAsset::register($this);

$this->title = '.:Autogestion:.';

$request = Yii::$app->request;

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
</head>
<body class='bg__grt-blue'>

<?php $this->beginBody() ?>

<div class="alert-login text-center">
 <?php echo Alert::widget([
    'options' => [
        'class' => 'alert-info',
    ],
    'body' => '<strong>Importante!</strong> Por favor escribe tu usuario de red sin dominio (NH/TELECOM) y seguido su clave de red.',
]);?>
</div>
 
 <div class="container text-center">

	<div class="row">
		<div class="col-md-12 text-right"><h2 class="txt__light-100"> </h2></div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div>
				<?= Html::img('@web/img/logo_ag.png', ['alt' => 'Auto Gestión Web']) ?>
			</div>
			<div>
				<h3 class="txt__light-100 mrg__top-30">Inicia sesión con tu cuenta</h3>
				<div class="text-left">
					<?php $form = ActiveForm::begin([
					"method" => "post",
					"id" => "login-form",
					"enableClientValidation" => false,
					"enableAjaxValidation" => true,
					]); 
					?>
						<?= $form->field($model, 'usuario', ['options' => ['class' => 'input-white form-group label-floating']])->textInput(['autofocus' => true]) ?>
						 <?= $form->field($model, 'clave', ['options' => ['class' => 'input-white form-group label-floating']])->passwordInput() ?>
						 <div class="text-right">
							<?= $recordar ?>
						 </div>
						<div class="form-group text-center mrg__top-15">
							<?= Html::submitButton('Ingresar', ['class' => 'btn btn-raised btn-info btn-block', 'name' => 'login-button']) ?>
						</div>
					<?php ActiveForm::end(); ?>
				</div>
			</div>
			<div class="pdg__16">
				<?= Html::img('@web/img/logo_telefonica.png', ['alt' => 'Telefónica']) ?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade modal-std modal-vertically-center" id="recordarpass" tabindex="-1" role="dialog" aria-labelledby="recordarpassLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3 class="modal-title fnt__Medium">Olvidaste tu contraseña?</h3>
			</div>
			<div class="modal-body">
				<div class="text-justify">
					<p>Por favor ingresa tu número de cédula y te enviaremos las instrucciones para restaurar tu contraseña al correo electrónico que tengas registrado en nómina.<br /> Gracias por utilizar este servicio.</p>
					<div class="clearfix"></div>
					<div class="form-group label-floating mrg__top-15">
						<label class="control-label" for="email">Cédula</label>
						<input class="form-control" id="email" type="text">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-primary">enviar</button>
			</div>
		</div>
	</div>
</div>
<footer class="footer-login text-center">
	<p class="txt__light-100">Power by Talentos & Tecnología</p>
</footer>

<?php $this->endBody() ?>

<script>
$(document).ready(function(){
history.pushState(null, "", "index.php");
});
</script>

<script>
  $(function () {
    $.material.init();
  });
</script>

<?php
if($request->get('activate')){
?>

<script>
 $(document).ready(function(){
			  swal({   title: "",   
			  text: <?php echo '"'.$request->get('activate').'"'; ?>,   
			  type: "warning",   showCancelButton: true,   
			  confirmButtonColor: "#0288D1",   
			  confirmButtonText: "Si, deseo activarlo!",   
			  cancelButtonText: "No activar aún",   
			  closeOnConfirm: false,   
			  closeOnCancel: false 
			  }, 
			  function(isConfirm){   
			  
			  if (isConfirm) {
				  
	   $.ajax({
       url: '<?php echo Url::toRoute(['site/activapassword', 'usuario' => $request->get('usuario'), 'operacion' => 'C']);?>',
       type: 'post',
       data: {'activate' : <?php echo '"'.$request->get('activate').'"'; ?>},
       success: function (data) {
          
		  if (data == 0){
                                        swal("", "A ocurrido un error al enviar las instrucciones a tu correo, por favor intenta de nuevo.", "error");  
										
								}
                                else{
																	
									swal("", data, "error");  
									
								}
						}
				});  
				  
			 // swal("", "Hemos enviado las instrucciones de activación al correo electrónico que tienes registrado en nómina, por favor revisa tu bandeja de entrada.", "success");   
			  } else {
			  swal("Cancelado", "Tu usuario aún no ha sido activado, por favor activalo.", "error");  
			  } 
			  });
  });
</script>

<?php }; ?>
<?php
if($request->get('error')){
?>

<script>
 $(document).ready(function(){
  swal(<?php echo '"'.$request->get('error').'"'; ?>, "", "error");
 });
</script>

<?php }; ?>
</body>
</html>
<?php $this->endPage() ?>