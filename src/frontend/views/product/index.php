<?php
/**
 * @var \ronashdkl\kodCms\models\post\PostModel $model
 * @var \yii\web\View $this
 */

?>
<!-- Privacy Content -->
<div class="ex-basic-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <?php echo \kodcommerce\widgets\ProductImagesWidget::widget([
                    'images'=>$model->getImages()
                ]) ?>
            </div> <!-- end of col -->

            <div class="col-md-6">
                <h3>Price <span class="item-price"><?=$model->formattedPrice?></span></h3>
                <p style="display: none" class="item-title"><?=$model->title?></p>

                <?=\kodcommerce\widgets\ProductVariationWidget::widget(['model'=>$model])?>

                <br>
                <button data-id="<?=$model->id?>" data-price="<?=$model->price?>"  <?=$model->product_type?'disabled':null?> class="btn btn-primary add-to-cart-button">Add to Cart</button>
            </div> <!-- end of col -->
        </div>
        <div class="row">
            <div class="col-sm-12 col-lg-10 offset-lg-1">
                <?=$model->body?>
                <?=Yii::$app->hooks->do_action(\kodCommerce\KodCommerceHooks::RENDER_PRODUCT_CONTENT)?>
            </div>
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of ex-basic-2 -->
<!-- end of privacy content -->
