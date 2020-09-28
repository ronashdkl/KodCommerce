<?php
/**
 * @var \kodCommerce\frontend\models\KodCommerceProduct $model
 * @var \yii\web\View $this
 */
Yii::$app->hooks->do_action(\kodCommerce\KodCommerceHooks::RENDER_CONTENT_BEFORE_VARIATION);

?>
<style>
    .variation-options > li {
        cursor: pointer;
        padding: 10px;
    }
    .options-item.color  > div {
        height: 30px;
        width: 30px;
        border-radius: 30px;
        border: 2px solid #939494;
        box-shadow: -5px 4px 6px 0px;
    }
    .options-item{
        display: inline-grid;
    }

    .options-item.input > div {
        border: 2px solid #939494;
        background: #f6f9f9;
        text-align: center;
        padding: 5px;
        width: 35px;
        box-shadow: -5px 4px 6px 0px;
    }

    .options-item > div:hover,.options-item > div:active, .options-item > div.active {
        border: 2px solid #00bfbf;
        box-shadow: none;
    }
    .option-title{
        font-size: 15px;
        color: #00bfd9;
    }

</style>

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