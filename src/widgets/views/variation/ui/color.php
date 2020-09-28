<?php
/**
 * @var \kodCommerce\admin\models\PostAttributes $model
 * @var \yii\web\View $this
 */
?>


    <li class="options-item color">
        <div  data-id="<?=$model->id?>" data-value="<?=$model->value?>" data-toggle="tooltip" data-placement="top" title="<?=$model->value?>" style="background: <?=$model->get('typeValue')?>"></div>
    </li>

