<?php


namespace kodCommerce\widgets;


use kodCommerce\frontend\models\KodCommerceProduct;
use yii\helpers\VarDumper;

/**
 * Class ProductDescriptionWidget
 * @package kodCommerce\widgets
 * @property KodCommerceProduct $model
 */
class ProductDescriptionWidget extends KodCommerceProductWidget
{
    public function run()
    {
        parent::run();
       return $this->render('product-description',['model'=>$this->model]);

    }
}
