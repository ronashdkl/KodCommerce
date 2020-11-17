<?php


namespace kodcommerce\models;


use kodCommerce\KodCommerceHooks;
use ronashdkl\kodCms\components\FieldConfig;
use ronashdkl\kodCms\models\BaseModel;
use yii\helpers\ArrayHelper;

class KodCommerceSettingsModel extends BaseModel
{
    public $fieldData;
    public $loadFromDb = true;
    public $isMultilanguage = true;
    public $listAttribute = null;

    public function rules()
    {
        return [
            ['fieldData', 'safe']
        ];
    }

    public function formTypes()
    {

        return \Yii::$app->hooks->apply_filters(KodCommerceHooks::SETTING_FIELDS, [
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
            'fieldData[catalog][label][quick_view]' => [
                'type' => FieldConfig::INPUT,
                'value'=>'Quick View',
                'group' => 'local',
                'label'=>'Quick View Label',
            ],
            'fieldData[catalog][display][grid]' => [
                'type' => FieldConfig::RADIO,
                'data'=>[3=>'Three',5=>'Five'],
                'value'=>'3',
                'label'=> 'Number of catalog products grids',
            ],
            'fieldData[catalog][display][empty]' => [
                'type' => FieldConfig::INPUT,
                'label'=> 'Empty List text',
                'group' => 'display',
            ],
           'fieldData[catalog][widgets][content]' => [
                'type' => FieldConfig::CHECKBOX,
                'data'=> $this->getCommerceWidgets(KodCommerceHooks::RENDER_PRODUCT_CONTENT),
                'label'=> 'Product Widgets',

                'group' => 'widget',
            ],
            'fieldData[catalog][widgets][catalog][top]' => [
                'type' => FieldConfig::CHECKBOX,
                'data'=> $this->getCommerceWidgets(KodCommerceHooks::RENDER_CATEGORY_TOP_WIDGETS),
                'label'=> 'Category Top Widgets',

                'group' => 'widget',
            ],
            'fieldData[catalog][widgets][catalog][left]' => [
                'type' => FieldConfig::CHECKBOX,
                'data'=> $this->getCommerceWidgets(KodCommerceHooks::RENDER_CATEGORY_LEFT_WIDGETS),
                'label'=> 'Category Left Widgets',

                'group' => 'widget',
            ],
            'fieldData[catalog][widgets][catalog][bottom]' => [
                'type' => FieldConfig::CHECKBOX,
                'data'=> $this->getCommerceWidgets(KodCommerceHooks::RENDER_CATEGORY_BOTTOM_WIDGETS),
                'label'=> 'Category Bottom Widgets',

                'group' => 'widget',
            ],


        ]);

    }
    function getCommerceWidgets($hooks){
       $widgets =  \Yii::$app->hooks->apply_filters($hooks, []);
       return ArrayHelper::map($widgets,'class','name');
    }

    public function get($fieldName)
    {
        return ArrayHelper::getValue($this->fieldData, $fieldName);
    }

    public function activeWidgets($name)
    {
        $widgets = $this->get('catalog.widgets.'.$name);
        if(!is_array($widgets)){
            $widgets = [];
        }
        return $widgets;
    }

    public function set($fieldName, $value)
    {
        $this->fieldData[$fieldName] = $value;
        $this->save();
    }


}
