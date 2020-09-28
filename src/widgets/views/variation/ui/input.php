<?php
/**
 * @var \kodCommerce\admin\models\PostAttributes $model
 * @var \yii\web\View $this
 */
?>

<li class="options-item input">
    <div data-id="<?=$model->id?>" data-value="<?=$model->value?>" data-toggle="tooltip" data-placement="top" title="<?=$model->get('typeValue')??null ?>">
        <?=$model->value?>
    </div>
</li>