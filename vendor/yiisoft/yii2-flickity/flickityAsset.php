<?php

namespace yii\flickity;

use yii\web\AssetBundle;

/**
 * Asset bundle for the Flickity css files.
 *
 */
class flickityAsset extends AssetBundle
{
	public $sourcePath = '@bower/flickity/dist';
	public $css = [
		'flickity.css',
	];
}
