<?php

namespace kodcommerce\assets;

use ronashdkl\kodCms\assets\AppAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class ProductVariationWidgetAsset extends AssetBundle
{

    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    public function init()
    {
        parent::init();
        $this->sourcePath = dirname(__FILE__) . "/../../clientAssets/dist";
        //$this->baseUrl = "http://localhost:8081/";

    }

    public $js = [
        'cart.js'
    ];
    public $depends = [
       JqueryAsset::class,
        JqueryUiAsset::class
    ];
}
