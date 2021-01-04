<?php

use kodCommerce\assets\KodCommerceVenderAsset;
use kodcommerce\cart\models\CartItemInterface;

/**
 * @var $this \yii\web\View
 * @var  $total Closure
 * @var  $model \kodcommerce\models\KodCommerceContact []
 * @var  $items CartItemInterface[]
 */


$form = \yii\bootstrap4\ActiveForm::begin();

?>



<section id="checkout">
    <div class="container">
        <h3 class="mb-5 text-center"> Checkout</h3>

        <?= yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-12 col-lg-6">
               <?= $this->render('_address',[
                       'title'=>$title,
                   'form'=>$form,
                   'model'=>$model
               ])?>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-5">
                <div class="sticker">
                    <div class="bag-icon"></div>
                    <div class="">
                        <h4>Cart</h4>
                    </div>
                    <div class=" ">
                        <table class="table table-responsive table-hover">
                            <tr>
                                <th><?=Yii::t('commerce','Items')?></th>
                                <td class="cart-total-items"></td>

                            </tr>
                            <tr>
                                <th><?=Yii::t('commerce','Total')?></th>
                                <td class="cart--total format-price"><?=$total()?></td>
                            </tr>




                        </table>

                    </div>
                    <div class="actions">
                        <button type="submit" class="btn btn-success">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
\yii\bootstrap4\ActiveForm::end();

?>
