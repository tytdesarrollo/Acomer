<?php

namespace yii\bootstrap\material;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Bootstrap Material css and js files.
 *
 */
class BootMaterialJsAsset extends AssetBundle
{
	public $sourcePath = '@bower/bootstrap-material-design/dist';
	public $js = [
		'js/ripples.min.js',
		'js/material.min.js',
	];
	public $depends = [
		'yii\web\JqueryAsset',
	];
}
