<?php
\yii\widgets\Pjax::begin();
$form = \yii\bootstrap\ActiveForm::begin([
        'action'=>'/en/commerce-admin/post/variations?id='.$post_id,
        'options'=>[
                'data-pjax'=>'1'
        ]
]);
/*$max = (new \yii\db\Query())
    ->from('kodcommerce_product_variation')
    ->max('price');

echo $max;*/
?>
<div class="row">

    <?php
    foreach ($models as $id=>$model){
?>
     <div class="col-sm-4">
         <div class="panel">
             <div class="panel-heading bg-info">
                 <strong>SKU: <?=$models[$id]['sku']?></strong>
             </div>
             <div class="panel-body">
                 <input type="hidden" name="data[<?=$id?>][sku]" value="<?=$models[$id]['sku']?>">

                 <?php
                 foreach ($model as $key=>$value){


                     ?>
                     <?php
                     if(in_array($key,['price', 'stock'])){
                         ?>

                         <div class="form-group col-sm-6 ">
                             <label for=""><?=$key?></label>
                             <input name="data[<?=$id?>][<?=$key?>]" type="number" class="form-control" value="<?=$value?>">
                         </div>

                         <?php
                     }else{
                         ?>
                         <div class="form-group">

                             <input type="hidden" name="data[<?=$id?>][post_id]" value="<?=$post_id?>">
                             <?php
                             if(is_array($value)){

                                foreach ($value as $k=>$v){

                                  //  \yii\helpers\VarDumper::dump($v,10,1);

                                    ?>

                                        <strong><?=$k?>:</strong>
                                        <span> <?=$v?> &nbsp; </span>


                                    <input type="hidden" name="data[<?=$id?>][variations][<?=$k?>]" value="<?=$v?>">

                                    <?php
                                }
                             }else{

                             }
                             ?>

                         </div>
                         <?php
                     }}
                 ?>
             </div>
         </div>
     </div>
<?php
    }
    ?>
</div>

<?php

\yii\bootstrap\ActiveForm::end();
\yii\widgets\Pjax::end();
?>