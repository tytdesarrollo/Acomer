<?php

namespace yii\sweetalert;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Sweetalert javascript files.
 *
 */
class sweetalertPluginAsset extends AssetBundle
{
	public $sourcePath = '@bower/sweetalert/dist';
	public $js = [
		'sweetalert.min.js',
	];
	public $depends = [
        'yii\web\JqueryAsset',
        'yii\sweetalert\sweetalertAsset',
    ];
}
