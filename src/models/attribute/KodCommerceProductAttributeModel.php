<?php


namespace kodcommerce\models\attribute;



use ronashdkl\kodCms\models\BaseModel;

class KodCommerceProductAttributeModel extends BaseModel
{
public $list;
public $listAttribute = 'list';
public $listClass = KodCommerceProductAttributeListModel::class;
public function rules()
{
    return [
        ['list','safe']
    ];
}

public function formTypes()
{
    return null;
}
}