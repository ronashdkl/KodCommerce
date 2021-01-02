<?php

$form = \yii\bootstrap4\ActiveForm::begin();
?>

<div class="row">
    <div class="col-sm-12 col-md-6">
        <strong><?=$title?></strong>
        <br>
        <?=
        \ronashdkl\kodCms\widgets\config\FormFieldWidget::widget([
            'model'=>$model,
            'form'=>$form,

        ])
        ?>
    </div>
</div>
<?php
\yii\bootstrap4\ActiveForm::end()
?>
