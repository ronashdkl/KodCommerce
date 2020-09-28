<?php


namespace kodCommerce\services;


use Yii;

class RegisterModules
{
    public function register(){
        Yii::$app->setModule('commerce-admin',[
            'class'=>\kodCommerce\KodCommerceAdmin::class,
        ]);
        Yii::$app->setModule('commerce',[
            'class'=>\kodCommerce\KodCommerce::class,
        ]);
        Yii::$app->set('kodCommerceSetting',\kodcommerce\models\KodCommerceSettingsModel::getInstance());
        Yii::$app->defaultRoute = Yii::$app->kodCommerceSetting->get('homepage')??'commerce';
        Yii::$app->urlManager->addRules(
            [
                'product/<slug>'=>'commerce/product',
                'search'=>'commerce/search'
            ]
        );
    }

}