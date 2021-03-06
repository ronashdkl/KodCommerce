<?php


namespace kodCommerce\services;

use Yii;
class Formatter
{
    public function register(){
        $config = Yii::$app->kodCommerceSetting;
        Yii::$app->set('formatter',[
            'class' => 'yii\i18n\Formatter',
            'locale' =>$config->fieldData['locale'], //ej. 'es-ES'
            'thousandSeparator' =>  $config->fieldData['thousandSeparator'],
            'decimalSeparator' => $config->fieldData['decimalSeparator'],
            'currencyCode' => $config->fieldData['currencyCode'],
            'nullDisplay' => '-',
            'dateFormat' =>  $config->fieldData['date_format'],
            'timeFormat' => 'H:i:s',
        ]);

    }
}
