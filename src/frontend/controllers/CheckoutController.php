<?php


namespace kodCommerce\frontend\controllers;


use kodCommerce\frontend\base\CommerceBaseController;
use kodCommerce\models\contact\KodCommerceBillingAddress;
use kodCommerce\models\contact\KodCommerceShippingAddress;


class CheckoutController extends CommerceBaseController
{

    public function actionIndex()
    {
        $this->registerWidgets();
        $total = function($type = 'total',$multiply=null){
            return \Yii::$app->formatter->asCurrency(\Yii::$app->cart->getAttributeTotal($type,$multiply));
        };
        $model['billing'] = new KodCommerceBillingAddress();
        $model['shipping'] = new KodCommerceShippingAddress();
      return $this->render('index',['model'=>$model,'total'=>$total]);
    }
}
