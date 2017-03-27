<?php

namespace yii\sweetalert;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Sweetalert css files.
 *
 */
class sweetalertAsset extends AssetBundle
{
	public $sourcePath = '@bower/sweetalert/dist';
	public $css = [
		'sweetalert.css',
	];
}
