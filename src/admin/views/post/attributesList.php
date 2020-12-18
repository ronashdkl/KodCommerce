<?php
use kartik\grid\GridView;

?>

<div class="panel">
    <div class="panel-heading bg-green">

        <strong>Attribute List</strong>


    </div>
    <div class="panel-body">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'name',
                    'group'=>true
                ],

                'value',
                [
                    'attribute' => 'Action',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return \yii\helpers\Html::a('Update',['/'.Yii::$app->language.'/commerce-admin/post/attributes','id'=>$model->id],['class'=>'btn btn-primary'])
                            ." ".
                            \yii\helpers\Html::a('Remove',['/'.Yii::$app->language.'/commerce-admin/post/attributes','id'=>$model->id,'remove'=>true],['class'=>'btn btn-danger']);
                    },
                ],
            ],
        ]); ?>

        <a style="display: <?=$dataProvider->count>0?'block':'none'?>" target="_blank" role="modal-remote" data-pjax="0" href="/<?=Yii::$app->language?>/commerce-admin/post/variations?id=<?=$post_id?>">Generate Variation</a>
    </div>

</div>
