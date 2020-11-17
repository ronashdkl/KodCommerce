<?php

$col =  $leftWidgetsNumber > 0 ? 3 : Yii::$app->kodCommerceSetting->get('catalog.display.grid')??3;
$class = "grid-layout grid-${col}-columns";
echo \yii\widgets\ListView::widget([
    'dataProvider'=>$dataProvider,
    'options' => [
        'tag' => 'div',
        'class' => $class,
        'id' => 'list-wrapper',
        'data-item'=>'grid-item'
    ],
    'layout' => "{items}",
    'itemView'=>'_product'
])
?>


<hr>
<?= ($dataProvider->totalCount>0)?Yii::t('commerce',"Showing {count}-{page} of {total} items",[
    'count'=>"<b>".$dataProvider->count."</b>",
    'total'=>"<b>".$dataProvider->totalCount."</b>",
    'page'=>"<b>".$dataProvider->pagination->pageCount."</b>",
]) : Yii::$app->kodCommerceSetting->get('catalog.display.empty')?>
<div class="divider"></div>
<!-- Pagination -->
<?= \yii\bootstrap4\LinkPager::widget([
    'pagination'=>$dataProvider->pagination,
])
?>
