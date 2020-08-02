<?php

namespace kodcommerce\assets;

use ronashdkl\kodCms\assets\AppAsset;
use yii\web\AssetBundle;

class ProductVariationWidgetAsset extends AssetBundle
{

    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    public function init()
    {
        parent::init();
        $this->sourcePath = dirname(__FILE__) . "/../../clientAssets/dist";

    }

    public $js = [
        'variations.js'
    ];
    public $depends = [
        AppAsset::class
    ];
}