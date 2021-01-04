<?php

namespace kodCommerce\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class KodCommerceVenderAsset extends AssetBundle
{

    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    public function init()
    {
        parent::init();

        $this->sourcePath = dirname(__FILE__) . "/../../clientAssets/vendor";
       // $this->baseUrl = "http://localhost:8081";

    }
    public $css = [


    ];

    public $js = [

        'jquery.sticky.js'
    ];
    public $depends = [
       JqueryAsset::class,
      CrudAsset::class
    ];
}
