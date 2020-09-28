<?php
$config = Yii::$app->kodCommerceSetting->get('cart.dropdown');

$aTag = \yii\helpers\Html::tag($config['toggle-tag']??'a','<span class="glyphicon glyphicon-shopping-cart"></span> <span class="cart-total-items"></span>  '.$config['toggle-tag-text'].'<span class="caret"></span>',['class'=>$config['toggle-tag-class'].' cart-toggle']);
$itemContainer = \yii\helpers\Html::tag('ul','',['class'=>'dropdown-cart cart-items']);
echo \yii\helpers\Html::tag('li',$aTag.$itemContainer,['class'=>$config['li-tag-class']]);
?>