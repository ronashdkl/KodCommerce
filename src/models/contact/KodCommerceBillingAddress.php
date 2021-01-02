<?php


namespace kodCommerce\models\contact;


use kodcommerce\models\KodCommerceContact;
use ronashdkl\kodCms\components\FieldConfig;
use yii\helpers\VarDumper;

class KodCommerceBillingAddress extends KodCommerceContact
{
    public $isSameShippingAddress;
    public function init()
    {
        $this->type = self::TYPE_BILLING_ADDRESS;

}

public function rules()
{
    $rules = parent::rules();
    $rules[] = ['isSameShippingAddress','string'];
    return $rules;
}

public function formTypes()
{
    $types =  parent::formTypes();

    $types['isSameShippingAddress']= [
        'label'=>'',
        'type'=>FieldConfig::CHECKBOX,
        'data'=>[1=>\Yii::t('commerce','Use this address for my shipping information')]
    ];

    return $types;
}
}
