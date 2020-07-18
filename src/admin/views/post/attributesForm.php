<?php

/**
 * @var \kodCommerce\admin\models\PostAttributes $postAttributes
 * @var integer $post_id
 * @var \yii\web\View $this
 */


?>


<?php
\yii\widgets\Pjax::begin(
    [
        'id'=>'postAttributes-pjax',
        'enablePushState' => false
    ]
);

?>

<div class="row">
    <div class="col-sm-12 col-lg-4">
       <div class="panel">
           <div class="panel-heading bg-green">
               <strong>Add/Update Attribute</strong>
           </div>
           <div class="panel-body">
               <?php

   $action = $postAttributes->id?'/en/commerce-admin/post/attributes?id='.$postAttributes->id:'/en/commerce-admin/post/attributes';
               $form = \yii\bootstrap\ActiveForm::begin([
                   'action'=>$action,
                   'options'=>['data-pjax'=>1]
               ]);
               echo $form->field($postAttributes,'post_id')->hiddenInput(['value'=>$post_id])->label(false);

               try {
                echo   \ronashdkl\kodCms\widgets\config\FormFieldWidget::widget([
                        'model'=>$postAttributes,
                       'form'=>$form,
                       'group'=>'general'
                   ]);
               } catch (Exception $e) {
                   Yii::error($e->getMessage());
               }

               ?>

               <div class="<?=$postAttributes->isNewRecord?'':'well dynamic'?>">
                   <?php
                   if(!$postAttributes->isNewRecord) {

                       try {
                           echo \ronashdkl\kodCms\widgets\config\FormFieldWidget::widget([
                               'model' => $postAttributes,
                               'form' => $form,
                               'group' => 'config'
                           ]);
                       } catch (Exception $e) {
                           Yii::error($e->getMessage());
                       }
                   }
                   ?>
               </div>
               <?php


               echo \yii\helpers\Html::submitButton('save',['class'=>'btn btn-info']);

               echo $postAttributes->id? " ".\yii\helpers\Html::a('New','/en/commerce-admin/post/attributes?post_id='.$post_id,['class'=>'btn btn-success','data-pjax'=>'1']):null;

               \yii\bootstrap\ActiveForm::end();

               ?>
           </div>
       </div>
    </div>
    <div class="col-sm-12 col-lg-8">

       <?php
       if(isset($dataProvider) && isset($searchModel)) {
           echo $this->render('attributesList', ['dataProvider' => $dataProvider, 'searchModel' => $searchModel,'post_id'=>$post_id]);
       }
       ?>


    </div>
</div>
<?php
\yii\widgets\Pjax::end();
?>

