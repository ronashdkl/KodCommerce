<?php
/**
 * @var  $total Closure
 * @var  $items array
 */
?>
<style>

</style>


<section id="cart">
    <div class="container">
        <h3>Cart</h3>
        <?= yii\helpers\Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-9">
                <div class="cart-list">
                    <div class="cart-item label">
                        <div>Image</div>
                        <div>Product Name</div>
                        <div>Quantity</div>
                        <div>Total<sup>Unit Price</sup></div>
                        <div> Actions <p>Save / Remove</p></div>
                    </div>

                </div>
                <p class="cart--empty-text" style="display: none">Your cart is an empty</p>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-3">
                <div class="sticker">
                    <div class="bag-icon"></div>
                    <div class="">
                        <h4>Summary</h4>
                    </div>
                    <div class=" ">
                        <table class="table table-responsive table-hover">
                            <tr>
                                <th>Items in Cart</th>
                                <td class="cart-total-items"></td>

                            </tr>
                            <tr>
                                <th>Total</th>
                                <td class="cart--total format-price"></td>
                            </tr>


                        </table>
                        <div class="actions">
                            <button class="btn btn-danger cart--clear-btn">Clear</button>
                            <button class="btn btn-success cart--checkout-btn">Checkout</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
