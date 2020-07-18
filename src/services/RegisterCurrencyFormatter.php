<?php


namespace kodCommerce\services;


use Yii;
use yii\base\InvalidConfigException;
use yii\i18n\Formatter;

class RegisterCurrencyFormatter
{

public function register(){
    try {

        \Yii::$app->set('formatter', [
            'class'=>Formatter::class,
            'dateFormat' => Yii::$app->kodCommerceSetting->get('date_format'),
            'locale' => Yii::$app->kodCommerceSetting->get('locale'),
            'decimalSeparator' => Yii::$app->kodCommerceSetting->get('decimalSeparator'),
            'thousandSeparator' => Yii::$app->kodCommerceSetting->get('thousandSeparator'),
            'currencyCode' => Yii::$app->kodCommerceSetting->get('currencyCode'),
        ]);
    } catch (InvalidConfigException $e) {
        \Yii::error($e->getMessage(),get_called_class());
    }
}
}