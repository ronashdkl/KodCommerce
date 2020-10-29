<?php


namespace kodcommerce\widgets;



use kodcommerce\assets\KodCommerceAsset;
use yii\base\Widget;
use yii\helpers\VarDumper;
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
