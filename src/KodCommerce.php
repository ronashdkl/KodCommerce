<?php
namespace kodCommerce;

use kodcommerce\assets\ProductVariationWidgetAsset;
use yii\filters\AccessControl;
use yii\web\View;

class KodCommerce extends \yii\base\Module
{
    public $id = 'commerce-admin';
    public $controllerNamespace = "kodCommerce\\frontend\\controllers";
    //public $viewPath = '@kodcommerce/frontend/views';
    public function init()
    {
        parent::init();

        $this->viewPath = '@kodcommerce/frontend/views';
        $this->layout = '@app/views/layouts/main';

        //kodCms-navigation

$this->registerAssets();
    }

    function registerAssets(){

        \Yii::$app->view->registerJs("var cartJsConfig = {
            summarySelector:'cart-items',
            addToCartButtonSelector:'add-to-cart-button',
            totalCartItemSelector:'cart-total-items',
            priceSelector:'item-price'
           
  };",View::POS_HEAD);
        \Yii::$app->view->registerAssetBundle(ProductVariationWidgetAsset::class);
    }
}
