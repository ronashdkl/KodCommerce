<?php


namespace kodCommerce\frontend\controllers;


use kodCommerce\frontend\base\CommerceBaseController;
use kodCommerce\frontend\models\CartModel;
use yii\web\Controller;

class CartController extends CommerceBaseController
{
    public function actionIndex()
    {
        $model = new CartModel();
        $this->registerWidgets();
        $total = function($type = 'total',$multiply=null){
           return \Yii::$app->cart->getAttributeTotal($type,$multiply);
        };
        return $this->render('index'
        );
    }
}
