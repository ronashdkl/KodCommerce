<?php


namespace kodcommerce\models;


use ronashdkl\kodCms\components\FieldConfig;
use ronashdkl\kodCms\models\BaseModel;
use yii\helpers\ArrayHelper;

class KodCommerceSettingsModel extends BaseModel
{
    public $fieldData;
    public $loadFromDb = true;
    public $isMultilanguage = false;
    public $listAttribute = null;

    public function rules()
    {
        return [
            ['fieldData', 'safe']
        ];
    }

    public function formTypes()
    {

        return \Yii::$app->hooks->apply_filters('kodCommerce_setting_fields', [
            'fieldData[date_format]' => [
                'type' => FieldConfig::INPUT,
                'value'=>'dwd',
                'group' => 'local',
                'label'=>'DateFormat',
            ],
            'fieldData[locale]' => [
                'type' => FieldConfig::INPUT,
                'group' => 'local',
                'label'=>'Locale'
            ],
            'fieldData[decimalSeparator]' => [
                'type' => FieldConfig::INPUT,
                'group' => 'local',
                'label'=>'Decimal Separator'
            ], 'fieldData[thousandSeparator]' => [
                'type' => FieldConfig::INPUT,
                'group' => 'local',
                'label'=>'Thousand Separator'
            ], 'fieldData[currencyCode]' => [
                'type' => FieldConfig::INPUT,
                'group' => 'local',
                'label'=>'Currency Code'
            ],
            'fieldData[cart][dropdown][toggle-tag]' => [
                'type' => FieldConfig::INPUT,
                'group' => 'cart',
                'label'=>'Tag for Cart Dropdown Toggle'
            ],
            'fieldData[cart][dropdown][toggle-tag-class]' => [
                'type' => FieldConfig::INPUT,
                'group' => 'cart',
                'label'=>'Class for Cart Dropdown Toggle Tag'
            ],
            'fieldData[cart][dropdown][toggle-tag-text]' => [
                'type' => FieldConfig::INPUT,
                'group' => 'cart',
                'label'=>'Text for Cart Dropdown Toggle Tag'
            ],
            'fieldData[cart][dropdown][li-tag-class]' => [
                'type' => FieldConfig::INPUT,
                'group' => 'cart',
                'label'=>'Class for Cart Dropdown li Tag'
            ],

        ]);
    }

    public function get($fieldName)
    {
        return ArrayHelper::getValue($this->fieldData, $fieldName);
    }

    public function set($fieldName, $value)
    {
        $this->fieldData[$fieldName] = $value;
        $this->save();
    }


}