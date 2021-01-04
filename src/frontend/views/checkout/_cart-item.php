<?php
/**
 * @var $model \kodcommerce\cart\models\CartItemInterface
 */
?>
<div class="cart-item" data-sku="<?=$model->getUniqueId()?>">
    <div class="cart--id"><i class="fa fa-shopping-basket"></i></div>
    <img class="cart--item-image" src="<?=$model->getImage() ?>" alt="">
    <div class="cart--item-label">
        <strong><?=$model->getLabel()?></strong>

     <?php
     foreach ($model->getVariations() as $key=>$value){

         ?>
         <?php
         if(is_array($value)){
foreach ($value as $k=>$v){
             ?>
    <p class="cart--item-variation"> <?=$k?>:  <?= $v ?></p>

    <?php
         }}else{
             ?>
             <p class="cart--item-variation"> <?=$key?>: <?=$value?> </p>
             <?php
         }
         ?>

         <p class="cart--item-unit-price format-price"> </p>
        <?php
     }
     ?>

    </div>
    <div >
        Quantity: <?=$model->getQuantity()?>
    </div>
    <div class="cart--item-price"><span class="cart--item-total format-price"><?= Yii::$app->formatter->asCurrency($model->getTotal())?></span>

    </div>

</div>