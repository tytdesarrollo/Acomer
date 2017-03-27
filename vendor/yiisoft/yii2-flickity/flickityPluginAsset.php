<?php

namespace yii\flickity;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Flickity javascript files.
 *
 */
class flickityPluginAsset extends AssetBundle
{
	public $sourcePath = '@bower/flickity/dist';
	public $js = [
		'flickity.pkgd.min.js',
	];
	public $depends = [
        'yii\web\JqueryAsset',
        'yii\flickity\flickityAsset',
    ];
}
