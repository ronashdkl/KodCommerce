<div class="row justify-content-center">
    <div class="col-sm-12 col-md-8">
        <strong class="mb-3"><?=$title?></strong>
        <?=
        \ronashdkl\kodCms\widgets\config\FormFieldWidget::widget([
            'model'=>$model,
            'form'=>$form,

        ])
        ?>
    </div>

</div>


