<?php


namespace kodcommerce\widgets\assets;


use app\assets\AppAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class ProductImagesAsset extends AssetBundle
{
    public $sourcePath = '@kodcommerce/widgets/clientAssets';

    public $css = [
//        'http://localhost:8080/kod_product.css',
        'kod_product.css'
    ];
    public $js = [
//        'http://localhost:8080/kod_product.js'
        'kod_product.js'
    ];

    public $depends = [
     // AppAsset::class
    ];
}
