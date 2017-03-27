<?php

namespace yii\bootstrap\material;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Bootstrap Material css and js files.
 *
 **/
class BootMaterialCssAsset extends AssetBundle
{
	public $sourcePath = '@bower/bootstrap-material-design/dist';
	public $css = [
		'css/bootstrap-material-design.css',
		'css/ripples.min.css'
	];
	public $depends = [
		'yii\bootstrap\BootstrapAsset',
	];
}
