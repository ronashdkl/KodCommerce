<?php \yii\widgets\Pjax::begin(['timeout' => 3000, 'id' => 'pjax-cart-container']); ?>
<?php try {
    echo \yii\grid\GridView::widget($gridOptions);
} catch (Exception $e) {
    Yii::error($e->getMessage());
} ?>
<?php \yii\widgets\Pjax::end(); ?>