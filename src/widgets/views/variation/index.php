<?php
/**
 * @var \kodCommerce\frontend\models\KodCommerceProduct $model
 * @var \yii\web\View $this
 */
Yii::$app->hooks->do_action(\kodCommerce\KodCommerceHooks::RENDER_CONTENT_BEFORE_VARIATION);

?>

<ul class="list-unstyled li-space-lg indent product-variations" data-product="<?=$model->id?>" data-variations="<?=count($model->productAttributesByIndex)?>">

    <?php
    foreach ($model->productAttributesByIndex as $key=>$attributes){

        ?>
        <li>
            <strong class="option-title"><?=$key?></strong>
            <?php
            $type = null;
            echo "<ul class='variation-options' data-attribute='".$key."'>";
            foreach ($attributes as $attribute){
                if(!$type){
                    $type = $attribute->commerceAttribute->type;
                }
                echo $this->render('ui/'.$type,['model'=>$attribute]);
            }
            echo "</ul>";
            ?>
        </li>
    <?php
    }?>

    
</ul>

<?php
Yii::$app->hooks->do_action(\kodCommerce\KodCommerceHooks::RENDER_CONTENT_AFTER_VARIATION);
$this->registerJs("$(function () {
            $('[data-toggle=\"tooltip\"]').tooltip()
        })",$this::POS_END);
?>
