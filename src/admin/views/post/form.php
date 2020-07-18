<?php
/**
 * @var \yii\bootstrap\ActiveForm $form
 * @var \ronashdkl\kodCms\modules\admin\models\Post $model
 */

?>

<div class="panel">
    <div class="panel-heading bg-red">
        <strong>Price</strong>
    </div>
    <div class="panel-body">
        <?=
         \ronashdkl\kodCms\widgets\config\FormFieldWidget::widget([
            'model'=>$model,
            'form'=>$form,
            'group'=>'price'
        ]);
        ?>
    </div>
</div>

