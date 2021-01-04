<?php

use kodcommerce\cart\models\CartItemInterface;

/**
 * @var $this \yii\web\View
 * @var  $total Closure
 * @var  $model \kodcommerce\models\KodCommerceContact []
 * @var  $items CartItemInterface[]
 */



?>
<style>

</style>


<section >
    <div class="container">
        <h3 class="mb-5 text-center"> Checkout</h3>

        <?= yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
        <div class="row mt-2">
            <div class="col-sm-12 col-md-6">
                <strong>Billing Address</strong>
               <div class="mt-3">
                   <?php
                   echo  \yii\widgets\DetailView::widget([
                       'model' => $billingAddress,

                       'attributes' => [
                           'country',
                           'address_line_one',
                           'address_line_two',
                           'city',
                           'state',
                           'zip_code',
                           'phone',
                           'email'
                       ]
                   ]);
                   ?>
               </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <strong>Shipping Address</strong>
                <div class="mt-3">
                <?php
                echo    \yii\widgets\DetailView::widget([
                    'model' => $shippingAddress,
                    'attributes' => [
                        'country',
                        'address_line_one',
                        'address_line_two',
                        'city',
                        'state',
                        'zip_code',
                        'phone',
                        'email'

                    ]
                ]);
                ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-9">
                <div class="cart-list">
<?php
foreach ($items as $item){
echo $this->render('_cart-item',['model'=>$item]);
}

?>
                </div>
                 </div>
            <div class="col-sm-12 col-md-12 col-lg-3">
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
                        <button type="submit" class="btn btn-success">Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

