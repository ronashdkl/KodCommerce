<?php
/**
 * @var \ronashdkl\kodCms\models\post\PostModel $model
 * @var \yii\web\View $this
 */

?>
<!-- Privacy Content -->
<div class="ex-basic-2">
    <div class="container">
        <div class="row" style="align-items: center">
            <div class="col-md-6">
                <?php echo \kodcommerce\widgets\ProductImagesWidget::widget([
                    'images'=>$model->getImages()
                ]) ?>
            </div> <!-- end of col -->

            <div class="col-md-6 commerce--product-info">
               <div class="commerce--wrapper">
                   <?=yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken)?>
                   <h3><?=$model->title?></h3>
                   <strong>Price <span class="item-price commerce--product-price"><?=$model->formattedPrice?></span></strong>
                   <p class="commerce--product-stock"></p>
                   <p style="display: none" class="item-title"><?=$model->title?></p>

                   <?php

                   echo ($model->product_type)?  \kodcommerce\widgets\ProductVariationWidget::widget(['model'=>$model]):null;

                   ?>

                   <br>

                   <div class="commerce-quantity">
                       Quanity:
                       <div class="commerce--quantity">
                           <div class="commerce--quantity-inc-dec "><i class="fa fa-plus-circle inc"></i></div>
                           <input class="commerce--quantity-input" type="number" min="1" value="1">
                           <div class="commerce--quantity-inc-dec dec"><i class="fa fa-minus-circle dec"></i></div>
                       </div>
                   </div>
                   <div class="commerce--buttons">
                       <?php
                       if ($model->product_type){
                           echo \yii\helpers\Html::button(Yii::t('cart','Add to Cart'),[
                               'disabled'=>'disabled',
                               'data-product_type'=>$model->product_type,
                               'class'=>'btn btn-primary add-to-cart-button commerce--add-to-cart-btn'
                           ]);
                       }else{
                           echo \yii\helpers\Html::button(Yii::t('cart','Add to Cart'),[
                               'data-sku'=>'P'.$model->id.'TS',
                               'data-product_type'=>$model->product_type,
                               'class'=>'btn btn-primary add-to-cart-button commerce--add-to-cart-btn'
                           ]);
                       }
                       ?>
                   </div>
               </div>
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
