<?php


namespace kodCommerce\services;


use Yii;
use yii\helpers\VarDumper;

class RegisterModules
{
    public function register(){
        Yii::$app->setModule('commerce-admin',[
            'class'=>\kodCommerce\KodCommerceAdmin::class,
        ]);
        if(!Yii::$app->modules['commerce']){
            Yii::$app->setModule('commerce',[
                'class'=>\kodCommerce\KodCommerce::class,
            ]);
        }

        Yii::$app->set('kodCommerceSetting',\kodcommerce\models\KodCommerceSettingsModel::getInstance());
        Yii::$app->defaultRoute = Yii::$app->kodCommerceSetting->get('homepage')??'commerce';
        Yii::$app->urlManager->addRules(
            [
                'product/<slug>'=>'commerce/product',
                'catalog/<slug>'=>'commerce/category',
                'search'=>'commerce/search'
            ]
        );
    }

}
