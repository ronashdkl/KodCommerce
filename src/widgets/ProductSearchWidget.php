<?php


namespace kodCommerce\widgets;


class ProductSearchWidget extends KodCommerceProductWidget
{
public function run()
{
    parent::run(); // TODO: Change the autogenerated stub
    $this->model->load(\Yii::$app->request->queryParams);
    return $this->render('product-search',['model'=>$this->model]);
}
}
