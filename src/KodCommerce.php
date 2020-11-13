<?php

namespace kodCommerce;

use kodcommerce\assets\KodCommerceAsset;
use kodcommerce\events\KodCommerceCatalogLeftWidgetEvent;
use kodCommerce\frontend\controllers\CategoryController;
use yii\base\Event;
use yii\bootstrap4\Alert;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
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


        $this->setupPathMap();
        //kodCms-navigation

        $this->registerAssets();

    }

    private function setupPathMap()
    {
        \Yii::$app->view->theme->pathMap['@kodcommerce/widgets/views'] = ['@app/widgets/views', '@kodcommerce/widgets/views'];
        \Yii::$app->view->theme->pathMap['@kodcommerce/frontend/views'] = ['@app/views/commerce/', '@kodcommerce/frontend/views'];

    }

    function registerAssets()
    {

        \Yii::$app->view->registerAssetBundle(KodCommerceAsset::class);

        $config = $this->initCartConfig();

        $script = <<< JS
                    window.kodCommerce = {
                    variationConfig:null,
                    cartConfig: $config ,
                    }
                JS;
        \Yii::$app->view->registerJs($script, View::POS_HEAD);
    }

    private function initCartConfig()
    {
        $settings = \Yii::$app->get('kodCommerceSetting');
        return json_encode([
            'key' => 'cart',
            'priceFormatter' => [
                'currency' => $settings['fieldData']['currencyCode'],
                'thousandSeparator' => $settings['fieldData']['thousandSeparator'],
                'decimalSeparator' => $settings['fieldData']['decimalSeparator']

            ]
            ,
            'apiRoute' => [
                'controller' => "/en/commerce/cart-api",
                'indexAction' => "",
                'addAction' => "add",
                'removeAction' => "delete",
                'clearAction' => "clear",
            ],
            'errorMessage' => [
                'contentError' => "Oops, we haven't got JSON!",

            ]
        ]);
    }
}
