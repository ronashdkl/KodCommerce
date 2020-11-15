<?php
/**
 * @var $model \kodCommerce\frontend\models\KodCommerceProductSearch
 */
?>
<div class="widget clearfix">
    <h3 class="widget-title"><?=Yii::$app->kodCommerceSetting->get('catalog.display.search_widget_title')?></h3>
<?php
$url = Yii::$app->request->url;
$url = substr($url,0,strpos($url, '?'));

$form = \yii\bootstrap4\ActiveForm::begin([
    'action'=> $url,
    'method'=>'GET'
]);
echo \ronashdkl\kodCms\widgets\config\FormFieldWidget::widget([
    'form'=>$form,
    'model'=>$model
]);
echo \yii\bootstrap4\Html::submitButton('Search',['class'=>'btn btn-primary']);
\yii\bootstrap4\ActiveForm::end();
?>


</div>

