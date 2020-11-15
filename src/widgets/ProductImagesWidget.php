<?php


namespace kodcommerce\widgets;


use kodcommerce\widgets\assets\ProductImagesAsset;
use yii\base\InvalidConfigException;

class ProductImagesWidget extends BaseWidget
{
    public $images;

    public function run()
    {
        parent::run();
        if (!$this->images) {
            $this->getView()->registerJs("$('.kod_product_image').parent().remove()");
        } else {
            $images = json_encode($this->images);
            $this->getView()->registerAssetBundle(ProductImagesAsset::className(), $this->getView()::POS_HEAD);
            $this->getView()->registerJs(<<<JS
    KodProductImage($images)();
    JS, $this->getView()::POS_END);
        }

        return $this->render('product-images', ['images' => $this->images]);
    }
}
