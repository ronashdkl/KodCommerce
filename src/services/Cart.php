<?php


namespace kodCommerce\services;


class Cart
{
public function register(){
   \Yii::$app->set('cart',[
       'class' => 'kodcommerce\cart\Cart',
       // you can change default storage class as following:
       'storageClass' => [
           'class' => 'kodcommerce\cart\storage\DatabaseStorage',
           // you can also override some properties
           'deleteIfEmpty' => true
       ]
   ]);
}
}