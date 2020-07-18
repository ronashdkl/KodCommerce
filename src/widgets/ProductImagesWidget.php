<?php


namespace kodcommerce\widgets;


use kodcommerce\widgets\assets\ProductImagesAsset;
use yii\base\InvalidConfigException;

class ProductImagesWidget extends BaseWidget
{
public function run()
{
    parent::run();
    try {
        $this->view->registerAssetBundle(ProductImagesAsset::class);
    } catch (InvalidConfigException $e) {
        \Yii::error($e->getMessage());
    }
    return $this->render('product-images');
}
}