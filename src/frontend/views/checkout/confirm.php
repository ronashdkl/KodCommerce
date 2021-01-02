<?php

use kodcommerce\cart\models\CartItemInterface;

/**
 * @var $this \yii\web\View
 * @var  $total Closure
 * @var  $model \kodcommerce\models\KodCommerceContact []
 * @var  $items CartItemInterface[]
 */

$form = \yii\bootstrap4\ActiveForm::begin();

?>
<style>

</style>


<section >
    <div class="container">
        <h3>Checkout</h3>

        <?= yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-9">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <strong>Billing Address</strong>
                        <?=
                        \ronashdkl\kodCms\widgets\config\FormFieldWidget::widget([
                            'model'=>$model,
                            'form'=>$form,

                        ])
                        ?>
                    </div>

                </div>
                 </div>
            <div class="col-sm-12 col-md-12 col-lg-3">
                <div class="">
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
                        <button type="submit" class="btn btn-success">Proceed</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
\yii\bootstrap4\ActiveForm::end();

?>
