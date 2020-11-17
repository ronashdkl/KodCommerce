<?php


namespace kodCommerce\frontend\models;


use ronashdkl\kodCms\modules\admin\models\Tree;

class KodCommerceCategory extends Tree
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(KodCommerceProduct::className(), ['tree_id' => 'id']);
    }

}
