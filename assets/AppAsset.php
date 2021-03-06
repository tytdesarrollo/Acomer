<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto:300,400,500',
        'css/site.css',
		'css/fullcalendar.css',
		'css/menu-cat.css',
		'css/style-order.css',
		'css/dataTables.bootstrap4.css',
    ];
    public $js = [
		// 'js/modernizr-custom.js',
		'js/classie.js',
		'js/moment.min.js',
		'js/fullcalendar.min.js',
		'js/velocity.min.js',
		'js/dynamics.min.js',
		'js/main-menu.js',
		'js/order.js',
		'js/countspin.js',
		'js/jquery.dataTables.js',
		'js/dataTables.bootstrap4.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
		'yii\bootstrap\BootMaterialCssAsset',
        'yii\bootstrap\BootMaterialJsAsset',
		'yii\flickity\flickityPluginAsset',
		'yii\sweetalert\sweetalertPluginAsset',
    ];
}
