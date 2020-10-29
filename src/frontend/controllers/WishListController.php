<?php


namespace kodCommerce\frontend\controllers;


use kodCommerce\frontend\models\CartModel;
use kodCommerce\frontend\models\WishListModel;
use kodcommerce\models\CartItemModel;
use yii\helpers\VarDumper;
use yii\web\Controller;

class WishListController extends CartController
{
    protected  $modelClass = WishListModel::class;
    public function actionIndex()
    {

        $cart =  \Yii::$app->cart;
        return $this->send([$cart->getItems(), $cart->getCount(), $cart->getAttributeTotal('total')]);
    }


}
