<?php


namespace kodcommerce\assets;


use yii\web\AssetBundle;
use yii\web\JqueryAsset;

class JqueryUiAsset extends AssetBundle
{
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];
    public function init()
    {
        parent::init();
        $this->sourcePath = dirname(__FILE__)."/../../clientAssets/vendor/";
    }


    public $js = [
        'jquery-ui.js',

    ];
    public $css = [
        'jquery-ui.css',
        'cart.css',
    ];
    public $depends = [
        JqueryAsset::class
    ];
}
