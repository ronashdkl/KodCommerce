<?php

namespace kodCommerce\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class KodCommerceAsset extends AssetBundle
{

    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    public function init()
    {
        parent::init();

        $this->sourcePath = dirname(__FILE__) . "/../../clientAssets/dist";
       // $this->baseUrl = "http://localhost:8081";

    }
    public $css = [
        'css/main.css',

    ];

    public $js = [
        'main.js',
        'jquery.sticky.js'
    ];
    public $depends = [
       JqueryAsset::class,
      CrudAsset::class
    ];
}
