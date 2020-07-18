<?php


namespace kodcommerce\widgets\assets;


use app\assets\AppAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class ProductImagesAsset extends AssetBundle
{
    public $sourcePath = '@kodcommerce/widgets/clientAssets';

    public $css = [
        'zoom.css',
        'product-images.css'
    ];
    public $js = [
        'zoom.js',
        'product-images.js'
    ];

    public $depends = [
     // AppAsset::class
    ];
}