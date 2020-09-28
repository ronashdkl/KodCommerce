<?php


namespace kodcommerce\widgets;



use kodcommerce\assets\ProductVariationWidgetAsset;
use yii\base\Widget;
use yii\web\View;

class ProductVariationWidget extends Widget
{
public $model;

public function run()
{
    parent::run();

    return $this->render('variation/index',['model'=>$this->model]);
}
}