<?php


namespace kodcommerce\models\attribute;


use ronashdkl\kodCms\components\FieldConfig;
use ronashdkl\kodCms\models\BaseModel;
use ronashdkl\kodCms\models\ListModel;

class KodCommerceProductAttributeListModel extends ListModel
{
public $name;
public $type;

public function rules()
{
    return [
        [['name','type'],'string']
    ];
}

public function formTypes()
{
    return [
        'name'=>[
            'type'=>FieldConfig::INPUT
        ],
        'type'=>[
            'type'=>FieldConfig::SELECT,
            'config'=>[
                'data'=>[FieldConfig::RADIO=>'Choose',FieldConfig::SELECT=>'Drop Down',FieldConfig::COLOR=>'Color']
            ]
        ]
    ];
}

    public function displayAttributes()
    {
       return ['name'];
    }
}